<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 'id' => Str::uuid()->toString(), //generer uuid automatiquement
     */
    public function run(): void
    {
      DB::table('utilisateur')->insert([
            'id' => '715d5018-33da-41dc-ae12-30da537cee9f', // Generate a UUID for the id
            'nom_entreprise' => 'Google',
            'neq'=> '12345',
            'email'=> 'test@test.com',
            'password' =>'$2y$10$t8Euw.TibLX07KUYzMMrKu7Q4Wvi4hrHP3DwewiXaDEe6bHYMhBzS', //test
            'role' => 'fournisseur',
            'statut' => 'Actif',
            'rbq' => 'licence rbq'
        ]);

        DB::table('utilisateur')->insert([
            'id' => '2def5921-67c3-4340-85f1-bdb87f9207b6', // Generate a UUID for the id
            'nom_entreprise' => 'Cahier Serway inc',
            'neq'=> '75321',
            'email'=> 'rogue@test.com',
            'password' =>'$2y$10$t8Euw.TibLX07KUYzMMrKu7Q4Wvi4hrHP3DwewiXaDEe6bHYMhBzS', //test
            'role' => 'fournisseur',
            'statut' => 'Actif',
            'rbq' => 'licence rbq'
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(), // Generate a UUID for the id
            'nom_entreprise' => 'Commis',
            'neq'=> '54321',
            'email'=> 'commis@commis.com',
            'password' =>'$2y$10$t8Euw.TibLX07KUYzMMrKu7Q4Wvi4hrHP3DwewiXaDEe6bHYMhBzS', //test
            'role' => 'commis',
            'statut' => 'Actif',
            'rbq' => 'licence rbq'
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(), // Generate a UUID for the id
            'nom_entreprise' => 'Responsable',
            'neq'=> '987654321',
            'email'=> 'responsable@responsable.com',
            'password' =>'$2y$10$t8Euw.TibLX07KUYzMMrKu7Q4Wvi4hrHP3DwewiXaDEe6bHYMhBzS', //test
            'role' => 'responsable',
            'statut' => 'Actif',
            'rbq' => 'licence rbq'
        ]);

/*
        DB::table('users')->insert([
            'email'=> 'test@commis.com',
            'rôle' => 'commis',     
        ]); */
    }

   
}
