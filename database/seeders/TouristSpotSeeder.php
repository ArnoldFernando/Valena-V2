<?php

namespace Database\Seeders;

use App\Models\TouristSpot;
use Illuminate\Database\Seeder;

class TouristSpotSeeder extends Seeder
{
    public function run(): void
    {
        TouristSpot::firstOrCreate(
            ['ts_id' => 2, 'image' => null],
            [
                'name'              => 'Campus Brew Cafe',
                'intro_description' => 'Campus Brew Cafe',
                'full_description'  => 'Campus Brew Cafe is a modern and cozy cafeteria facility designed to serve students, staff, and visitors.',
            ]
        );

        TouristSpot::firstOrCreate(
            ['ts_id' => 3, 'image' => null],
            [
                'name'              => 'Valena View Deck',
                'intro_description' => 'A 100-step viewdeck',
                'full_description'  => 'Valena View Deck is a scenic spot offering panoramic views of the rolling hills, lush valleys, and winding rivers of Cagayan province.',
            ]
        );
    }
}
