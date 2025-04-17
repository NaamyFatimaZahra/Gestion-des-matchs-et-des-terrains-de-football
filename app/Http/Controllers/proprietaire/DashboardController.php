<?php

namespace App\Http\Controllers\proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Repositories\Interface\CommentRepositoryInterface;
use App\Repositories\Interface\DashboardRepositoryInterface;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\TerrainRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private $terrainRepository;
    private $reservationRepository;
    private $commentRepository;

    public function __construct(
        TerrainRepositoryInterface $terrainRepository,
        ReservationRepositoryInterface $reservationRepository,
        CommentRepositoryInterface $commentRepository,
    )
    {
        $this->terrainRepository = $terrainRepository;
        $this->reservationRepository = $reservationRepository;
        $this->commentRepository = $commentRepository;
    }

 
  public function index()
{
    // Récupération des données de base
    $terrains = $this->terrainRepository->getAllByProprietaire();
    $allReservations = $this->reservationRepository->getAll();
    $reservation = $this->reservationRepository->getReservationsByProprietaire();
    $comment = $this->commentRepository->getCommentsByProprietaire();
    $allTerrains = $this->terrainRepository->getAll();
    $allComments = $this->commentRepository->getAll();
    
    // Calcul des statistiques par nombre de réservations
    $noReservations = 0;
    $oneToFourReservations = 0;
    $fiveToTenReservations = 0;
    $moreThanTenReservations = 0;
    
    // Parcourir les terrains du propriétaire et compter leurs réservations
    foreach ($terrains as $terrain) {
        $count = isset($terrain->reservations) ? count($terrain->reservations) : 0;
        // Si vous utilisez Eloquent, vous pourriez aussi utiliser: $count = $terrain->reservations()->count();
        
        if ($count === 0) {
            $noReservations++;
        } elseif ($count >= 1 && $count <= 4) {
            $oneToFourReservations++;
        } elseif ($count >= 5 && $count <= 10) {
            $fiveToTenReservations++;
        } else { // plus de 10
            $moreThanTenReservations++;
        }
    }
    
    // Calcul des pourcentages pour les barres de progression
    $totalTerrainsCount = count($terrains);
    $percentageNoReservations = $totalTerrainsCount > 0 ? round(($noReservations / $totalTerrainsCount) * 100) : 0;
    $percentageOneToFour = $totalTerrainsCount > 0 ? round(($oneToFourReservations / $totalTerrainsCount) * 100) : 0;
    $percentageFiveToTen = $totalTerrainsCount > 0 ? round(($fiveToTenReservations / $totalTerrainsCount) * 100) : 0;
    $percentageMoreThanTen = $totalTerrainsCount > 0 ? round(($moreThanTenReservations / $totalTerrainsCount) * 100) : 0;

    return view('proprietaire.dashboard', [
        'terrains' => $terrains,
        'totalTerrains' => count($allTerrains),
        'totalReservations' => count($allReservations),
        'reservation' => count($reservation),
        'comment' => count($comment),
        'totalComments' => count($allComments),
        
        // Nouvelles statistiques pour les terrains
        'noReservations' => $noReservations,
        'oneToFourReservations' => $oneToFourReservations,
        'fiveToTenReservations' => $fiveToTenReservations,
        'moreThanTenReservations' => $moreThanTenReservations,
        
        // Pourcentages pour les barres de progression
        'percentageNoReservations' => $percentageNoReservations,
        'percentageOneToFour' => $percentageOneToFour,
        'percentageFiveToTen' => $percentageFiveToTen,
        'percentageMoreThanTen' => $percentageMoreThanTen,
    ]);
}

   
   

}