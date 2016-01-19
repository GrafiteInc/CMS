<?php

namespace Mlantz\Quarx\Models;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
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
