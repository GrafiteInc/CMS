<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;
use Grafite\Cms\Traits\Translatable;

// Reads config and if given extend the provided class per module or by CMS Base.
$cmsModel = config('cms.models.menu') ?? CmsModel::class;
if (! is_a($cmsModel, CmsModel::class, true)) {
    throw InvalidConfiguration::modelIsNotValid($cmsModel);
}
class_alias(get_class($cmsModel), 'CmsBaseModel');

class FAQ extends CmsBaseModel
{
    use Translatable;

    public $table = 'faqs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'question' => 'required',
        'answer' => 'required',
    ];

    protected $appends = [
        'translations',
    ];

    protected $fillable = [
        'question',
        'answer',
        'is_published',
        'published_at',
    ];

    protected $dates = [
        'published_at'
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }
}
