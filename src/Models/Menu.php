<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $table = 'menus';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];
}
