<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    public $table = "files";

    public $primaryKey = "id";

    public $fillable = [
        "name",
        "location",
        "tags",
        "mime",
        "size",
        "details",
        "is_published",
        "user",
        "order"
    ];

    public static $rules = [
        "location" => 'required',
    ];

    public function category()
    {
        return $this->belongsTo(\Yab\Quarx\Models\Categories::class, 'file_category_id');
    }

}
