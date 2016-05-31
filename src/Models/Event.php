<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Models\QuarxModel;

class Event extends QuarxModel
{

    public $table = "events";

    public $primaryKey = "id";

    public $fillable = [
        "start_date",
        "end_date",
        "title",
        "template",
        "details",
        "seo_description",
        "seo_keywords",
        "is_published"
    ];

    public static $rules = [
        'title' => 'required',
    ];

}
