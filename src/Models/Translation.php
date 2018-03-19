<?php

namespace Grafite\Quarx\Models;

class Translation extends QuarxModel
{
    public $table = 'translations';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [];

    protected $fillable = [
        'entity_id',
        'entity_type',
        'entity_data',
        'language',
    ];

    public function getDataAttribute()
    {
        $object = app($this->entity_type);

        $attributes = (array) json_decode($this->entity_data);
        $object->attributes = array_merge($attributes, [
            'id' => $this->entity_id,
        ]);

        return $object;
    }
}
