<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Traits\Translatable;

class Event extends QuarxModel
{
    use Translatable;

    public $table = 'events';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
    ];

    protected $appends = [
        'translations',
    ];
}
