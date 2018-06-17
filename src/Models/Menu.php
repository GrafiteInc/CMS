<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;

// Reads config and if given extend the provided class per module or by CMS Base.
$cmsModel = config('cms.models.menu') ?? CmsModel::class;
if (! is_a($cmsModel, CmsModel::class, true)) {
    throw InvalidConfiguration::modelIsNotValid($cmsModel);
}
class_alias(get_class($cmsModel), 'CmsBaseModel');

class Menu extends CmsBaseModel
{
    public $table = 'menus';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $fillable = [
        'name',
        'slug',
        'order',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }
}
