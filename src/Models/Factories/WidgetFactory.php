<?php

/*
|--------------------------------------------------------------------------
| Widget Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Yab\Quarx\Models\Widget::class, function (Faker\Generator $faker) {
    return [
        'id'         => 1,
        'name'       => 'test',
        'slug'       => 'tester',
        'content'    => implode(' ', $faker->paragraphs(3)),
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
