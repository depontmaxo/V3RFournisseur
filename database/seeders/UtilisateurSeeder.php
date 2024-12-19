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
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Microsoft',
            'neq' => '1123897461',
            'email' => 'admin@microsoft.com',
            'password' => bcrypt('password123'),
            'statut' => 'Actif',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Amazon',
            'neq' => '2258374912',
            'email' => 'contact@amazon.com',
            'password' => bcrypt('securepass'),
            'statut' => 'Inactif',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Facebook',
            'neq' => '3381276540',
            'email' => 'info@facebook.com',
            'password' => bcrypt('fbsecure'),
            'statut' => 'En attente',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Tesla',
            'neq' => '8836752109',
            'email' => 'support@tesla.com',
            'password' => bcrypt('teslapass'),
            'statut' => 'Refusé',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Apple',
            'neq' => '1147856392',
            'email' => 'support@apple.com',
            'password' => bcrypt('apple1234'),
            'statut' => 'Actif',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Netflix',
            'neq' => '2293456710',
            'email' => 'admin@netflix.com',
            'password' => bcrypt('stream123'),
            'statut' => 'Inactif',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Adobe',
            'neq' => '3350194728',
            'email' => 'support@adobe.com',
            'password' => bcrypt('creative123'),
            'statut' => 'En attente',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Spotify',
            'neq' => '8819625307',
            'email' => 'contact@spotify.com',
            'password' => bcrypt('music123'),
            'statut' => 'Actif',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Slack',
            'neq' => '1164028573',
            'email' => 'admin@slack.com',
            'password' => bcrypt('work123'),
            'statut' => 'Refusé',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Zoom',
            'neq' => '2237694815',
            'email' => 'contact@zoom.com',
            'password' => bcrypt('zoom1234'),
            'statut' => 'Inactif',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'LinkedIn',
            'neq' => '3375096842',
            'email' => 'admin@linkedin.com',
            'password' => bcrypt('linkedinpass'),
            'statut' => 'En attente',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Twitter',
            'neq' => '8891532064',
            'email' => 'support@twitter.com',
            'password' => bcrypt('tweet123'),
            'statut' => 'Actif',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Snapchat',
            'neq' => '1125783946',
            'email' => 'admin@snapchat.com',
            'password' => bcrypt('snap1234'),
            'statut' => 'Inactif',
            'rbq' => null
        ]);

        DB::table('utilisateur')->insert([
            'id' => Str::uuid()->toString(),
            'nom_entreprise' => 'Airbnb',
            'neq' => '2204638591',
            'email' => 'contact@airbnb.com',
            'password' => bcrypt('bnbsecure'),
            'statut' => 'Actif',
            'rbq' => null
        ]);
    }
}
