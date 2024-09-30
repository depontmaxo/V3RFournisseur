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
            'role' => 'fournisseur',
            'statut' => 'actif',
        ]);
        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(), // Generate a UUID for the id
            'neq'=> '75321',
            'email'=> 'rogue@test.com',
            'password' =>'$2y$10$t8Euw.TibLX07KUYzMMrKu7Q4Wvi4hrHP3DwewiXaDEe6bHYMhBzS', //test
            'nomFournisseur' => 'rogue',
            'adresse' => '123 rogue rd',
            'noTelephone' => '(444)-444-4444',
            'personneRessource' => 'gambit',
            'emailPersonneRessource' => 'gambit@test.com',
            'licenceRBQ' => 'licence',
            'posteOccupeEntreprise' => 'superhero',
            'siteWeb' => 'xmen.com',
            'produitOuService' => 'saving people',
            'role' => 'fournisseur',
            'statut' => 'actif',
        ]);
        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(), // Generate a UUID for the id
            'neq'=> '54321',
            'email'=> 'commis@commis.com',
            'password' =>'$2y$10$t8Euw.TibLX07KUYzMMrKu7Q4Wvi4hrHP3DwewiXaDEe6bHYMhBzS', //test
            'nomFournisseur' => 'commis',
            'adresse' => '321 commis rd',
            'noTelephone' => '(222)-222-2222',
            'personneRessource' => 'jane',
            'emailPersonneRessource' => 'jane@commis.com',
            'licenceRBQ' => 'licence',
            'posteOccupeEntreprise' => 'commis',
            'siteWeb' => 'commis.com',
            'produitOuService' => 'commission',
            'role' => 'commis',
            'statut' => 'actif',
        ]);
        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(), // Generate a UUID for the id
            'neq'=> '987654321',
            'email'=> 'responsable@responsable.com',
            'password' =>'$2y$10$t8Euw.TibLX07KUYzMMrKu7Q4Wvi4hrHP3DwewiXaDEe6bHYMhBzS', //test
            'nomFournisseur' => 'responsable',
            'adresse' => '321 responsable rd',
            'noTelephone' => '(333)-333-3333',
            'personneRessource' => 'chloe',
            'emailPersonneRessource' => 'chloe@responsable.com',
            'licenceRBQ' => 'licence',
            'posteOccupeEntreprise' => 'responsable',
            'siteWeb' => 'resposable.com',
            'produitOuService' => 'rasponsabilite',
            'role' => 'responsable',
            'statut' => 'actif',
        ]);
    }
}
