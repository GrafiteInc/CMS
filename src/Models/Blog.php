<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Services\Normalizer;
use Yab\Quarx\Traits\Translatable;

class Blog extends QuarxModel
{
    use Translatable;

    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

    protected $appends = [
        'translations',
    ];

    protected $fillable = [
        'title',
        'entry',
        'tags',
        'is_published',
        'seo_description',
        'seo_keywords',
        'url',
        'template',
        'published_at',
    ];

    public function getEntryAttribute($value)
    {
        return new Normalizer($value);
    }

    public function history()
    {
        return Archive::where('entity_type', get_class($this))->where('entity_id', $this->id)->get();
    }
}
