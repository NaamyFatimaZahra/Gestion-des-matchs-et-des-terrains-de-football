<?php

namespace App\Repositories\Eloquent;

use App\Models\Squad;
use App\Repositories\Interface\SquadRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SquadRepository implements SquadRepositoryInterface
{
    public function getAllSquads(){
        return Squad::all();
    }
    public function getSquadById($id)
    {
        return Squad::find($id);
    }
    public function getPlayersBySquadId($id)
    {
        return Squad::find($id)->players;
        
    }
   public function createSquad(array $data)
    {
        $user=Auth::user();
       
        $squad= Squad::create([
            'name_squad' => $data['name_squad'],
            'city' => $data['city'],
            'formation' => $data['formation'], 
            
           
        ]);
       $squad->players()->attach($user->id, [
            'admin' => true,
             'position' => $data['position'],
            'acceptationUser' => 'accepté',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $squad;
       
       
    }

     public function addPlayerToSquad($squadId, $playerId, $equipe, $position)
    { 
        $squad=Squad::find($squadId);
      
        $squad->players()->attach($playerId, [
            'admin' => false,
            'equipe' => $equipe,
            'position' => $position,
            'acceptationUser' => 'en attente', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return true;
    }
    
}
