<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;
use Illuminate\Support\Facades\Config;

// Load dynamically from config the right basis class
$cmsModel = Config::get('cms.models.archive') ?? CmsModel::class;
if (! is_a($cmsModel, CmsModel::class, true)) {
    throw InvalidConfiguration::modelIsNotValid($cmsModel);
}
class_alias($cmsModel, 'Grafite\Cms\Models\CmsBaseArchiveModel');

class Archive extends CmsBaseArchiveModel
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
