<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Traits\Translatable;

class Blog extends QuarxModel
{
    use Translatable;

    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required|string',
        'url'   => 'required|string',
    ];

    protected $appends = [
        'translations'
    ];
}
