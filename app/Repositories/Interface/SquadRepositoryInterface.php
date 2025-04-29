<?php

namespace App\Repositories\Interface;

interface SquadRepositoryInterface
{
    public function getAllSquads();
    public function getSquadById($id);
    public function getPlayersBySquadId($id);
    public function createSquad(array $data);
    public function addPlayerToSquad($squadId, $playerId, $equipe, $position,$side,$inviteType);

    public function deletePlayer($playerId, $squadId);
   
    public function deleteSquad($squadId);
    public function getRequestsByPlayerSquads();
     
    public function getInvitationsByPlayerSquads();
    public function updateAcceptationUser($squad_id,$user_id,$response);
    public function checkPlayerIfExistInSquad($squad_id,$player_id);
}
