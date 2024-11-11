<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            'id' => '1', // Generate a UUID for the id
            'utilisateur_id' => '715d5018-33da-41dc-ae12-30da537cee9f',
            'prenom' => 'Jesus',
            'nom' => 'Marie',
            'poste'=> 'Big boss',
            'email_contact'=> 'dontfawk@withtheboss.com',
            'num_contact' =>'1112223333'
        ]);

        DB::table('contacts')->insert([
            'id' => '2', // Generate a UUID for the id
            'utilisateur_id' => '2def5921-67c3-4340-85f1-bdb87f9207b6',
            'prenom' => 'Gérar',
            'nom' => 'Bertrand',
            'poste'=> 'Contable senior',
            'email_contact'=> 'vieux@crisse.com',
            'num_contact' =>'1'
        ]);
    }
}
