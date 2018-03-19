<?php

/*
|--------------------------------------------------------------------------
| Images Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Grafite\Cms\Models\Image::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'location' => 'files/dumb',
        'name' => 'dumb',
        'original_name' => 'dumb',
        'alt_tag' => 'dumb',
        'title_tag' => 'dumb',
        'is_published' => 1,
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
