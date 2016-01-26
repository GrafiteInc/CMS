<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;


class FAQ extends Model
{

    public $table = "faqs";

    public $primaryKey = "id";

    public $fillable = [
        "question",
        "answer",
        "is_published"
    ];

    public static $rules = [

    ];

}
