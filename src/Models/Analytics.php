<?php

namespace Yab\Cabin\Models;

class Analytics extends CabinModel
{
    public $table = 'analytics';

    public $primaryKey = 'id';

    public $fillable = [
        'token',
        'data',
    ];

    public static $rules = [];
}
