<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\TerrainRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Terrain;

class TerrainController extends Controller
{
    protected $terrainRepository;

    public function __construct(TerrainRepositoryInterface $terrainRepository)
    {
        $this->terrainRepository = $terrainRepository;
    }

    public function index(Request $request)
    {
        $terrains= $this->terrainRepository->getAllWithoutTrashed();
        return view('Home.terrains', [
            'terrains' => $terrains,
        ]);
    }
    
    public function show($id)
    {
        $terrain = $this->terrainRepository->findById($id);
        
        if (!$terrain) {
            return redirect()->route('terrains.index')->with('error', 'Terrain introuvable.');
        }
        
        return view('Home.details_terrain', [
            'terrain' => $terrain,
        ]);
    }

     public function filter($type, $value)
    {
        $transformedTerrains=$this->terrainRepository->getFilteredTerrains($type,$value);

        return response()->json($transformedTerrains);
    }
}