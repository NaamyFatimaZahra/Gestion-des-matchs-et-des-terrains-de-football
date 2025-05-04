<?php

namespace App\Http\Controllers\joueur;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\ReservationRepositoryInterface;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $reservationRepository;

 
    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

   
    public function getReservationsByDate($date,$terrainId,$squadId)
    {
      $rservations=$this->reservationRepository->getReservationsByDate($date,$terrainId,$squadId);
        return response()->json($rservations);
    }
    public function addReservations(Request $request)
{
    try {
        // Validation des données de requête
        $validated = $request->validate([
            'date' => 'required|date',
            'terrain_id' => 'required|exists:terrains,id',
            'squad_id' => 'required|exists:squads,id',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        ]);

        // Conversion des heures en minutes pour les vérifications
        list($startHours, $startMinutes) = explode(':', $request->heure_debut);
        list($endHours, $endMinutes) = explode(':', $request->heure_fin);
        
        $startTotalMinutes = $startHours * 60 + $startMinutes;
        $endTotalMinutes = $endHours * 60 + $endMinutes;

        // Vérification des plages horaires interdites
        // Plage 13h30-14h30
        $debutInterdit1 = 13 * 60 + 30;
        $finInterdit1 = 14 * 60 + 30;
        
        // Plage 00h00-08h00
        $debutInterdit2 = 0;
        $finInterdit2 = 8 * 60;
        
        if ($startTotalMinutes < $finInterdit1 && $endTotalMinutes > $debutInterdit1) {
            return response()->json([
                'success' => false,
                'message' => 'Les réservations entre 13h30 et 14h30 ne sont pas disponibles'
            ], 422);
        }
        
        if ($startTotalMinutes < $finInterdit2 && $endTotalMinutes > $debutInterdit2) {
            return response()->json([
                'success' => false,
                'message' => 'Les réservations entre minuit et 8h00 ne sont pas disponibles'
            ], 422);
        }

        // Vérification des réservations existantes
        $existingReservations = $this->reservationRepository->checkOverlappingReservations(
            $request->date,
            $request->terrain_id,
            $request->heure_debut,
            $request->heure_fin
        );

        if ($existingReservations->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cette plage horaire est déjà réservée'
            ], 422);
        }

        // Création de la réservation
        $reservation = $this->reservationRepository->createReservation([
            'terrain_id' => $request->terrain_id,
            'squad_id' => $request->squad_id,
            'date_reservation' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        
        ]);

       

        return response()->json([
            'success' => true,
            'message' => 'Réservation créée avec succès',
            'reservation' => $reservation
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue lors de la création de la réservation',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function getReservationsBySquad($id){
    $reservationBySquad=$this->reservationRepository->getReservationsBySquadId($id);
    return response()->json($reservationBySquad);
}

  
}