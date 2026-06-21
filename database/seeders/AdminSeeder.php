<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name'     => 'Admin Principal',
            'email'    => 'admin@footconnect.com',
            'password' => Hash::make('password123'),
        ]);

        Vendor::create([
            'name'      => 'Vendor Principal',
            'email'     => 'vendor@footconnect.com',
            'password'  => Hash::make('password123'),
            'shop_name' => 'Ma Boutique',
            'status'    => 'approved',
        ]);
    }
}