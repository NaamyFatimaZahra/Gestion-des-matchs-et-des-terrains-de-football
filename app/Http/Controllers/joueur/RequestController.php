<?php

namespace App\Http\Controllers\joueur;

use App\Http\Controllers\Controller;
use App\Http\Requests\SquadRequest;
use App\Models\Squad;
use App\Models\User;
use App\Repositories\Interface\SquadRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class RequestController extends Controller
{
    private $squadRepository;
    public function __construct(SquadRepositoryInterface $squadRepository)
    {
        $this->squadRepository = $squadRepository;
    }
   public function index(){
        $requests = $this->squadRepository->getRequestsByPlayerSquads();
        
        return view('joueur.requests',['requests'=>$requests]);
   }

     public function updateAcceptationUser(Request $request)
    {
        
       
       $validated = $request->validate([
    'response' => 'required|in:accepté,refusé',
    'squadId' => 'required|integer|exists:squads,id',
    'userId' => 'required|integer|exists:users,id'
        ]);
        $this->squadRepository->updateAcceptationUser($validated['squadId'],$validated['userId'],$validated['response']);
        
        return redirect()->back()->with('success', 'Statut de la demande mis à jour avec succès.');
    }


   

    
}
