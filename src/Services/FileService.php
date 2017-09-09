<?php

namespace Yab\Quarx\Services;

use CryptoService as CryptoServiceForFiles;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * Generate a name from the file path.
     *
     * @param string $file File path
     *
     * @return string
     */
    public static function getFileClass($file)
    {
        $sections = explode(DIRECTORY_SEPARATOR, $file);
        $fileName = $sections[count($sections) - 1];

        $class = str_replace('.php', '', $fileName);

        return $class;
    }

    /**
     * Saves File.
     *
     * @param string $fileName File input name
     * @param string $location Storage location
     *
     * @return array
     */
    public static function saveClone($fileName, $directory = '', $fileTypes = [])
    {
        $fileInfo = pathinfo($fileName);

        if (substr($directory, 0, -1) != '/') {
            $directory .= '/';
        }

        $extension = $fileInfo['extension'];
        $newFileName = md5(rand(1111, 9999).time());

        // In case we don't want that file type
        if (!empty($fileTypes) && !in_array($extension, $fileTypes)) {
                throw new Exception('Incorrect file type', 1);
        }

        Storage::disk(Config::get('quarx.storage-location', 'local'))->put($directory.$newFileName.'.'.$extension, file_get_contents($fileName));

        return [
            'original' => basename($fileName),
            'name' => $directory.$newFileName.'.'.$extension,
        ];
    }

    /**
     * Saves File.
     *
     * @param string $fileName File input name
     * @param string $location Storage location
     *
     * @return array
     */
    public static function saveFile($fileName, $directory = '', $fileTypes = [])
    {
        if (is_object($fileName)) {
            $file = $fileName;
            $originalName = $file->getClientOriginalName();
        } else {
            $file = Request::file($fileName);
            $originalName = false;
        }

        if (is_null($file)) {
            return false;
        }

        if (File::size($file) > Config::get('quarx.max-file-upload-size', 6291456)) {
            throw new Exception('This file is too large', 1);
        }

        if (substr($directory, 0, -1) != '/') {
            $directory .= '/';
        }

        $extension = $file->getClientOriginalExtension();
        $newFileName = md5(rand(1111, 9999).time());

        // In case we don't want that file type
        if (!empty($fileTypes) && !in_array($extension, $fileTypes)) {
                throw new Exception('Incorrect file type', 1);
        }

        Storage::disk(Config::get('quarx.storage-location', 'local'))->put($directory.$newFileName.'.'.$extension, File::get($file));

        return [
            'original' => $originalName ?: $file->getFilename().'.'.$extension,
            'name' => $directory.$newFileName.'.'.$extension,
        ];
    }

    /**
     * Provide a URL for the file as a public asset.
     *
     * @param string $fileName File name
     *
     * @return string
     */
    public static function fileAsPublicAsset($fileName)
    {
        return '/public-asset/'.CryptoServiceForFiles::url_encode($fileName);
    }

    /**
     * Provides a URL for the file as a download.
     *
     * @param string $fileName     File name
     * @param string $realFileName Real file name
     *
     * @return string
     */
    public static function fileAsDownload($fileName, $realFileName)
    {
        return '/public-download/'.CryptoServiceForFiles::url_encode($fileName).'/'.CryptoServiceForFiles::url_encode($realFileName);
    }

    /**
     * Provide a URL for the file as a public preview.
     *
     * @param string $fileName File name
     *
     * @return string
     */
    public static function filePreview($fileName)
    {
        return '/public-preview/'.CryptoServiceForFiles::url_encode($fileName);
    }
}
