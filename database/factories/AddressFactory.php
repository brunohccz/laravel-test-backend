<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'state'         => 'SP',
        'city'          => 'São Paulo',
        'district'      => 'Vila Jaguara',
        'street'        => $faker->name,
        'number'        => '1000'
    ];
});
