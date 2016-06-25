<?php

namespace Yab\Quarx\Models;

class Event extends QuarxModel
{
    public $table = 'events';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
    ];
}
