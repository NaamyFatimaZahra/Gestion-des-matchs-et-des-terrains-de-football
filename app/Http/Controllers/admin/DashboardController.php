<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\TerrainRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
     private $terrainRepository;
     private $userRepository;
    public function __construct(TerrainRepositoryInterface $terrainRepository, UserRepositoryInterface $userRepository){
        $this->terrainRepository = $terrainRepository;
        $this->userRepository = $userRepository;
    }
   
    public function index()
    {
      
        $ActiveTerrains = $this->terrainRepository->getAllWithoutTrashed();
        $allTerrains = $this->terrainRepository->getAll();
        
    $proprietaires = $this->userRepository->getOwners();
    $joueurs = $this->userRepository->getPlayers();
   
    
    // Calcul des statistiques par nombre de réservations
    $noReservations = 0;
    $oneToFourReservations = 0;
    $fiveToTenReservations = 0;
    $moreThanTenReservations = 0;
    $depassedFiveReservations= 0;
    // Parcourir les terrains du propriétaire et compter leurs réservations
    foreach ($allTerrains as $terrain) {
        $count = isset($terrain->reservationsCount) ? count($terrain->reservationsCount) : 0;
        // Si vous utilisez Eloquent, vous pourriez aussi utiliser: $count = $terrain->reservations()->count();
        
        if ($count === 0) {
            $noReservations++;
        } elseif ($count >= 1 && $count <= 4) {
            $oneToFourReservations++;
        } elseif ($count >= 5 && $count <= 10) {
            $fiveToTenReservations++;
        } elseif ($count >= 5 ) {
                $depassedFiveReservations++;
            } else { 
            $moreThanTenReservations++;
        }
    }
   
   


    return view('admin.index', [
        'ActiveTerrains' => count($ActiveTerrains),
        'allTerrains' => $allTerrains,
        'proprietaires' => count($proprietaires),
        'joueurs' => count($joueurs),
        'noReservations' => $noReservations,
        'oneToFourReservations' => $oneToFourReservations,
        'fiveToTenReservations' => $fiveToTenReservations,
        'moreThanTenReservations' => $moreThanTenReservations,
            'depassedFiveReservations'=> $depassedFiveReservations
    ]);
    }
}