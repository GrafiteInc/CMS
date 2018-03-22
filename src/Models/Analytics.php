<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;

class Analytics extends CmsModel
{
    public $table = 'analytics';

    public $primaryKey = 'id';

    public $fillable = [
        'token',
        'data',
    ];

    public static $rules = [];
}
