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
use Illuminate\Support\Facades\DB;

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
    public function squad_user(){
          $squads = $this->squadRepository->getSquadByJoueur();
         
        return view('joueur.user_squad',[
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
    public function storePlayer(Request $request){
        if($this->squadRepository->checkPlayerIfExistInSquad($request['squad_id'],$request['player_id'])){
            return redirect()->back()->with('success','tu est deja membre de ce groupe ');
        }
         if($this->squadRepository->addPlayerToSquad($request['squad_id'],$request['player_id'],$request['equipe'],$request['position'],$request['side'],$request['invitationType'])){
            if($request['invitationType']==='member'){
                return redirect()->back();
            }
            return response()->json([true]);
         }
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
          return redirect()->route('joueur.squad.show',$squad->id);
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
     public function deletePlayer($playerId, $squadId)
    {
        $this->squadRepository->deletePlayer($playerId, $squadId);
        
        return redirect()->back()->with('success', 'Joueur supprimé avec succès');
    }

    public function destroySquad($squadId)
    {
        if ($this->squadRepository->deleteSquad($squadId)) {
            return redirect()->route('joueur.squads')->with('success', 'Le squad a été supprimé avec succès.');
        } else {
            return redirect()->route('joueur.squads')->with('error', 'Erreur lors de la suppression du squad.');
        }
    }

   public function filtersquads($typeFilter, $value)
{
    $squads = Squad::query();
     if ($typeFilter == 'formation' && !empty($value)) {
        $squads->where('formation', $value);
    } else if ($typeFilter == 'city' && !empty($value)) {
        $squads->where('city', $value);
    } else if ($typeFilter == 'search' && !empty($value)) {
        $squads->where('name_squad', 'LIKE', $value . '%');
    }else{
        
    }
    
    $filteredSquads = $squads->with('players')->get();
    
    return response()->json($filteredSquads);
}

public function filterSquadByPlayer($typeFilter, $value)
{
    $userId = Auth::id();

    $squadIds = DB::table('usersquads')
        ->where('user_id', $userId)
        ->where('acceptationUser', 'accepté')
        ->pluck('squad_id');

    // Start query with squads the user is part of
    $query = Squad::whereIn('id', $squadIds);

    // Apply the filter if provided
    if (!empty($value)) {
        switch ($typeFilter) {
            case 'formation':
                $query->where('formation', $value);
                break;
            case 'city':
                $query->where('city', $value);
                break;
            case 'search':
                $query->where('name_squad', 'LIKE', $value . '%');
                break;
        }
    }

    $filterSquads = $query->with('players')->get();

    return response()->json($filterSquads);
}


    
}
