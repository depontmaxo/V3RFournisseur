<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CoordonneesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coordonnees')->insert([
            'id' => '1', // Generate a UUID for the id
            'utilisateur_id' => '715d5018-33da-41dc-ae12-30da537cee9f',
            'adresse' => '123 Street',
            'bureau'=> '103',
            'ville'=> 'Gatineau',
            'province' =>'Québec', 
            'code_postal' => 'J9X2V5',
            'pays' => 'Canada',
            'siteweb' => 'test',
            'num_telephone' => '8191234567',
        ]);

        DB::table('coordonnees')->insert([
            'id' => '2', // Generate a UUID for the id
            'utilisateur_id' => '2def5921-67c3-4340-85f1-bdb87f9207b6',
            'adresse' => '213 Street',
            'bureau'=> 'test',
            'ville'=> 'Trois-Rivieres',
            'province' =>'Québec', 
            'code_postal' => 'A1A1A1',
            'pays' => 'Canada',
            'siteweb' => 'test',
            'num_telephone' => '8191234567',
        ]);
    }
}
