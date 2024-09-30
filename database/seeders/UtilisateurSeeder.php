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
     */
    public function run(): void
    {
        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(), // Generate a UUID for the id
            'neq'=> '12345',
            'email'=> 'test@test.com',
            'password' =>'$2y$10$t8Euw.TibLX07KUYzMMrKu7Q4Wvi4hrHP3DwewiXaDEe6bHYMhBzS', //test
            'nomFournisseur' => 'test',
            'adresse' => '123 test rd',
            'noTelephone' => '(111)-111-1111',
            'personneRessource' => 'bob',
            'emailPersonneRessource' => 'bob@test.com',
            'licenceRBQ' => 'licence',
            'posteOccupeEntreprise' => 'testeur',
            'siteWeb' => 'test.com',
            'produitOuService' => 'testing',
            'statut' => 'actif',
        ]);
    }
}
