<?php

namespace App\Repositories\Eloquent;

use App\Models\Squad;
use App\Repositories\Interface\SquadRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SquadRepository implements SquadRepositoryInterface
{
    public function getAllSquads(){
        return Squad::paginate(12);
    }
    public function getSquadByJoueur(){
        
         $userId = Auth::id(); 

    
    $squadIds = DB::table('usersquads')
        ->where('user_id', $userId)
        ->where('acceptationUser','accepté')
        ->pluck('squad_id'); 

    $squads = [];

    
       $squads = Squad::whereIn('id', $squadIds)->paginate(12);
       
    
    
    return  $squads; 
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
         if($data['position']==='CBR'){
         $side='R';
       $data['position']= 'CB';
        }else if($data['position']==='CBL'){
             $side='L';
      
       $data['position']= 'CB';
        }else if($data['position']==='CDMR'){
         $side='R';
         $data['position'] = 'CDM';
        }else if($data['position']==='CDML'){
        $side='L';
         $data['position'] = 'CDM';
        }else{
             $side=null;
        }
        $squad= Squad::create([
            'name_squad' => $data['name_squad'],
            'city' => $data['city'],
            'formation' => $data['formation'], 
            
           
        ]);
       $squad->players()->attach($user->id, [
            'admin' => true,
             'position' => $data['position'],
             'side'=>$side,
            'acceptationUser' => 'accepté',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $squad;
       
       
    }

     public function addPlayerToSquad($squadId, $playerId, $equipe, $position,$side,$inviteType)
    {  
        
        if($side!="R" && $side!="L"){
        $side=NULL;
       }

        
     $player= DB::table('usersquads')->insert([
    'squad_id' => $squadId,
    'user_id' => $playerId,
    'admin' => false,
    'equipe' => $equipe,
    'position' => $position,
    'side' => $side,
    'acceptationUser' => 'en attente',
    'InvitationType'=>$inviteType,
    'created_at' => now(),
    'updated_at' => now(),
]);

       

        return true;
    }
    
  public function deletePlayer($playerId, $squadId)
    {
        $squad = $this->getSquadById($squadId);
        
        // Détacher le joueur du squad (en supposant une relation many-to-many)
        return $squad->players()->detach($playerId);
    }

    public function deleteSquad($squadId){
        DB::beginTransaction();
            
            // Find the squad
            $squad = Squad::findOrFail($squadId);
            
            // Delete related player associations first
            $squad->players()->detach();
            
            // Delete the squad
            $result = $squad->delete();
            
            DB::commit();
           return $result;
    }

    public function getRequestsByPlayerSquads()
{
    $userId = Auth::id(); 

    
    $squadIds = DB::table('usersquads')
        ->where('user_id', $userId)
        ->where('admin', 1)
        ->pluck('squad_id'); 

    $requests = [];

    foreach ($squadIds as $squadId) {
          $squad=Squad::find($squadId);
          
           $memberRequest= $squad->players()->where('acceptationUser','en attente')
           ->where('InvitationType','member')->with('squads')->get();
           

        if (!$memberRequest->isEmpty()) {
            $requests[] = $memberRequest[0];
        }
    }
    
    return $requests; 
}
   public function getInvitationsByPlayerSquads()
{
    $userId = Auth::id(); 
    $squadIds = DB::table('usersquads')
        ->where('user_id', $userId)
        ->where('admin', 0)
        ->pluck('squad_id'); 

    $invitations = [];

    foreach ($squadIds as $squadId) {
          $squad=Squad::find($squadId);
          
           $memberInvitation= $squad->players()->where('user_id', $userId)->where('acceptationUser','en attente')
           ->where('InvitationType','admin')->with('squads')->get();
           

        if (!$memberInvitation->isEmpty()) {
            $invitations[] = $memberInvitation[0];
        }
    }
    
    return $invitations; 
}
 public function updateAcceptationUser($squad_id,$user_id,$response){
    
     $squad=Squad::find($squad_id);
     if($response==='refusé'){
        $this->deletePlayer($user_id,$squad_id);
     }
       $squad->players()->updateExistingPivot($user_id, [
        'acceptationUser' => $response
    ]);

    return true;

 }

 public function checkPlayerIfExistInSquad($squad_id,$player_id){
  
    $squad=Squad::find($squad_id);
    $player=$squad->players()->where('user_id',$player_id)->get();
    
    if(isset($player[0])){
        return true;
    }
    return false;
 }

}
