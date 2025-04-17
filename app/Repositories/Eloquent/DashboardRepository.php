<?php

namespace App\Repositories\Eloquent;

use App\Models\Terrain;
use App\Repositories\Interface\DashboardRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardRepositoryInterface
{
    /**
     * Récupérer tous les terrains
     * 
     * @return array
     */
    public function getAllTerrains(): array
    {
        return Terrain::all()->toArray();
    }
    
    /**
     * Récupérer l'évolution des terrains par rapport au mois dernier
     * 
     * @return array
     */
    public function getTerrainEvolution(): array
    {
        $now = Carbon::now();
        $startOfCurrentMonth = $now->copy()->startOfMonth();
        $startOfPreviousMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfPreviousMonth = $now->copy()->subMonth()->endOfMonth();
        
        // Compter les terrains du mois en cours
        $currentMonthCount = Terrain::where('created_at', '>=', $startOfCurrentMonth)
            ->count();
            
        // Compter les terrains du mois précédent
        $previousMonthCount = Terrain::whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])
            ->count();
            
        // Calculer l'évolution en pourcentage
        $difference = $currentMonthCount - $previousMonthCount;
        $pourcentage = $previousMonthCount > 0 
            ? round(($difference / $previousMonthCount) * 100) 
            : 0;
            
        return [
            'difference' => $difference,
            'pourcentage' => $pourcentage,
            'actuel' => $currentMonthCount,
            'precedent' => $previousMonthCount,
        ];
    }
    
    /**
     * Récupérer les statistiques des terrains pour le dashboard
     * 
     * @return array
     */
    public function getTerrainStats(): array
    {
        $total = Terrain::count();
        $evolution = $this->getTerrainEvolution();
        
        // Calculer le taux de complétion (exemple: basé sur objectif mensuel)
        $objectifMensuel = 5000; // à adapter selon vos besoins
        $completion = round(($total / $objectifMensuel) * 100);
        
        return [
            'total' => $total,
            'evolution' => $evolution['difference'] ?? 0,
            'pourcentage' => $evolution['pourcentage'] ?? 0,
            'completion' => min(100, $completion), // Maximum 100%
        ];
    }
}