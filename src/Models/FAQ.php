<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    public $table = 'faqs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'question' => 'required',
    ];
}
