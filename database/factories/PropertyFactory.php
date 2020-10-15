<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
    return [
        'owner_email' => $faker->email,
        'title'       => $faker->sentence,
        'description' => $faker->text(200)
    ];
})->afterCreating(Property::class, function (Property $property, Faker $faker) {
    $property->address()->create([
        'state'         => 'SP',
        'city'          => 'São Paulo',
        'district'      => 'Vila Jaguara',
        'street'        => $faker->name,
        'number'        => '1000'
    ]);
});
