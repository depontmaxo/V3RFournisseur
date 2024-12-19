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
            'id' => '644', //generer id
            'email' => 'francoisdupont@yahoo.com',
            'role' => 'admin',
            'password' => Hash::make('Dup1234*'),
            'is_admin' => true,
        ]);

        User::create([
            'id' => '244', //generer id
            'email' => 'maximedesjardins@yahoo.com',
            'role' => 'admin',
            'password' => Hash::make('Desj2024**'),
            'is_admin' => true,
        ]);

        User::create([
            'id' => '344', //generer id
            'email' => 'isaacBelanger@gmail.com',
            'role' => 'commis',
            'password' => Hash::make('Isaac666**'),
            'is_admin' => false,
        ]);

        User::create([
            'id' => '455', //generer id
            'email' => 'pradel02@gmail.com',
            'role' => 'responsable',
            'password' => Hash::make('Patreon89**'),
            'is_admin' => false,
        ]);
    }
}
