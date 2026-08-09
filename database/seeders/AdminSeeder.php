<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN ACCOUNT
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

        // USER ACCOUNT 1
        User::updateOrCreate(
            ['email' => 'user@valena.com'],
            [
                'name'       => 'User',
                'username'   => 'User',
                'f_name'     => 'User',
                'l_name'     => 'User ',
                'phone'      => '09171234567',
                'address'    => 'Lal-lo, Cagayan',
                'password'   => Hash::make('password'),
                'status'     => true,
                'is_admin'   => false,
            ]
        );

        // USER ACCOUNT 2
        User::updateOrCreate(
            ['email' => 'user1@valena.com'],
            [
                'name'       => 'Maria Santos',
                'username'   => 'maria',
                'f_name'     => 'Maria',
                'l_name'     => 'Santos',
                'phone'      => '09181234567',
                'address'    => 'Aparri, Cagayan',
                'password'   => Hash::make('password'),
                'status'     => true,
                'is_admin'   => false,
            ]
        );
    }
}
