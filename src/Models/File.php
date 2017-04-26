<?php

namespace Yab\Quarx\Models;

class File extends QuarxModel
{
    public $table = 'files';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'location' => 'required',
    ];

    protected $fillable = [
        'name',
        'location',
        'user',
        'tags',
        'details',
        'mime',
        'size',
        'is_published',
        'order',
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
