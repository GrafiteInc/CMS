<?php

namespace Mlantz\Quarx\Controllers;

use App;
use Image;
use Quarx;
use Input;
use Response;
use Exception;
use CryptoService;
use Illuminate\Support\Facades\Lang;
use Illuminate\Filesystem\Filesystem;

class AssetController extends QuarxController
{
    /**
     * Provide the File as a Public Asset
     * @param  String $encFileName
     * @return Download
     */
    public function asPublic($encFileName, Filesystem $fileSystem)
    {
        try {
            $fileName = CryptoService::decrypt($encFileName);
            $filePath = base_path('storage/app/'.$fileName);

            $fileName = basename($filePath);
            $contentType = $fileSystem->mimeType($filePath);

            $headers = [ 'Content-Type' => $contentType ];

            return response()->download($filePath, $fileName, $headers);
        } catch (Exception $e) {
            return Response::make('file not found');
        }
    }

    /**
     * Provide the File as a Public Preview
     * @param  String $encFileName
     * @return Download
     */
    public function asPreview($encFileName, Filesystem $fileSystem)
    {
        try {
            $fileName = CryptoService::decrypt($encFileName);
            $filePath = base_path('storage/app/'.$fileName);

            $fileName = basename($filePath);
            $contentType = $fileSystem->mimeType($filePath);
            $ext = '.'.strtoupper($fileSystem->extension($filePath));

            if (stristr($contentType, 'image')) {
                $headers = [ 'Content-Type' => $contentType ];
                return response()->download($filePath, $fileName, $headers);
            } else {
                $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                $img = Image::make(__DIR__.'/../Assets/Images/blank.jpg');
                $img->fill($color);
                $img->text($ext, 145, 145, function($font) {
                    $font->file(__DIR__.'/../Assets/Fonts/SourceSansPro-Semibold.otf');
                    $font->size(36);
                    $font->color('#111111');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(45);
                });
                return $img->response('jpg');
            }
        } catch (Exception $e) {
            return Response::make('file not found');
        }
    }

    /**
     * Provide file as download
     * @param  String $encFileName
     * @param  String $encRealFileName
     * @return Downlaod
     */
    public function asDownload($encFileName, $encRealFileName, Filesystem $fileSystem)
    {
        try {
            $fileName = CryptoService::decrypt($encFileName);
            $realFileName = CryptoService::decrypt($encRealFileName);

            $filePath = base_path('storage/app/'.$realFileName);

            $fileName = basename($fileName);
            $contentType = $fileSystem->mimeType($filePath);

            $headers = [ 'Content-Type' => $contentType ];

            return response()->download($filePath, $fileName, $headers);
        } catch (Exception $e) {
            Quarx::notification(Lang::get("gondolyn/notification.general.error"), 'danger');
            return redirect('errors/general');
        }
    }

    /**
     * Gets an asset
     *
     * @param  String $encPath
     * @param  String $contentType
     * @return Provides the valid
     */
    public function asset($encPath, $contentType = null, Filesystem $fileSystem)
    {
        try {
            $path = CryptoService::decrypt($encPath);

            if (Input::get('isModule') === 'true') {
                $filePath = $path;
            } else {
                $filePath = __DIR__.'/../Assets/'.$path;
            }

            $fileName = basename($filePath);

            if (! is_null($contentType)) {
                $contentType = CryptoService::decrypt($contentType);
            } else {
                $contentType = $fileSystem->mimeType($fileName);
            }

            $headers = [ 'Content-Type' => $contentType ];

            return response()->download($filePath, $fileName, $headers);
        } catch (Exception $e) {
            return Response::make('file not found');
        }
    }
}
