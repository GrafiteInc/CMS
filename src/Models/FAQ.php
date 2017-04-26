<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Traits\Translatable;

class FAQ extends QuarxModel
{
    use Translatable;

    public $table = 'faqs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'question' => 'required',
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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $keys = array_keys(request()->except('_method', '_token'));

        if (count($keys) > count($this->fillable)) {
            $this->fillable($keys);
        }
    }
}
