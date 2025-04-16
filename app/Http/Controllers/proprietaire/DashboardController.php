<?php

namespace App\Http\Controllers\proprietaire;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\DashboardRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

 
    public function index()
    {
        // Récupérer tous les terrains via le repository
        $terrains = $this->dashboardRepository->getAllTerrains();
        
        // Calculer l'évolution par rapport au mois dernier
        $evolution = $this->dashboardRepository->getTerrainEvolution();
        
        // Retourner la vue avec les données
        return view('proprietaire.dashboard', [
            'terrains' => $terrains,
            'total' => count($terrains),
            'evolution' => $evolution,
            'pourcentage' => $evolution['pourcentage'] ?? 0,
        ]);
    }

   
    public function dashboard()
    {
        // Récupérer les statistiques des terrains
        $stats = $this->dashboardRepository->getTerrainStats();
        
        return view('terrains.dashboard', [
            'totalTerrains' => $stats['total'] ?? 0,
            'evolution' => $stats['evolution'] ?? 0,
            'pourcentage' => $stats['pourcentage'] ?? 0,
            'completion' => $stats['completion'] ?? 78,
        ]);
    }

}