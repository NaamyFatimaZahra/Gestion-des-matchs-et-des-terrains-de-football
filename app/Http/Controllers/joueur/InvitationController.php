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

class InvitationController extends Controller
{
    private $squadRepository;
    public function __construct(SquadRepositoryInterface $squadRepository)
    {
        $this->squadRepository = $squadRepository;
    }
   public function index(){
        $invitations = $this->squadRepository->getInvitationsByPlayerSquads();
        
        return view('joueur.invitations',['invitations'=>$invitations]);
   }

    


   

    
}
