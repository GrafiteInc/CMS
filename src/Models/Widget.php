<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Traits\Translatable;

class Widget extends QuarxModel
{
    use Translatable;

    public $table = 'widgets';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $appends = [
        'translations',
    ];

    protected $fillable = [
        'name',
        'slug',
        'content',
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
