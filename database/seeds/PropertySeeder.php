<?php

use App\Address;
use App\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Property::class)->times(5)->create()->each(function (Property  $property) {
            $property->address()->create(
              factory(Address::class)->make()->toArray()
            );
        });
    }
}
