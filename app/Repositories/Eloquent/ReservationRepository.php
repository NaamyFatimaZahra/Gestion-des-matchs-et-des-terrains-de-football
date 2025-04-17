<?php

namespace App\Repositories\Eloquent;

use App\Mail\ReservationConfirmationMail;
use App\Models\Reservation;
use App\Models\Terrain;
use App\Repositories\Interface\ReservationRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReservationRepository implements ReservationRepositoryInterface
{
   
    protected $reservation;

   
    protected $terrain;

    /**
     * ReservationRepository constructor.
     *
     * @param Reservation $reservation
     * @param Terrain $terrain
     */
    public function __construct(Reservation $reservation, Terrain $terrain)
    {
        $this->reservation = $reservation;
        $this->terrain = $terrain;
    }

   
  

  
 public function getReservationsByProprietaire()
{
    $proprietaireId = Auth::id();
    return Reservation::whereHas('terrain', function ($query) use ($proprietaireId) {
        $query->where('proprietaire_id', $proprietaireId);
    })
    ->with('terrain')
    ->with('reservationUsers')
    ->orderByDesc('date_reservation')
    ->paginate(10);
}
public function getReservationsByTerrain($terrainId)
{
    return Reservation::where('terrain_id', $terrainId)
        ->with('terrain')
        ->with('reservationUsers')
        ->orderByDesc('date_reservation')
        ->paginate(10);
}

   
    public function getReservationById($id)       
    {
        return $this->reservation->findOrFail($id);
    }

  
    public function createReservation(array $reservationData)
    {
        return $this->reservation->create($reservationData);
    }

    public function changeStatusToTermine(){
         $this->reservation->where('status', 'confirmee')
            ->where('date_reservation', '<=', now())
            ->update(['status' => 'terminee']);
    }
    public function updateReservation($id, array $reservationData)
    {
        $reservation = $this->getReservationById($id);
        return $reservation->update($reservationData);
    }

  
    public function deleteReservation($id)
    {
        $reservation = $this->getReservationById($id);
        return $reservation->delete();
    }

    public function updateStatus($id, $status)
    {
        $reservation = $this->getReservationById($id);
        return $reservation->update(['status' => $status]);
    }

public function sendConfirmationEmail($id)
{
    
    $reservation = Reservation::where('id', $id)->with(['reservationUsers', 'terrain'])->first();
    
    if (!$reservation) {
       
        return redirect()->back()->with('error', 'Réservation non trouvée');
    }
    
    foreach ($reservation->reservationUsers as $reservationUser) {
     
            Mail::to($reservationUser->email)->send(new ReservationConfirmationMail($reservation));
        
    }
    
    
}
    
    public function checkTerrainAvailability($terrainId, $date, $heureDebut, $heureFin, $excludeReservationId = null)
    {
        $query = $this->reservation
            ->where('terrain_id', $terrainId)
            ->where('date_reservation', $date)
            ->where('status', '!=', 'annulee')
            ->where(function ($query) use ($heureDebut, $heureFin) {
                // Vérifie si le créneau demandé chevauche un créneau existant
                $query->where(function ($q) use ($heureDebut, $heureFin) {
                    $q->where('heure_debut', '<', $heureFin)
                      ->where('heure_fin', '>', $heureDebut);
                });
            });

        // Exclure la réservation en cours de modification si un ID est fourni
        if ($excludeReservationId) {
            $query->where('id', '!=', $excludeReservationId);
        }

        // Si aucune réservation n'est trouvée, le terrain est disponible
        return $query->count() === 0;
    }

    public function getReservationStats($proprietaireId)
    {
        $stats = [
            'total' => 0,
            'confirmees' => 0,
            'en_attente' => 0,
            'annulees' => 0,
            'par_mois' => []
        ];

        // Récupérer les terrains du propriétaire
        $terrainIds = $this->terrain
            ->where('user_id', $proprietaireId)
            ->pluck('id')
            ->toArray();

        if (empty($terrainIds)) {
            return $stats;
        }

        // Stats par statut
        $statsByStatus = $this->reservation
            ->whereIn('terrain_id', $terrainIds)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        foreach ($statsByStatus as $stat) {
            $stats['total'] += $stat->total;
            if ($stat->status === 'confirmee') {
                $stats['confirmees'] = $stat->total;
            } elseif ($stat->status === 'en_attente') {
                $stats['en_attente'] = $stat->total;
            } elseif ($stat->status === 'annulee') {
                $stats['annulees'] = $stat->total;
            }
        }

        // Stats par mois (pour les 6 derniers mois)
        $statsByMonth = $this->reservation
            ->whereIn('terrain_id', $terrainIds)
            ->where('date_reservation', '>=', now()->subMonths(6)->startOfMonth())
            ->select(
                DB::raw('YEAR(date_reservation) as year'),
                DB::raw('MONTH(date_reservation) as month'),
                DB::raw('count(*) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        foreach ($statsByMonth as $stat) {
            $monthName = date('F', mktime(0, 0, 0, $stat->month, 1));
            $stats['par_mois'][$monthName] = $stat->total;
        }

        return $stats;
    }
}