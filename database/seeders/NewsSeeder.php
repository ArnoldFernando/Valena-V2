<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::firstOrCreate(
            ['news_number' => 8],
            [
                'name'              => 'Launching of Valena View Deck and Cafe',
                'intro_description' => 'CoffeeHub program unveils Coffee shop, Valena Viewdeck at CSU Lal-lo to help boost coffee industry in Cagayan.',
                'full_description'  => 'The CoffeeHub program launched a new cafe and view deck to support local coffee tourism at CSU Lal-lo campus.',
                'date'              => '2025-08-14',
                'image'             => null,
            ]
        );
    }
}
