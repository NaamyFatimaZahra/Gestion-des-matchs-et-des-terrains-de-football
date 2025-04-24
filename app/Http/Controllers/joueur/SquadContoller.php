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

class SquadContoller extends Controller
{
    private $squadRepository;
    private $userRepository;
    public function __construct(SquadRepositoryInterface $squadRepository,UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    
        $this->squadRepository = $squadRepository;
    }
     public function index()
    {
       
            $squads = $this->squadRepository->getAllSquads();
          
        return view('joueur.squads',[
            'squads' => $squads,
        ]);
    }
    public function show($id)
    {
       
        $squad=$this->squadRepository->getSquadById($id);
        $players = $this->squadRepository->getPlayersBySquadId($id);
        
        if($squad->formation==='121'){
            return view('joueur.pages.121_squad',[
                'squad' => $squad,
                'players' => $players]);
        }elseif($squad->formation==='433'){
            return view('joueur.pages.433_squad',[
                'squad' => $squad,
                'players' => $players]);
            }elseif($squad->formation==='331'){
                return view('joueur.pages.331_squad',[
                'squad' => $squad,
                'players' => $players]);
                }

    }
   
    public function create()
    {
        return view('joueur.squadBuilder');
    }
    public function store(SquadRequest $request)
    {
        
        $request->validated();
     $squad=$this->squadRepository->createSquad([
            'name_squad' => $request->input('name_squad'),
            'city' => $request->input('city'),
            'formation' => $request->input('formation'),
            'position' => $request->input('position'),
        ]);
      
     
       if($squad) {
          return  $this->show($squad->id);
        } else {    
            return redirect()->back()->with('error', 'Failed to create squad.');
        }
    }
    public function getSquadPlayers($city,$squadId)
    {

        $playersExist = $this->squadRepository->getPlayersBySquadId($squadId);
        $players = $this->userRepository->getPlayersByCity($city);
        return response()->json(
            [
                'players' => $players,
                'playersExist' => $playersExist,
            ]
        );
    }
    public function storePlayer(Request $request){
       
         if($this->squadRepository->addPlayerToSquad($request['squad_id'],$request['player_id'],$request['equipe'],$request['position'])){
            return response()->json([true]);
         }
    }
   

    
}
