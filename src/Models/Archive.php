<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;

class Archive extends CmsModel
{
    public $table = 'archives';

    public $primaryKey = 'id';

    public $fillable = [
        'token',
        'entity_id',
        'entity_type',
        'entity_data',
    ];

    public static $rules = [];
}
