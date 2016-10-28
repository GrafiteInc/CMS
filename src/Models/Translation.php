<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public $table = 'translations';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [];

    public function getDataAttribute()
    {
        $object = app($this->entity_type);

        $attributes = (array) json_decode($this->entity_data);
        $object->attributes = array_merge($attributes, [
            'id' => $this->entity_id
        ]);

        return $object;
    }
}
