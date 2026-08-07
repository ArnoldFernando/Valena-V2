<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        Facility::firstOrCreate(
            ['fac_id' => 1, 'image' => null],
            [
                'name'              => 'Coffee Hub Cafe',
                'intro_description' => 'Campus Cafe',
                'full_description'  => 'Campus Brew Cafe is a modern and cozy cafeteria facility designed to serve students, staff, and visitors with a variety of freshly brewed coffee-based drinks, light meals, and locally inspired delicacies.',
            ]
        );
    }
}
