<?php

use App\PropertyFeatureType;
use Illuminate\Database\Seeder;

class PropertyFeatureTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PropertyFeatureType::class)->times(5)->create();
    }
}
