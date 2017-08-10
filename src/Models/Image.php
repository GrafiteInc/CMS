<?php

namespace Yab\Quarx\Models;

use Carbon\Carbon;
use Config;
use Exception;
use FileService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Storage;
use Yab\Quarx\Services\AssetService;

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
                if (Storage::disk(Config::get('quarx.storage-location', 'local'))->exists($this->location)) {
                    $imagePath = Storage::disk(Config::get('quarx.storage-location', 'local'))->url($this->location);
                } elseif (! is_null(config('filesystems.cloud.key'))) {
                    $imagePath = Storage::disk('cloud')->url($this->location);
                } else {
                    $imagePath = app(AssetService::class)->generateImage('File Not Found');
                }
            }

            $image = InterventionImage::make($imagePath)->resize(config('quarx.preview-image-size', 800), null, function ($constraint) {
                $constraint->aspectRatio();
            });

            return (string) $image->encode('data-url');
        });
    }

    /**
     * Set Image Caches
     */
    public function setCaches()
    {
        if ($this->url && $this->js_url && $this->data_url) {
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
        foreach (['url', 'js_url', 'data_url'] as $attribute) {
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
}
