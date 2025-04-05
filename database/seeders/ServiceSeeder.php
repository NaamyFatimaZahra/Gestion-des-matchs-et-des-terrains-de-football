<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Vestiaires avec douches et toilettes',
            'Éclairage du terrain pour les matchs en soirée',
            'Bancs couverts pour les remplaçants',
            'Distributeurs d\'eau ou fontaines',
            'Petite cafétéria ou espace de restauration',
            'Parking sécurisé',
            'Casiers personnels pour ranger les affaires',
            'Salle de premiers soins/infirmerie',
            'Zones d\'échauffement',
            'Tableau d\'affichage du score',
            'Système de sonorisation',
            'Wifi gratuit dans les espaces communs',
            'Service de nettoyage des chaussures/crampons',
            'Espace de détente après-match',
        ];

        foreach ($services as $serviceName) {
            Service::create([
                'name' => $serviceName,
            ]);
        }
    }
}
