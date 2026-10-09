<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'lionel_madun',
            'password' => Hash::make('rahasia123'), 
            'nama_lengkap' => 'Ronaldo budi',
        ]);

        User::create([
            'username' => 'kasfa_tamvan_banget',
            'password' => Hash::make('password123'),
            'nama_lengkap' => 'leonardo kasfa rakha faza',
        ]);
    }
}
