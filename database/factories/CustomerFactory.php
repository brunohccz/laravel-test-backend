<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name'      => $faker->name,
        'email'     => $faker->email,
        'type'      => $type = $faker->randomElement([Customer::NATURAL_PERSON, Customer::LEGAL_PERSON]),
        'document'  => $type === Customer::NATURAL_PERSON ? '72813031062' : '17902791000148'
    ];
});
