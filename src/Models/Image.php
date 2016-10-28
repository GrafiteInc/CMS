<?php

namespace Yab\Quarx\Models;

use Config;
use Storage;
use FileService;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as InterventionImage;

class Image extends Model
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
        return str_replace(url('/'), '', FileService::fileAsPublicAsset($this->location));
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
