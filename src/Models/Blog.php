<?php

namespace Mlantz\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    public $table = "blogs";

    public $primaryKey = "id";

    public $fillable = [
        "title",
        "tags",
        "entry",
        "is_published",
        "url"
    ];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

}
