<?php

namespace Yab\Quarx\Controllers;

use Config;
use CryptoService;
use FileService;
use Illuminate\Http\Request;
use Quarx;
use Storage;
use Yab\Quarx\Models\Image;
use Yab\Quarx\Repositories\ImageRepository;
use Yab\Quarx\Requests\ImagesRequest;
use Yab\Quarx\Services\QuarxResponseService;
use Yab\Quarx\Services\ValidationService;

class ImagesController extends QuarxController
{
    /** @var ImageRepository */
    private $imagesRepository;

    public function __construct(ImageRepository $imagesRepo)
    {
        parent::construct();

        $this->imagesRepository = $imagesRepo;
    }

    /**
     * Display a listing of the Images.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        $result = $this->imagesRepository->paginated();

        return view('quarx::modules.images.index')
            ->with('images', $result)
            ->with('pagination', $result->render());
    }

    /**
     * Search.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $result = $this->imagesRepository->search($input);

        return view('quarx::modules.images.index')
            ->with('images', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Images.
     *
     * @return Response
     */
    public function create()
    {
        return view('quarx::modules.images.create');
    }

    /**
     * Store a newly created Images in storage.
     *
     * @param ImagesRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $validation = ValidationService::check(['location' => 'required']);
            if (!$validation['errors']) {
                foreach ($request->input('location') as $image) {
                    $imageSaved = $this->imagesRepository->store([
                        'location' => $image,
                        'is_published' => $request->input('is_published'),
                        'tags' => $request->input('tags'),
                    ]);
                }

                Quarx::notification('Image saved successfully.', 'success');

                if (!$imageSaved) {
                    Quarx::notification('Image was not saved.', 'danger');
                }
            } else {
                Quarx::notification('Image could not be saved', 'danger');

                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route($this->quarxRouteBase.'.images.index'));
    }

    /**
     * Store a newly created Files in storage.
     *
     * @param FileRequest $request
     *
     * @return Response
     */
    public function upload(Request $request)
    {
        $validation = ValidationService::check([
            'location' => ['required'],
        ]);

        if (!$validation['errors']) {
            $file = $request->file('location');
            $fileSaved = FileService::saveFile($file, 'public/images', [], true);
            $fileSaved['name'] = CryptoService::encrypt($fileSaved['name']);
            $fileSaved['mime'] = $file->getClientMimeType();
            $fileSaved['size'] = $file->getClientSize();
            $response = QuarxResponseService::apiResponse('success', $fileSaved);
        } else {
            $response = QuarxResponseService::apiErrorResponse($validation['errors'], $validation['inputs']);
        }

        return $response;
    }

    /**
     * Show the form for editing the specified Images.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $images = $this->imagesRepository->findImagesById($id);

        if (empty($images)) {
            Quarx::notification('Image not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.images.index'));
        }

        return view('quarx::modules.images.edit')->with('images', $images);
    }

    /**
     * Update the specified Images in storage.
     *
     * @param int           $id
     * @param ImagesRequest $request
     *
     * @return Response
     */
    public function update($id, ImagesRequest $request)
    {
        try {
            $images = $this->imagesRepository->findImagesById($id);

            Quarx::notification('Image updated successfully.', 'success');

            if (empty($images)) {
                Quarx::notification('Image not found', 'warning');

                return redirect(route($this->quarxRouteBase.'.images.index'));
            }

            $images = $this->imagesRepository->update($images, $request->all());

            if (!$images) {
                Quarx::notification('Image could not be updated', 'danger');
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route($this->quarxRouteBase.'.images.edit', $id));
    }

    /**
     * Remove the specified Images from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $image = $this->imagesRepository->findImagesById($id);

        if (is_file(storage_path($image->location))) {
            Storage::delete($image->location);
        } else {
            Storage::disk(Config::get('quarx.storage-location', 'local'))->delete($image->location);
        }

        if (empty($image)) {
            Quarx::notification('Image not found', 'warning');

            return redirect(route($this->quarxRouteBase.'.images.index'));
        }

        $image->forgetCache();
        $image->delete();

        Quarx::notification('Image deleted successfully.', 'success');

        return redirect(route($this->quarxRouteBase.'.images.index'));
    }

    /**
     * Bulk image delete
     *
     * @param  string $ids
     *
     * @return Redirect
     */
    public function bulkDelete($ids)
    {
        $ids = explode('-', $ids);

        foreach ($ids as $id) {
            $image = $this->imagesRepository->findImagesById($id);

            if (is_file(storage_path($image->location))) {
                Storage::delete($image->location);
            } else {
                Storage::disk(Config::get('quarx.storage-location', 'local'))->delete($image->location);
            }

            $image->delete();
        }

        Quarx::notification('Bulk Image deletes completed successfully.', 'success');

        return redirect(route($this->quarxRouteBase.'.images.index'));
    }

    /*
    |--------------------------------------------------------------------------
    | Api
    |--------------------------------------------------------------------------
    */

    /**
     * Display the specified Images.
     *
     * @return Response
     */
    public function apiList(Request $request)
    {
        if (config('quarx.api-key') != $request->header('quarx')) {
            return QuarxResponseService::apiResponse('error', []);
        }

        $images =  $this->imagesRepository->apiPrepared();

        return QuarxResponseService::apiResponse('success', $images);
    }

    /**
     * Store a newly created Images in storage.
     *
     * @param ImagesRequest $request
     *
     * @return Response
     */
    public function apiStore(Request $request)
    {
        $image = $this->imagesRepository->apiStore($request->all());

        return QuarxResponseService::apiResponse('success', $image);
    }
}
