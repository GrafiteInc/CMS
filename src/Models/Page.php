<?php

namespace Yab\Quarx\Models;

class Page extends QuarxModel
{
    public $table = 'pages';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
        'url'   => 'required',
    ];
}
