<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'awards' => $faker->numberBetween(1, 50),
        'release_date' => $faker->dateTime,
        'length' => $faker->numberBetween(1, 500),
        'rating' => $faker->numberBetween(1, 10),
    ];
});
