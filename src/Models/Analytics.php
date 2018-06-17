<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;

// Load dynamically from config the right basis class
$cmsModel = config('cms.models.analytics') ?? CmsModel::class;
if (! is_a($cmsModel, CmsModel::class, true)) {
    throw InvalidConfiguration::modelIsNotValid($cmsModel);
}
class_alias($cmsModel, 'Grafite\Cms\Models\CmsBaseAnalyticsModel');

class Analytics extends CmsBaseAnalyticsModel
{
    public $table = 'analytics';

    public $primaryKey = 'id';

    public $fillable = [
        'token',
        'data',
    ];

    public static $rules = [];
}
