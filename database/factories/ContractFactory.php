<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contract;
use Faker\Generator as Faker;

$factory->define(Contract::class, function (Faker $faker) {
    return [
        'property_id' => factory(\App\Property::class)->create()->id,
        'customer_id' => factory(\App\Customer::class)->create()->id
    ];
});
