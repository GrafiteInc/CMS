<?php

/*
|--------------------------------------------------------------------------
| Links Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Yab\Quarx\Models\Links::class, function (Faker\Generator $faker) {
    return [

        'id' => 1,
        'name' => 'dumb',
        'external' => 1,
        'page_id' => 0,
        'menu_id' => 1,
        'external_url' => 'http://facebook.com',
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),

    ];
});
