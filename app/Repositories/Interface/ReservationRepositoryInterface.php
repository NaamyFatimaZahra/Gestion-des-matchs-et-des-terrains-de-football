<?php

namespace App\Repositories\Interface;

interface ReservationRepositoryInterface
{

    public function getReservationsByProprietaire();

     public function getReservationById($id);

    public function createReservation(array $reservationData);

   
    public function updateReservation($id, array $reservationData);

   
    public function deleteReservation($id);

    public function updateStatus($id, $status);
   
    public function checkTerrainAvailability($terrainId, $date, $heureDebut, $heureFin, $excludeReservationId = null);
    public function getReservationStats($proprietaireId);

}