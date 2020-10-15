<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PropertyFeatureType;
use Faker\Generator as Faker;

$factory->define(PropertyFeatureType::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
