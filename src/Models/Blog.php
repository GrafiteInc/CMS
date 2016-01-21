<?php

namespace Mlantz\Quarx\Models;

use Mlantz\Quarx\Models\QuarxModel;

class Blog extends QuarxModel
{

    public $table = "blogs";

    public $primaryKey = "id";

    public $fillable = [
        "title",
        "tags",
        "entry",
        "is_published",
        "url"
    ];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

}
