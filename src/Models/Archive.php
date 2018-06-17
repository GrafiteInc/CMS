<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;

// Load dynamically from config the right basis class
$cmsModel = config('cms.models.menu') ?? CmsModel::class;
if (! is_a($cmsModel, CmsModel::class, true)) {
    throw InvalidConfiguration::modelIsNotValid($cmsModel);
}
class_alias($cmsModel, 'Grafite\Cms\Models\CmsBaseModel');

class Archive extends CmsBaseModel
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
