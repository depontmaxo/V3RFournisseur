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
           'id' => (string) \Illuminate\Support\Str::uuid(),
                'email' => 'Yann@admin.com',
                'password' => Hash::make('password123'), // Mot de passe sécurisé
                'role' => 'admin',
                'is_admin' => true,
        ]);

        User::create([
          'id' => (string) \Illuminate\Support\Str::uuid(),
                'email' => 'Max@responsable.com',
                'password' => Hash::make('password123'),
                'role' => 'responsable',
                'is_admin' => false,
        ]);

        User::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'email' => 'John@commis.com',
            'password' => Hash::make('password123'),
            'role' => 'commis',
            'is_admin' => false,
        ]);

         // Insérer les utilisateurs dans la base de données
        // foreach ($users as $user) {
          //  User::create($user);
     //   }

    }
}
