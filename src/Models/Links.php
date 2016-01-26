<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;


class Links extends Model
{

    public $table = "links";

    public $primaryKey = "id";

    public $fillable = [
        "name",
        "external",
        "page_id",
        "menu_id",
        "external_url",
    ];

    public static $rules = [
        "name" => "required"
    ];

}
