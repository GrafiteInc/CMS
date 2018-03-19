<?php

/*
|--------------------------------------------------------------------------
| Blog Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Grafite\Cms\Models\Blog::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'title' => 'dumb',
        'entry' => $faker->paragraph().' '.$faker->paragraph(),
        'is_published' => 1,
        'url' => 'dumb',
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
