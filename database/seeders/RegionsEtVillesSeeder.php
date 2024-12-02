<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\RegionAdministrative;
use App\Models\Ville;

class RegionsEtVillesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['region' => 'Bas-Saint-Laurent', 'code' => '01'],
            ['region' => 'Saguenay–Lac-Saint-Jean', 'code' => '02'],
            ['region' => 'Capitale-Nationale', 'code' => '03'],
            ['region' => 'Mauricie', 'code' => '04'],
            ['region' => 'Estrie', 'code' => '05'],
            ['region' => 'Montréal', 'code' => '06'],
            ['region' => 'Outaouais', 'code' => '07'],
            ['region' => 'Abitibi-Témiscamingue', 'code' => '08'],
            ['region' => 'Côte-Nord', 'code' => '09'],
            ['region' => 'Nord-du-Québec', 'code' => '10'],
            ['region' => 'Gaspésie–Îles-de-la-Madeleine', 'code' => '11'],
            ['region' => 'Chaudière-Appalaches', 'code' => '12'],
            ['region' => 'Laval', 'code' => '13'],
            ['region' => 'Lanaudière', 'code' => '14'],
            ['region' => 'Laurentides', 'code' => '15'],
            ['region' => 'Montérégie', 'code' => '16'],
            ['region' => 'Centre-du-Québec', 'code' => '17'],
        ];

        // Insérer les régions administratives
        foreach ($regions as $region) {
            RegionAdministrative::create($region);
        }


        // Ajouter des villes liées aux régions
        $villes = [
            ['ville' => 'Rimouski', 'region_code' => '01'], // Bas-Saint-Laurent
            ['ville' => 'Rivière-du-Loup', 'region_code' => '01'],
            ['ville' => 'Saguenay', 'region_code' => '02'], // Saguenay–Lac-Saint-Jean
            ['ville' => 'Alma', 'region_code' => '02'],
            ['ville' => 'Québec', 'region_code' => '03'], // Capitale-Nationale
            ['ville' => 'Baie-Saint-Paul', 'region_code' => '03'],
            ['ville' => 'Trois-Rivières', 'region_code' => '04'], // Mauricie
            ['ville' => 'Shawinigan', 'region_code' => '04'],
            ['ville' => 'Sherbrooke', 'region_code' => '05'], // Estrie
            ['ville' => 'Magog', 'region_code' => '05'],
            ['ville' => 'Montréal', 'region_code' => '06'], // Montréal
            ['ville' => 'Gatineau', 'region_code' => '07'], // Outaouais
            ['ville' => 'Rouyn-Noranda', 'region_code' => '08'], // Abitibi-Témiscamingue
            ['ville' => 'Val-d\'Or', 'region_code' => '08'],
            ['ville' => 'Sept-Îles', 'region_code' => '09'], // Côte-Nord
            ['ville' => 'Baie-Comeau', 'region_code' => '09'],
            ['ville' => 'Chibougamau', 'region_code' => '10'], // Nord-du-Québec
            ['ville' => 'Gaspé', 'region_code' => '11'], // Gaspésie–Îles-de-la-Madeleine
            ['ville' => 'Thetford Mines', 'region_code' => '12'], // Chaudière-Appalaches
            ['ville' => 'Lévis', 'region_code' => '12'],
            ['ville' => 'Laval', 'region_code' => '13'], // Laval
            ['ville' => 'Joliette', 'region_code' => '14'], // Lanaudière
            ['ville' => 'Saint-Jérôme', 'region_code' => '15'], // Laurentides
            ['ville' => 'Longueuil', 'region_code' => '16'], // Montérégie
            ['ville' => 'Brossard', 'region_code' => '16'],
            ['ville' => 'Drummondville', 'region_code' => '17'], // Centre-du-Québec
            ['ville' => 'Victoriaville', 'region_code' => '17'],
        ];

         // Insérer les villes
         foreach ($villes as $ville) {
            Ville::create($ville);
        }

    }
}
