<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public $table = "menus";

    public $primaryKey = "id";

    public $fillable = [
        "name",
        "slug"
    ];

    public static $rules = [
        "name" => "required",
        "slug" => "required",
    ];

}
