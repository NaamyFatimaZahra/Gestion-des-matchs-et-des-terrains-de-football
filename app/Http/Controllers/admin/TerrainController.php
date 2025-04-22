<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Terrain;
use App\Repositories\Interface\TerrainRepositoryInterface;
use Illuminate\Http\Request;

class TerrainController extends Controller
{
    protected $terrainRepository;
    
  
    public function __construct(TerrainRepositoryInterface $terrainRepository)
    {
        $this->terrainRepository = $terrainRepository;
    }
    
   
    public function index()
    {
        $terrains = $this->terrainRepository->getAll();
        return view('admin.terrains.index', ['terrains' => $terrains]);
    }
    
   
    public function show(Terrain $terrain)
    {
        return view('admin.terrains.terrainDetails', ['terrain' => $terrain]);
    }
    
    
    public function updateApproval(Request $request, Terrain $terrain)
    {
        $request->validate(['admin_approval' => 'required|in:approuve,rejete,suspended']);
        
        $this->terrainRepository->updateApproval($terrain, $request->admin_approval);
        
        return back()->with('success', 'La modification a été effectuée avec succès.');
    }
}