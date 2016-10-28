<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use Translatable;

    public $table = 'faqs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'question' => 'required',
    ];

    protected $appends = [
        'translations'
    ];
}
