<?php

namespace App\Repositories\Interface;

interface SquadRepositoryInterface
{
    public function getAllSquads();
    public function getSquadById($id);
    public function getPlayersBySquadId($id);
    public function createSquad(array $data);
    public function addPlayerToSquad($squadId, $playerId, $equipe, $position);

   
}
