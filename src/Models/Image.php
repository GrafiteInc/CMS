<?php

namespace Grafite\Cms\Models;

use Carbon\Carbon;
use Config;
use Exception;
use FileService;
use Grafite\Cms\Models\CmsModel;
use Grafite\Cms\Services\AssetService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Storage;

class Image extends CmsModel
{
    public $table = 'images';

    public $primaryKey = 'id';

    protected $guarded = [];

    protected $appends = [
        'url',
        'js_url',
    ];

    public static $rules = [
        'location' => 'mimes:jpeg,jpg,bmp,png,gif',
    ];

    protected $fillable = [
        'location',
        'name',
        'original_name',
        'storage_location',
        'alt_tag',
        'title_tag',
        'is_published',
        'tags',
        'entity_id',
        'entity_type',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }

    /**
     * Get the images url location.
     *
     * @param string $value
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        if ($this->isLocalFile()) {
            return url(str_replace('public/', 'storage/', $this->location));
        } elseif ($this->fileExists()) {
            return $this->getS3Image();
        }

        return $this->lostImage();
    }

    /**
     * Get an S3 image
     *
     * @return string
     */
    public function getS3Image()
    {
        $url = Storage::disk(Config::get('cms.storage-location', 'local'))->url($this->location);

        if (!is_null(config('cms.cloudfront'))) {
            $url = str_replace(config('filesystems.disks.s3.bucket').'.s3.'.config('filesystems.disks.s3.region').'.amazonaws.com', config('cms.cloudfront'), $url);
        }

        return $url;
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
        return $this->url;
    }

    /**
     * Set Image Caches
     */
    public function setCaches()
    {
        if ($this->url && $this->js_url) {
            return true;
        }

        return false;
    }

    /**
     * Simple caching tool
     *
     * @param  string $attribute
     * @param  Clousre $closure
     *
     * @return mixed
     */
    public function remember($attribute, $closure)
    {
        $key = $attribute.'_'.$this->location;

        if (!Cache::has($key)) {
            $result = $closure();
            Cache::forever($key, $result);
        }

        return Cache::get($key);
    }

    /**
     * Forget the current Image caches
     */
    public function forgetCache()
    {
        foreach (['url', 'js_url'] as $attribute) {
            $key = $attribute.'_'.$this->location;
            Cache::forget($key);
        }
    }

    /**
     * Check the location of the file.
     *
     * @return bool
     */
    private function isLocalFile()
    {
        try {
            if (file_exists(storage_path('app/'.$this->location))) {
                return true;
            }
        } catch (Exception $e) {
            Log::debug('Could not find the image');

            return false;
        }

        return false;
    }

    /**
     * Check if file exists
     *
     * @return  string
     */
    public function fileExists()
    {
        return Storage::disk(Config::get('cms.storage-location', 'local'))->exists($this->location);
    }

    /**
     * Staged image if none are found
     *
     * @return string
     */
    public function lostImage()
    {
        $imagePath = app(AssetService::class)->generateImage('File Not Found');

        $image = InterventionImage::make($imagePath)->resize(config('cms.preview-image-size', 800), null, function ($constraint) {
            $constraint->aspectRatio();
        });

        return (string) $image->encode('data-url');
    }
}
