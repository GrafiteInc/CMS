<?php

namespace Mlantz\Quarx\Models;

use Mlantz\Quarx\Models\QuarxModel;

class Pages extends QuarxModel
{

    public $table = "pages";

    public $primaryKey = "id";

    public $fillable = [
        "title",
        "url",
        "entry",
        "seo_description",
        "seo_keywords",
        "is_published",
        "template_id"
    ];

    public static $rules = [

    ];

}
