<?php

namespace Yab\Quarx\Models;

class Link extends QuarxModel
{
    public $table = 'links';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'name' => 'required',
    ];
}
