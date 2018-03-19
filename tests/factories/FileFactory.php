<?php

/*
|--------------------------------------------------------------------------
| Files Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Grafite\Cms\Models\File::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'location' => 'files/dumb',
        'name' => 'dumbFile',
        'tags' => 'dumb, file',
        'mime' => 'txt',
        'size' => 24,
        'details' => 'dumb file',
        'user' => 1,
        'is_published' => 1,
        'order' => 1,
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
