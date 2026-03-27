<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Admin1 Louis Game Store',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('password123'),
            'role'      => 'admin',
            'pin'       => Hash::make('123456'),
        ]);

        User::create([
            'name'      => 'Alamak',
            'email'     => 'pembeli@gmail.com',
            'password'  => Hash::make('password123'),
            'role'      => 'customer',
            'pin'       => Hash::make('123456'),
        ]);

        $this->call([
            GameProductSeeder::class,
        ]);
    }
}
