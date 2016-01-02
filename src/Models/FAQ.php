<?php

namespace Mlantz\Quarx\Models;

use Illuminate\Database\Eloquent\Model;


class FAQ extends Model
{

    public $table = "faqs";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        "question",
        "answer",
        "is_published"
    ];

    public static $rules = [

    ];

}
