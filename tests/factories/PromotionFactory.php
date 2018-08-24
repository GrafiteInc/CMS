<?php

/*
|--------------------------------------------------------------------------
| Promotion Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Grafite\Cms\Models\Promotion::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'published_at' => $faker->datetime()->format('Y-m-d H:i'),
        'finished_at' => $faker->datetime()->format('Y-m-d H:i'),
        'slug' => 'dumb',
        'details' => $faker->paragraph().' '.$faker->paragraph(),
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
