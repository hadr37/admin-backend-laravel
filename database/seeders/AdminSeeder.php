<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'hdr@admin.com',
            'password' => Hash::make('hdradmin123'),
            'role' => 'admin',
        ]);
    }
}
