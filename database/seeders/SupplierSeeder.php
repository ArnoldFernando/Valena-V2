<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::firstOrCreate(
            ['title' => 'Valena.Net'],
            [
                'email'   => 'csu@gmail.com',
                'phone'   => '09123456789',
                'url'     => 'csu.edu.ph',
                'o_hr'    => '8:00 AM',
                'c_hr'    => '5:00 PM',
                'o_days'  => 'Mon–Fri',
                'address' => 'CSU Lal-lo',
                'image'   => null,
            ]
        );
    }
}
