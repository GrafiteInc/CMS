<?php

namespace Yab\Quarx\Models;

use Yab\Quarx\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Translatable;

    public $table = 'events';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
    ];

    protected $appends = [
        'translations'
    ];
}
