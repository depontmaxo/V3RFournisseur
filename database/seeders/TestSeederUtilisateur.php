<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TestSeederUtilisateur extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 9000; $i++){
            /*DB::table('utilisateur')->insert([
                'id' => Str::uuid()->toString(), // Generate a UUID for the id
                'neq'=> "NEQ #$i",
                'email'=> Str::random(10),
                'password' =>Hash::make('test'), //test
                'nomFournisseur' => Str::random(10),
                'adresse' => Str::random(10),
                'noTelephone' => Str::random(10),
                'personneRessource' => Str::random(10),
                'emailPersonneRessource' => Str::random(10),
                'licenceRBQ' => Str::random(10),
                'posteOccupeEntreprise' => Str::random(10),
                'siteWeb' => Str::random(10),
                'produitOuService' => Str::random(10),
                'role' => 'fournisseur',
                'statut' => 'actif',
            ]);*/
        }

    }
}
