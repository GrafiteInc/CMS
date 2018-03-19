<?php

/*
|--------------------------------------------------------------------------
| FAQ Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Grafite\Cms\Models\FAQ::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'question' => 'what\'s this?',
        'answer' => 'There\'s color everywhere!',
        'is_published' => 1,
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
