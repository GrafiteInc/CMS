<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    public $table = 'archives';

    public $primaryKey = 'id';

    public $fillable = [
        'token',
        'entity_id',
        'entity_type',
        'entity_data',
    ];

    public static $rules = [];
}
