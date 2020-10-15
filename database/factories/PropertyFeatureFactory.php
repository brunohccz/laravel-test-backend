<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Property;
use App\PropertyFeature;
use App\PropertyFeatureType;
use Faker\Generator as Faker;

$factory->define(PropertyFeature::class, function (Faker $faker) {
    return [
        'property_id'       => factory(Property::class)->create()->id,
        'property_type_id'  => factory(PropertyFeatureType::class)->create()->id,
        'value'             => $faker->sentence
    ];
});
