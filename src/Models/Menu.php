<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public $table = "menus";

    public $primaryKey = "id";

    public $fillable = [
        "name",
        "uuid"
    ];

    public static $rules = [
        "name" => "required"
    ];

}
