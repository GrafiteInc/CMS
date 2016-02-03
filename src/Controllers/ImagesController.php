<?php

namespace Yab\Quarx\Controllers;

use Quarx;
use Config;
use Storage;
use FileService;
use CryptoService;
use App\Http\Requests;
use Illuminate\Http\Request;
use Yab\Quarx\Models\Images;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Controllers\QuarxController;
use Yab\Quarx\Requests\ImagesRequest;
use Yab\Quarx\Services\QuarxResponseService;
use Yab\Quarx\Repositories\ImagesRepository;

class ImagesController extends QuarxController
{

    /** @var  ImagesRepository */
    private $imagesRepository;

    function __construct(ImagesRepository $imagesRepo)
    {
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

        $result = $this->imagesRepository->search($input);
        $images = $result[0]->sortByDesc('created_at');
        $attributes = $result[1];
        $pagination = $result[2];

        return view('quarx::modules.images.index')
            ->with('images', $images)
            ->with('pagination', $pagination)
            ->with('attributes', $attributes);
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
            $validation = ValidationService::check([ 'location' => 'required' ]);

            if (! $validation['errors']) {
                $images = $this->imagesRepository->store($request->all());
                Quarx::notification('Image saved successfully.', 'success');

                if (! $images) {
                    Quarx::notification('Image was not saved.', 'danger');
                }
            } else {
                Quarx::notification('Image could not be saved', 'danger');
                return $validation['redirect'];
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route('quarx.images.edit', [CryptoService::encrypt($images->id)]));
    }

    /**
     * Show the form for editing the specified Images.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $id = CryptoService::decrypt($id);
        $images = $this->imagesRepository->findImagesById($id);

        if (empty($images)) {
            Quarx::notification('Image not found', 'warning');
            return redirect(route('quarx.images.index'));
        }

        return view('quarx::modules.images.edit')->with('images', $images);
    }

    /**
     * Update the specified Images in storage.
     *
     * @param  int    $id
     * @param ImagesRequest $request
     *
     * @return Response
     */
    public function update($id, ImagesRequest $request)
    {
        try {
            $id = CryptoService::decrypt($id);
            $images = $this->imagesRepository->findImagesById($id);

            Quarx::notification('Image updated successfully.', 'success');

            if (empty($images)) {
                Quarx::notification('Image not found', 'warning');
                return redirect(route('quarx.images.index'));
            }

            $images = $this->imagesRepository->update($images, $request->all());

            if (! $images) {
                Quarx::notification('Image could not be updated', 'danger');
            }
        } catch (Exception $e) {
            Quarx::notification($e->getMessage() ?: 'Image could not be saved.', 'danger');
        }

        return redirect(route('quarx.images.edit', CryptoService::encrypt($id)));
    }

    /**
     * Remove the specified Images from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $id = CryptoService::decrypt($id);
        $image = $this->imagesRepository->findImagesById($id);

        Storage::delete($image->location);

        if (empty($image)) {
            Quarx::notification('Image not found', 'warning');
            return redirect(route('quarx.images.index'));
        }

        $image->delete();

        Quarx::notification('Image deleted successfully.', 'success');

        return redirect(route('quarx.images.index'));
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
        if (Config::get('quarx.apiKey') != $request->header('quarx')) {
            return QuarxResponseService::apiResponse('error', []);
        }

        $images = $this->imagesRepository->apiPrepared();

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
        $image->location = FileService::fileAsPublicAsset($image->location);
        return QuarxResponseService::apiResponse('success', $image);
    }
}
