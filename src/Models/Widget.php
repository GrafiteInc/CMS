<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Traits\Translatable;

class Widget extends QuarxModel
{
    use Translatable;

    public $table = 'widgets';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $appends = [
        'translations',
    ];
}
