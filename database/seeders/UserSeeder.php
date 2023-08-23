<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(50)->create();

        User::create([
            'name' => 'Hendra Lin',
            'email' => 'liem82@gmail.com',
            'phone' => '6285267008081',
            'bio' => 'flutter dev',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'info@bengkel-oprek.web.id',
            'phone' => '6285267008081',
            'bio' => 'laravel dev',
            'role' => 'superadmin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
    }
}
