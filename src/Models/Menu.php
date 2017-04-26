<?php

namespace Yab\Quarx\Models;

class Menu extends QuarxModel
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
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $keys = array_keys(request()->except('_method', '_token'));

        if (count($keys) > count($this->fillable)) {
            $this->fillable($keys);
        }
    }
}
