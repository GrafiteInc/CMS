<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;
use Grafite\Cms\Services\Normalizer;
use Grafite\Cms\Traits\Translatable;

// Reads config and if given extend the provided class per module or by CMS Base.
$cmsModel = config('cms.models.menu') ?? CmsModel::class;
if (! is_a($cmsModel, CmsModel::class, true)) {
    throw InvalidConfiguration::modelIsNotValid($cmsModel);
}
class_alias($cmsModel, 'Grafite\Cms\Models\CmsBaseModel');

class Event extends Grafite\Cms\Models\CmsBaseModel
{
    use Translatable;

    public $table = 'events';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
    ];

    protected $appends = [
        'translations',
    ];

    protected $fillable = [
        'start_date',
        'end_date',
        'title',
        'details',
        'seo_description',
        'seo_keywords',
        'is_published',
        'template',
        'published_at',
    ];

    protected $dates = [
        'published_at' => 'Y-m-d H:i'
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }

    public function getDetailsAttribute($value)
    {
        return new Normalizer($value);
    }

    public function history()
    {
        return Archive::where('entity_type', get_class($this))->where('entity_id', $this->id)->get();
    }
}
