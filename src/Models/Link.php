<?php

namespace Yab\Quarx\Models;

class Link extends QuarxModel
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
        parent::__construct($attributes);
        $keys = array_keys(request()->except('_method', '_token'));

        if (count($keys) > count($this->fillable)) {
            $this->fillable($keys);
        }
    }
}
