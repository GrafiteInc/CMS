<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Translatable;

    public $table = 'pages';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
        'url' => 'required',
    ];

    protected $appends = [
        'translations'
    ];
}
