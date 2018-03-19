<?php

namespace graphite\Quarx\Services;

use App;
use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Quarx;
use SplFileInfo;
use graphite\Quarx\Facades\CryptoServiceFacade;

class AssetService
{
    protected $mimeTypes;

    public function __construct()
    {
        $this->mimeTypes = require __DIR__.'/../Config/mime.php';
    }

    /**
     * Provide the File as a Public Asset.
     *
     * @param string $encFileName
     *
     * @return Download
     */
    public function asPublic($encFileName)
    {
        try {
            return Cache::remember($encFileName.'_asPublic', 3600, function () use ($encFileName) {
                $fileName = CryptoServiceFacade::url_decode($encFileName);
                $filePath = $this->getFilePath($fileName);

                $fileTool = new SplFileInfo($filePath);
                $ext = $fileTool->getExtension();
                $contentType = $this->getMimeType($ext);

                $headers = ['Content-Type' => $contentType];
                $fileContent = $this->getFileContent($fileName, $contentType, $ext);

                return Response::make($fileContent, 200, [
                    'Content-Type' => $contentType,
                    'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
                ]);
            });
        } catch (Exception $e) {
            return Response::make('file not found');
        }
    }

    /**
     * Provide the File as a Public Preview.
     *
     * @param string $encFileName
     *
     * @return Download
     */
    public function asPreview($encFileName, Filesystem $fileSystem)
    {
        try {
            return Cache::remember($encFileName.'_preview', 3600, function () use ($encFileName, $fileSystem) {
                $fileName = CryptoServiceFacade::url_decode($encFileName);

                if (Config::get('quarx.storage-location') === 'local' || Config::get('quarx.storage-location') === null) {
                    $filePath = storage_path('app/'.$fileName);
                    $contentType = $fileSystem->mimeType($filePath);
                    $ext = '.'.strtoupper($fileSystem->extension($filePath));
                } else {
                    $filePath = Storage::disk(Config::get('quarx.storage-location', 'local'))->url($fileName);
                    $fileTool = new SplFileInfo($filePath);
                    $ext = $fileTool->getExtension();
                    $contentType = $this->getMimeType($ext);
                }

                if (stristr($contentType, 'image')) {
                    $headers = ['Content-Type' => $contentType];
                    $fileContent = $this->getFileContent($fileName, $contentType, $ext);
                } else {
                    $fileContent = file_get_contents($this->generateImage($ext));
                }

                return Response::make($fileContent, 200, [
                    'Content-Type' => $contentType,
                    'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
                ]);
            });
        } catch (Exception $e) {
            return Response::make('file not found');
        }
    }

    /**
     * Provide file as download.
     *
     * @param string $encFileName
     * @param string $encRealFileName
     *
     * @return Downlaod
     */
    public function asDownload($encFileName, $encRealFileName)
    {
        try {
            return Cache::remember($encFileName.'_asDownload', 3600, function () use ($encFileName, $encRealFileName) {
                $fileName = CryptoServiceFacade::url_decode($encFileName);
                $realFileName = CryptoServiceFacade::url_decode($encRealFileName);
                $filePath = $this->getFilePath($fileName);

                $fileTool = new SplFileInfo($filePath);
                $ext = $fileTool->getExtension();
                $contentType = $this->getMimeType($ext);

                $headers = ['Content-Type' => $contentType];
                $fileContent = $this->getFileContent($realFileName, $contentType, $ext);

                return Response::make($fileContent, 200, [
                    'Content-Type' => $contentType,
                    'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
                ]);
            });
        } catch (Exception $e) {
            Quarx::notification('We encountered an error with that file', 'danger');

            return redirect('errors/general');
        }
    }

    /**
     * Gets an asset.
     *
     * @param string $encPath
     * @param string $contentType
     *
     * @return Provides the valid
     */
    public function asset($encPath, $contentType, Filesystem $fileSystem)
    {
        try {
            $path = CryptoServiceFacade::url_decode($encPath);

            if (Request::get('isModule') === 'true') {
                $filePath = $path;
            } else {
                $filePath = __DIR__.'/../Assets/'.$path;
            }

            $fileName = basename($filePath);

            if (!is_null($contentType)) {
                $contentType = CryptoServiceFacade::url_decode($contentType);
            } else {
                $contentType = $fileSystem->mimeType($fileName);
            }

            $headers = ['Content-Type' => $contentType];

            return response()->download($filePath, $fileName, $headers);
        } catch (Exception $e) {
            return Response::make('file not found');
        }
    }

    /**
     * Get the mime type.
     *
     * @param string $extension
     *
     * @return string
     */
    public function getMimeType($extension)
    {
        if (isset($this->mimeTypes['.'.strtolower($extension)])) {
            return $this->mimeTypes['.'.strtolower($extension)];
        }

        return 'text/plain';
    }

    /**
     * Get a file's path
     *
     * @param  string $fileName
     *
     * @return string
     */
    public function getFilePath($fileName)
    {
        if (file_exists(storage_path('app/'.$fileName))) {
            $filePath = storage_path('app/'.$fileName);
        } else {
            $filePath = Storage::disk(Config::get('quarx.storage-location', 'local'))->url($fileName);
        }

        return $filePath;
    }

    /**
     * Get a files content
     *
     * @param  string $fileName
     * @param  string $contentType
     * @param  string $ext
     *
     * @return mixed
     */
    public function getFileContent($fileName, $contentType, $ext)
    {
        if (Storage::disk(Config::get('quarx.storage-location', 'local'))->exists($fileName)) {
            $fileContent = Storage::disk(Config::get('quarx.storage-location', 'local'))->get($fileName);
        } elseif (!is_null(config('filesystems.cloud.key'))) {
            $fileContent = Storage::disk('cloud')->get($fileName);
        } else {
            $fileContent = file_get_contents($this->generateImage('File Not Found'));
        }

        if (stristr($fileName, 'image') || stristr($contentType, 'image')) {
            if (! is_null(config('quarx.preview-image-size'))) {
                $img = Image::make($fileContent);
                $img->resize(config('quarx.preview-image-size', 800), null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                return $img->encode($ext);
            }
        }

        return $fileContent;
    }

    /**
     * Generate an image
     *
     * @param string $ext
     *
     * @return Image
     */
    public function generateImage($ext)
    {
        $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        $img = Image::make(__DIR__.'/../Assets/images/blank.jpg');
        $img->fill($color);
        $img->text($ext, 150, 150, function ($font) {
            $font->file(__DIR__.'/../Assets/fonts/SourceSansPro-Black.ttf');
            $font->size(32);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('center');
            $font->angle(45);
        });

        $img->save(storage_path(md5($ext).'.jpg'));

        return storage_path(md5($ext).'.jpg');
    }
}
