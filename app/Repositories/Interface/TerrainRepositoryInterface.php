<?php

namespace App\Repositories\Interface;

use App\Http\Requests\TerrainRequest;
use App\Models\Terrain;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface TerrainRepositoryInterface
{
  
    public function getAllByProprietaire(int $proprietaireId): Collection;
    
   
    public function updateStatus(Request $request, Terrain $terrain): bool;
    
   
    public function create(TerrainRequest $request, int $userId): Terrain;
    
   
    public function getWithRelations(Terrain $terrain): Terrain;
    
   
    public function update(Request $request, Terrain $terrain): bool;
    
    public function isDeleted(Terrain $terrain): bool;

    public function delete(Terrain $terrain): bool;
}