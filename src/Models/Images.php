<?php

namespace Yab\Quarx\Models;

use FileService;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{

    public $table = "images";

    public $primaryKey = "id";

    protected $guarded = [];

    public static $rules = [
        'location' => 'mimes:jpeg,jpg,bmp,png,gif'
    ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['url'] = $this->url;
        return $array;
    }

    /**
     * Get the images url location
     *
     * @param  string  $value
     * @return string
     */
    public function getUrlAttribute()
    {
        return FileService::fileAsPublicAsset($this->location);
    }
}
