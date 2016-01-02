<?php

namespace Mlantz\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{

    public $table = "widgets";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        "name",
        "uuid",
        "content"
    ];

    public static $rules = [

    ];

}
