<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
             #'name' => 'Jonh',
            'email' => 'Jonh@commis.com',
            'password' => Hash::make('1234'), // N'oublie pas de hasher le mot de passe
            'is_admin' => false,
        ]);

        User::create([
           # 'name' => 'Max',
            'email' => 'Max@responsable.com',
            'password' => Hash::make('1234'),
            'is_admin' => false,
        ]);

        User::create([
           # 'name' => 'Isaac',
            'email' => 'Isaac@admin.com',
            'password' => Hash::make('1234'),
            'is_admin' => true,
        ]);
    }
}
