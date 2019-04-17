<?php
/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Review::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'text'  => $faker->text(100),
        'score' => rand(1, 5),
    ];
});
