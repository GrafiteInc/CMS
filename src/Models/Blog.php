<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Models\QuarxModel;

class Blog extends QuarxModel
{
    public $table = "blogs";

    public $primaryKey = "id";

    public $fillable = [
        "title",
        "tags",
        "entry",
        "template",
        "is_published",
        "seo_description",
        "seo_keywords",
        "url"
    ];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

}
