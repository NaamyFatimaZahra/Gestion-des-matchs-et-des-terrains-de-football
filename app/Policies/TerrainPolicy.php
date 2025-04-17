<?php

namespace App\Policies;

use App\Models\Terrain;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TerrainPolicy
{
   public function view(User $user,Terrain $terrain)
{
    return $user->id === $terrain->proprietaire_id;
        
}
}
