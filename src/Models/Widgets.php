<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{

    public $table = "widgets";

    public $primaryKey = "id";

    public $fillable = [
        "name",
        "slug",
        "content"
    ];

    public static $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

}
