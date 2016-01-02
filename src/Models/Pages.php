<?php

namespace Mlantz\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{

    public $table = "pages";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        "title",
        "url",
        "entry",
        "seo_description",
        "seo_keywords",
        "is_published",
        "template_id"
    ];

    public static $rules = [

    ];

}
