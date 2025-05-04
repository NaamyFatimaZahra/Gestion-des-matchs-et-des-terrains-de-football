<?php

namespace App\Repositories\Interface;

interface ReservationRepositoryInterface
{
   public function getAll();
    public function getReservationsByProprietaire();

    public function getReservationsByTerrain($terrainId);
    public function changeStatusToTermine();
     public function getReservationById($id);

    

   
    public function updateReservation($id, array $reservationData);

   
    public function deleteReservation($id);

    public function updateStatus($id, $status);
   
    public function sendConfirmationEmail($id);
    public function checkTerrainAvailability($terrainId, $date, $heureDebut, $heureFin, $excludeReservationId = null);
    public function getReservationStats($proprietaireId);
    public function getReservationsByDate($date,$terrainId,$squadId);
    public function checkOverlappingReservations($date, $terrainId, $heureDebut, $heureFin);
   public function createReservation(array $data);
   public function getReservationsBySquadId($id);


}