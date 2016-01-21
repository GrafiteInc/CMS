<?php

namespace Mlantz\Quarx\Models;

use Mlantz\Quarx\Models\QuarxModel;

class Event extends QuarxModel
{

    public $table = "events";

    public $primaryKey = "id";

    public $fillable = [
        "start_date",
        "end_date",
        "title",
        "details",
        "is_published"
    ];

    public static $rules = [

    ];

}
