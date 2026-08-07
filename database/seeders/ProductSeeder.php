<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $supplier = Supplier::where('title', 'Valena.Net')->first();

        if (! $supplier) {
            return;
        }

        $products = [
            [
                'prod_id'      => 101,
                'title'        => 'Valena Heritage Coffee',
                'slogan'       => '200 grams',
                'price'        => 295.00,
                'stocks'       => 20,
                'promo_status' => 'No',
            ],
            [
                'prod_id'      => 102,
                'title'        => 'Urdujah Premium Blend',
                'slogan'       => '200g',
                'price'        => 380.00,
                'stocks'       => 15,
                'promo_status' => 'No',
            ],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(
                ['prod_id' => $p['prod_id'], 'img' => null],
                array_merge($p, ['sup_id' => $supplier->sup_id, 'total_ordered' => 0])
            );
        }
    }
}
