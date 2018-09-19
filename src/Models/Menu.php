<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;

class Menu extends CmsModel
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

    public function getOrderAttribute($value)
    {
        if (is_null($value)) {
            return '[]';
        }

        return $value;
    }
}
