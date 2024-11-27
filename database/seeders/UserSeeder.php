<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '1', //generer id
            'email' => 'John@commis.com',
            'role' => 'commis',
            'password' => Hash::make('1234'), // N'oublie pas de hasher le mot de passe
            'is_admin' => false,
        ]);

        User::create([
            'id' => '2', //generer id
            'email' => 'Max@responsable.com',
            'role' => 'responsable',
            'password' => Hash::make('1234'),
            'is_admin' => false,
        ]);

        User::create([
            'id' => '3', //generer id
            'email' => 'Isaac@admin.com',
            'role' => 'admin',
            'password' => Hash::make('1234'),
            'is_admin' => true,
        ]);
    }
}
