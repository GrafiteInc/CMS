<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Services\Normalizer;
use Yab\Quarx\Traits\Translatable;

class Page extends QuarxModel
{
    use Translatable;

    public $table = 'pages';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
        'url' => 'required',
    ];

    protected $appends = [
        'translations',
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
