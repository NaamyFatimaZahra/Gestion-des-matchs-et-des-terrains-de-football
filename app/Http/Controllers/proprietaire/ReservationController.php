<?php

namespace App\Http\Controllers\Proprietaire;

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

   
    public function index()
    {
        $this->reservationRepository->changeStatusToTermine();
        $reservations = $this->reservationRepository->getReservationsByProprietaire();
       
        return view('proprietaire.reservations', ['reservations' => $reservations]);
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmee,annulee',
        ]);

        if($request->input('status') == 'confirmee'){
            $this->reservationRepository->sendConfirmationEmail($id);
        } 
        $reservation = $this->reservationRepository->updateStatus($id, $request->input('status'));
        if($request->status==='confirmee'){
         return redirect()->back()->with('success', 'Emails de confirmation envoyés avec succès');
        }else{
            return redirect()->back()->with('success', 'Statut de la réservation mis à jour avec succès.');
        }
    
    }

  
}