<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Models\QuarxModel;

class Blog extends QuarxModel
{
    public $table = "blogs";

    public $primaryKey = "id";

    protected $guarded = [];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

}
