<?php

namespace Yab\Cabin\Controllers;

use Cabin;
use Config;
use Storage;
use Redirect;
use Response;
use Exception;
use CryptoService;
use Yab\Cabin\Models\File;
use Illuminate\Http\Request;
use Yab\Cabin\Requests\FileRequest;
use Yab\Cabin\Services\FileService;
use Yab\Cabin\Services\ValidationService;
use Yab\Cabin\Repositories\FileRepository;
use Yab\Cabin\Services\CabinResponseService;

class FilesController extends CabinController
{
    public function __construct(FileRepository $repository)
    {
        parent::construct();

        $this->repository = $repository;
    }

    /**
     * Display a listing of the Files.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return view('cabin::modules.files.index')
            ->with('files', $result)
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

        return view('cabin::modules.files.index')
            ->with('files', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Files.
     *
     * @return Response
     */
    public function create()
    {
        return view('cabin::modules.files.create');
    }

    /**
     * Store a newly created Files in storage.
     *
     * @param FileRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(File::$rules);

        if (!$validation['errors']) {
            $file = $this->repository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Cabin::notification('File saved successfully.', 'success');

        return redirect(route($this->routeBase.'.files.index'));
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
            'location' => [],
        ]);

        if (!$validation['errors']) {
            $file = $request->file('location');
            $fileSaved = FileService::saveFile($file, 'files/');
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
     * Remove a file.
     *
     * @param string $id
     *
     * @return Response
     */
    public function remove($id)
    {
        try {
            Storage::delete($id);

            $response = CabinResponseService::apiResponse('success', 'success!');
        } catch (Exception $e) {
            $response = CabinResponseService::apiResponse('error', $e->getMessage());
        }

        return $response;
    }

    /**
     * Show the form for editing the specified Files.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $files = $this->repository->findFilesById($id);

        if (empty($files)) {
            Cabin::notification('File not found', 'warning');

            return redirect(route($this->routeBase.'.files.index'));
        }

        return view('cabin::modules.files.edit')->with('files', $files);
    }

    /**
     * Update the specified Files in storage.
     *
     * @param int         $id
     * @param FileRequest $request
     *
     * @return Response
     */
    public function update($id, FileRequest $request)
    {
        $files = $this->repository->findFilesById($id);

        if (empty($files)) {
            Cabin::notification('File not found', 'warning');

            return redirect(route($this->routeBase.'.files.index'));
        }

        $files = $this->repository->update($files, $request->all());

        Cabin::notification('File updated successfully.', 'success');

        return Redirect::back();
    }

    /**
     * Remove the specified Files from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $files = $this->repository->findFilesById($id);

        if (empty($files)) {
            Cabin::notification('File not found', 'warning');

            return redirect(route($this->routeBase.'.files.index'));
        }

        if (is_file(storage_path($files->location))) {
            Storage::delete($files->location);
        } else {
            Storage::disk(config('cabin.storage-location', 'local'))->delete($files->location);
        }

        $files->delete();

        Cabin::notification('File deleted successfully.', 'success');

        return redirect(route($this->routeBase.'.files.index'));
    }

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

        $files = $this->repository->apiPrepared();

        return CabinResponseService::apiResponse('success', $files);
    }
}
