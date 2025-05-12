<?php

namespace App\Repositories\Interface;

use App\Http\Requests\TerrainRequest;
use App\Models\Terrain;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface TerrainRepositoryInterface
{

    //admin methods
  
    public function getAll(): LengthAwarePaginator;
    public function updateApproval(Terrain $terrain, string $approval): bool;
    public function getTerrainsByCity($city): Collection;
    public function getAllWithoutTrashed() ;

    public function getFilteredTerrains($type, $value);
     public function findById($id);
    public function getAllByProprietaire();
    
   
    public function updateStatus(Request $request, Terrain $terrain): bool;
    
   
    public function create(TerrainRequest $request, int $userId): Terrain;
    
   
    public function getWithRelations(Terrain $terrain): Terrain;
    
   
    public function update(Request $request, Terrain $terrain): bool;
    
    public function isDeleted(Terrain $terrain): bool;

    public function delete(Terrain $terrain): bool;
}