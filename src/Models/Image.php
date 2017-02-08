<?php

namespace Yab\Quarx\Models;

use Carbon\Carbon;
use Config;
use FileService;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Storage;

class Image extends QuarxModel
{
    public $table = 'images';

    public $primaryKey = 'id';

    protected $guarded = [];

    protected $appends = [
        'url',
        'js_url',
        'data_url',
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
        return $this->remember('url', function () {
            if ($this->isLocalFile()) {
                return url(str_replace('public/', 'storage/', $this->location));
            }

            return FileService::fileAsPublicAsset($this->location);
        });
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
        return $this->remember('js_url', function () {
            if ($this->isLocalFile()) {
                $file = url(str_replace('public/', 'storage/', $this->location));
            } else {
                $file = FileService::fileAsPublicAsset($this->location);
            }

            return str_replace(url('/'), '', $file);
        });
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
        return $this->remember('data_url', function () {
            if ($this->isLocalFile()) {
                $imagePath = storage_path('app/'.$this->location);
            } else {
                $imagePath = Storage::disk(config('quarx.storage-location', 'local'))->url($this->location);
            }

            $image = InterventionImage::make($imagePath)->resize(800, null);

            return (string) $image->encode('data-url');
        });
    }

    public function remember($attribute, $closure)
    {
        $key = $attribute.'_'.$this->location;

        if (!Cache::has($key)) {
            $expiresAt = Carbon::now()->addMinutes(15);
            Cache::put($key, $closure(), $expiresAt);
        }

        return Cache::get($key);
    }

    /**
     * Check the location of the file.
     *
     * @return bool
     */
    private function isLocalFile()
    {
        $headers = get_headers(url(str_replace('public/', 'storage/', $this->location)));

        if (strpos($headers[0], '200')) {
            return true;
        }

        return false;
    }
}
