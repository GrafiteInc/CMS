<?php

/*
|--------------------------------------------------------------------------
| Widget Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Grafite\Cms\Models\Widget::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'name' => 'test',
        'slug' => 'tester',
        'content' => implode(' ', $faker->paragraphs(3)),
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
