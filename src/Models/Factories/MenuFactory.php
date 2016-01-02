<?php

/*
|--------------------------------------------------------------------------
| Menu Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Mlantz\Quarx\Models\Menu::class, function (Faker\Generator $faker) {
    return [

        'id' => 1,
        'name' => 'dumb menu',
        'uuid' => 'testerUUID',
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),

    ];
});
