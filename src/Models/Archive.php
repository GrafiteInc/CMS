<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;

// Reads config and if given extend the provided class per module or by CMS Base.
$cmsModel = config('cms.models.menu') ?? CmsModel::class;
if (! is_a($cmsModel, CmsModel::class, true)) {
    throw InvalidConfiguration::modelIsNotValid($cmsModel);
}
class_alias(get_class($cmsModel), 'CmsBaseModel');

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
