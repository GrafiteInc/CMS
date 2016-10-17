<?php

namespace Yab\Quarx\Repositories;

use Auth;
use Config;
use CryptoService;
use Yab\Quarx\Models\File;
use Yab\Quarx\Services\FileService;
use Illuminate\Support\Facades\Schema;

class FileRepository
{
    /**
     * Returns all Files.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return File::orderBy('created_at', 'desc')->all();
    }

    /**
     * Paginated Files.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated()
    {
        return File::orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }

    /**
     * Search for files.
     *
     * @param string $input
     *
     * @return array
     */
    public function search($input)
    {
        $query = File::orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing('files');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [$query, $input['term'], $query->paginate(Config::get('quarx.pagination', 25))->render()];
    }

    /**
     * Stores Files into database.
     *
     * @param array $input
     *
     * @return Files
     */
    public function store($input)
    {
        $result = false;

        foreach ($input['location'] as $_file) {
            $fileInput = $input;
            $fileInput['name'] = $_file['original'];
            $fileInput['location'] = CryptoService::decrypt($_file['name']);
            $fileInput['mime'] = $_file['mime'];
            $fileInput['size'] = $_file['size'];
            $fileInput['order'] = 0;
            $fileInput['user'] = (isset($input['user'])) ? $input['user'] : Auth::id();
            $fileInput['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;
            $result = File::create($fileInput);
        }

        return $result;
    }

    /**
     * Find Files by given id.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Files
     */
    public function findFilesById($id)
    {
        return File::find($id);
    }

    /**
     * Updates Files into database.
     *
     * @param Files $files
     * @param array $input
     *
     * @return Files
     */
    public function update($files, $input)
    {
        if (isset($input['location'])) {
            $savedFile = FileService::saveFile($input['location'], 'files/');
            $_file = $input['location'];

            $fileInput = $input;
            $fileInput['name'] = $savedFile['original'];
            $fileInput['location'] = $savedFile['name'];
            $fileInput['mime'] = $_file->getClientMimeType();
            $fileInput['size'] = $_file->getClientSize();
        } else {
            $fileInput = $input;
        }

        $fileInput['is_published'] = (isset($input['is_published'])) ? (bool) $input['is_published'] : 0;

        return $files->update($fileInput);
    }

    public function apiPrepared()
    {
        $files = File::orderBy('created_at', 'desc')->where('is_published', 1)->get();
        $allFiles = [];

        foreach ($files as $file) {
            array_push($allFiles, [
                'file_identifier' => CryptoService::url_encode($file->name).'/'.CryptoService::url_encode($file->location),
                'file_name'       => $file->name,
                'file_date'       => $file->created_at->format('F jS, Y'),
            ]);
        }

        return $allFiles;
    }
}
