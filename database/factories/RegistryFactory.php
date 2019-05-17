<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Registry;
use Faker\Generator as Faker;

$factory->define(Registry::class, function (Faker $faker) {
    return [
            'when' => $faker->dateTime(),
            'O3' => $faker->randomFloat(1,5, 0.01),
            'NO' => $faker->randomFloat(1,5, 0.01),
            'NO2' => $faker->randomFloat(1,5, 0.01),
            'NOx' => $faker->randomFloat(1,5, 0.01),
            'CO' => $faker->randomFloat(1,5, 0.01),
            'SO2' => $faker->randomFloat(1,5, 0.01),
            'PM25' => $faker->randomFloat(1,5, 0.01),
    ];
});
