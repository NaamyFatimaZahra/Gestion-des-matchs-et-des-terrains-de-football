<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Terrain;
use Illuminate\Support\Facades\DB;

class TerrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $terrains = [
            [
                'name' => 'Stade Municipal de Casablanca',
                'proprietaire_id' => 2,
                'capacity' => 120,
                'price' => 450.00,
                'status' => 'en_attente',
                'admin_approval' => 'en_attente',
                'reservation_count' => 34,
                'description' => 'Terrain de football professionnel situé au cœur de Casablanca avec d\'excellentes installations.',
                'payment_method' => 'les_deux',
                'surface' => 'gazon_naturel',
                'city' => 'Casablanca',
                'adress' => 'Boulevard Mohammed V, Quartier Anfa',
                'latitude' => 33.5731104,
                'longitude' => -7.6425711,
                'contact' => '0522123456',
            ],
            [
                'name' => 'Terrain El Jadida',
                'proprietaire_id' => 2,
                'capacity' => 80,
                'price' => 350.00,
                'status' => 'disponible',
                'admin_approval' => 'approuve',
                'reservation_count' => 28,
                'description' => 'Terrain synthétique idéal pour les matchs à 7 joueurs, situé près de la plage.',
                'payment_method' => 'sur_place',
                'surface' => 'gazon_synthetique',
                'city' => 'El Jadida',
                'adress' => 'Avenue de la Plage, Quartier El Menzeh',
                'latitude' => 33.2568123,
                'longitude' => -8.5028615,
                'contact' => '0523456789',
            ],
            [
                'name' => 'Complexe Sportif Rabat',
                'proprietaire_id' => 2,
                'capacity' => 150,
                'price' => 550.00,
                'status' => 'disponible',
                'admin_approval' => 'approuve',
                'reservation_count' => 42,
                'description' => 'Grand complexe sportif avec plusieurs terrains, vestiaires modernes et cafétéria.',
                'payment_method' => 'en_ligne',
                'surface' => 'gazon_hybride',
                'city' => 'Rabat',
                'adress' => 'Rue Hassan II, Agdal',
                'latitude' => 34.0081782,
                'longitude' => -6.8406286,
                'contact' => '0537987654',
            ],
            [
                'name' => 'Stade Tanger Indoor',
                'proprietaire_id' => 2,
                'capacity' => 100,
                'price' => 480.00,
                'status' => 'disponible',
                'admin_approval' => 'approuve',
                'reservation_count' => 15,
                'description' => 'Terrain indoor climatisé disponible toute l\'année, même en saison pluvieuse.',
                'payment_method' => 'les_deux',
                'surface' => 'indoor_synthetique',
                'city' => 'Tanger',
                'adress' => 'Zone Industrielle, Route de Tétouan',
                'latitude' => 35.7595068,
                'longitude' => -5.8340213,
                'contact' => '0539123456',
            ],
            [
                'name' => 'Terrain Marrakech Palm',
                'proprietaire_id' => 2,
                'capacity' => 70,
                'price' => 420.00,
                'status' => 'disponible',
                'admin_approval' => 'approuve',
                'reservation_count' => 31,
                'description' => 'Terrain bien entretenu avec vue sur les montagnes de l\'Atlas, idéal pour les matchs amicaux.',
                'payment_method' => 'sur_place',
                'surface' => 'gazon_naturel',
                'city' => 'Marrakech',
                'adress' => 'Route de l\'Ourika, Quartier Palmeraie',
                'latitude' => 31.6294723,
                'longitude' => -7.9810845,
                'contact' => '0524567890',
            ],
            [
                'name' => 'Complexe Sportif Agadir',
                'proprietaire_id' => 2,
                'capacity' => 90,
                'price' => 380.00,
                'status' => 'disponible',
                'admin_approval' => 'approuve',
                'reservation_count' => 23,
                'description' => 'Terrain de football à proximité de la plage avec un beau gazon synthétique et éclairage nocturne.',
                'payment_method' => 'les_deux',
                'surface' => 'gazon_synthetique',
                'city' => 'Agadir',
                'adress' => 'Boulevard du 20 Août, Quartier Talborjt',
                'latitude' => 30.4277547,
                'longitude' => -9.5981072,
                'contact' => '0528789012',
            ]
        ];

        // Insertion des données dans la table
        foreach ($terrains as $terrain) {
            Terrain::create($terrain);
        }
    }
}