<?php

namespace Yab\Quarx\Controllers;

use Quarx;
use Config;
use Storage;
use Redirect;
use Response;
use CryptoService;
use Yab\Quarx\Models\File;
use Illuminate\Http\Request;
use Yab\Quarx\Requests\FileRequest;
use Yab\Quarx\Services\FileService;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Repositories\FileRepository;
use Yab\Quarx\Services\QuarxResponseService;

class FilesController extends QuarxController
{
    /** @var FilesRepository */
    private $fileRepository;

    public function __construct(FileRepository $fileRepo)
    {
        $this->fileRepository = $fileRepo;
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
        $result = $this->fileRepository->paginated();

        return view('quarx::modules.files.index')
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

        $result = $this->fileRepository->search($input);

        return view('quarx::modules.files.index')
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
        return view('quarx::modules.files.create');
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
            $file = $this->fileRepository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Quarx::notification('File saved successfully.', 'success');

        return redirect(route('quarx.files.index'));
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
            $response = QuarxResponseService::apiResponse('success', $fileSaved);
        } else {
            $response = QuarxResponseService::apiErrorResponse($validation['errors'], $validation['inputs']);
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

            $response = QuarxResponseService::apiResponse('success', 'success!');
        } catch (Exception $e) {
            $response = QuarxResponseService::apiResponse('error', $e->getMessage());
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
        $files = $this->fileRepository->findFilesById($id);

        if (empty($files)) {
            Quarx::notification('File not found', 'warning');

            return redirect(route('quarx.files.index'));
        }

        return view('quarx::modules.files.edit')->with('files', $files);
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
        $files = $this->fileRepository->findFilesById($id);

        if (empty($files)) {
            Quarx::notification('File not found', 'warning');

            return redirect(route('quarx.files.index'));
        }

        $files = $this->fileRepository->update($files, $request->all());

        Quarx::notification('File updated successfully.', 'success');

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
        $files = $this->fileRepository->findFilesById($id);

        if (empty($files)) {
            Quarx::notification('File not found', 'warning');

            return redirect(route('quarx.files.index'));
        }

        Storage::delete($files->location);
        $files->delete();

        Quarx::notification('File deleted successfully.', 'success');

        return redirect(route('quarx.files.index'));
    }

    /**
     * Display the specified Images.
     *
     * @return Response
     */
    public function apiList(Request $request)
    {
        if (Config::get('quarx.api-key') != $request->header('quarx')) {
            return QuarxResponseService::apiResponse('error', []);
        }

        $files = $this->fileRepository->apiPrepared();

        return QuarxResponseService::apiResponse('success', $files);
    }
}
