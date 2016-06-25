<?php

namespace Yab\Quarx\Models;

class Blog extends QuarxModel
{
    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required|string',
        'url'   => 'required|string',
    ];
}
