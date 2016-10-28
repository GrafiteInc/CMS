<?php

namespace Yab\Quarx\Models;

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
        'translations'
    ];
}
