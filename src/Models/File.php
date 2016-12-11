<?php

namespace Yab\Quarx\Models;

class File extends QuarxModel
{
    public $table = 'files';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'location' => 'required',
    ];
}
