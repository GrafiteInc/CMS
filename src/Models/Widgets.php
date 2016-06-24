<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
    public $table = 'widgets';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];
}
