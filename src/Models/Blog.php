<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Translatable;

    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required|string',
        'url'   => 'required|string',
    ];

    protected $appends = [
        'translations'
    ];
}
