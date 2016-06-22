<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Models\QuarxModel;

class Event extends QuarxModel
{

    public $table = "events";

    public $primaryKey = "id";

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
    ];

}
