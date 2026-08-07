<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@valena.com'],
            [
                'name'       => 'Admin',
                'username'   => 'admin',
                'f_name'     => 'Admin',
                'l_name'     => 'Valena',
                'phone'      => '',
                'address'    => 'CSU Lal-lo',
                'password'   => Hash::make('password'),
                'status'     => true,
                'is_admin'   => true,
            ]
        );
    }
}
