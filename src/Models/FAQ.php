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
}
