<?php

/*
|--------------------------------------------------------------------------
| Widget Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Mlantz\Quarx\Models\Widgets::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'name' => 'test',
        'uuid' => 'tester',
        'content' => implode(' ', $faker->paragraphs(3)),
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
