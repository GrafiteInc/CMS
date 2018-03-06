<?php

namespace Yab\Cabin\Controllers;

use Config;
use CryptoService;
use FileService;
use Illuminate\Http\Request;
use Cabin;
use Storage;
use Yab\Cabin\Models\Image;
use Yab\Cabin\Repositories\ImageRepository;
use Yab\Cabin\Requests\ImagesRequest;
use Yab\Cabin\Services\CabinResponseService;
use Yab\Cabin\Services\ValidationService;

class ImagesController extends CabinController
{
    public function __construct(ImageRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
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

        $result = $this->repository->paginated();

        return view('cabin::modules.images.index')
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

        $result = $this->repository->search($input);

        return view('cabin::modules.images.index')
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
        return view('cabin::modules.images.create');
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
                    $imageSaved = $this->repository->store([
                        'location' => $image,
                        'is_published' => $request->input('is_published'),
                        'tags' => $request->input('tags'),
                    ]);
                }

                Cabin::notification('Image saved successfully.', 'success');

                if (!$imageSaved) {
                    Cabin::notification('Image was not saved.', 'danger');
                }
            } else {
                Cabin::notification('Image could not be saved', 'danger');

                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Cabin::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route($this->routeBase.'.images.index'));
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
            $response = CabinResponseService::apiResponse('success', $fileSaved);
        } else {
            $response = CabinResponseService::apiErrorResponse($validation['errors'], $validation['inputs']);
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
        $images = $this->repository->findImagesById($id);

        if (empty($images)) {
            Cabin::notification('Image not found', 'warning');

            return redirect(route($this->routeBase.'.images.index'));
        }

        return view('cabin::modules.images.edit')->with('images', $images);
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
            $images = $this->repository->findImagesById($id);

            Cabin::notification('Image updated successfully.', 'success');

            if (empty($images)) {
                Cabin::notification('Image not found', 'warning');

                return redirect(route($this->routeBase.'.images.index'));
            }

            $images = $this->repository->update($images, $request->all());

            if (!$images) {
                Cabin::notification('Image could not be updated', 'danger');
            }
        } catch (Exception $e) {
            Cabin::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route($this->routeBase.'.images.edit', $id));
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
        $image = $this->repository->findImagesById($id);

        if (is_file(storage_path($image->location))) {
            Storage::delete($image->location);
        } else {
            Storage::disk(Config::get('cabin.storage-location', 'local'))->delete($image->location);
        }

        if (empty($image)) {
            Cabin::notification('Image not found', 'warning');

            return redirect(route($this->routeBase.'.images.index'));
        }

        $image->forgetCache();
        $image->delete();

        Cabin::notification('Image deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.images.index'));
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
            $image = $this->repository->findImagesById($id);

            if (is_file(storage_path($image->location))) {
                Storage::delete($image->location);
            } else {
                Storage::disk(Config::get('cabin.storage-location', 'local'))->delete($image->location);
            }

            $image->delete();
        }

        Cabin::notification('Bulk Image deletes completed successfully.', 'success');

        return redirect(route($this->routeBase.'.images.index'));
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
        if (config('cabin.api-key') != $request->header('cabin')) {
            return CabinResponseService::apiResponse('error', []);
        }

        $images =  $this->repository->apiPrepared();

        return CabinResponseService::apiResponse('success', $images);
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
        $image = $this->repository->apiStore($request->all());

        return CabinResponseService::apiResponse('success', $image);
    }
}
