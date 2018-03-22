<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;

class Link extends CmsModel
{
    public $table = 'links';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'name' => 'required',
    ];

    protected $fillable = [
        'name',
        'external',
        'page_id',
        'menu_id',
        'external_url',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }
}
