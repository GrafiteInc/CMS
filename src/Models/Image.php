<?php

namespace Yab\Quarx\Models;

use Config;
use Storage;
use FileService;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as InterventionImage;

class Image extends QuarxModel
{
    public $table = 'images';

    public $primaryKey = 'id';

    protected $guarded = [];

    protected $appends = [
        'url',
        'js_url',
        'data_url'
    ];

    public static $rules = [
        'location' => 'mimes:jpeg,jpg,bmp,png,gif',
    ];

    /**
     * Get the images url location.
     *
     * @param string $value
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        if (@get_headers(url('storage/'.str_replace('public/', '', $this->location)))) {
            return url('storage/'.str_replace('public/', '', $this->location));
        }

        return FileService::fileAsPublicAsset($this->location);
    }

    /**
     * Get the images url location.
     *
     * @param string $value
     *
     * @return string
     */
    public function getJsUrlAttribute()
    {
        if (@get_headers(url('storage/'.str_replace('public/', '', $this->location)))) {
            $file = url('storage/'.str_replace('public/', '', $this->location));
        } else {
            $file = FileService::fileAsPublicAsset($this->location);
        }

        return str_replace(url('/'), '', $file);
    }

    /**
     * Get the images url location.
     *
     * @param string $value
     *
     * @return string
     */
    public function getDataUrlAttribute()
    {
        if (Config::get('quarx.storage-location') === 'local' || Config::get('quarx.storage-location') === null) {
            $imagePath = storage_path('app/'.$this->location);
        } else {
            $imagePath = Storage::disk(Config::get('quarx.storage-location', 'local'))->url($this->location);
        }

        $image = InterventionImage::make($imagePath)->resize(800, null);

        return $image->encode('data-url');
    }
}
