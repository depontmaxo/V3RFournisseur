<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting; 

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
    Setting::create([
        'appro_email' => 'approvisionnement@v3r.net',
        'revision_delai' => 24,
        'max_file_size' => 75,
        'email_finance' => 'finances@v3r.net',
    ]);
    }
}
