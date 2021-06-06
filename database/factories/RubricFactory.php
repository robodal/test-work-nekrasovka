<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rubric;
use Faker\Generator as Faker;

$factory->define(Rubric::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
    ];
});
