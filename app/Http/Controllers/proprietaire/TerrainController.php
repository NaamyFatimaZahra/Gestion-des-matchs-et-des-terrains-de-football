<?php

namespace App\Http\Controllers\proprietaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\TerrainRequest;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Terrain;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\TerrainRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TerrainController extends Controller
{
   
    protected $terrainRepository;
    protected $reservationRepository;

  
    public function __construct(TerrainRepositoryInterface $terrainRepository,ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
     
        $this->terrainRepository = $terrainRepository;
    }

   
    public function index()
    {
      
        $terrains = $this->terrainRepository->getAllByProprietaire();
        
        return view('proprietaire.terrains.index', ["terrains" => $terrains]);
    }

    public function updateStatus(Request $request, Terrain $terrain)
    {
        $request->validate(['status' => 'required | in:disponible,occupé,maintenance']);
        
        $success = $this->terrainRepository->updateStatus($request, $terrain);
        
        if (!$success) {
            return back()->with('error', "Il n'est pas possible de modifier le statut du terrain car l'administrateur n'a pas encore validé ce dernier.");
        }
        
        return back()->with('success', 'La modification a été effectuée avec succès.');
    }

  
    public function create()
    {
        $services = Service::all();
        return view('proprietaire.terrains.create', ['services' => $services]);
    }

   
    public function store(TerrainRequest $request)
    {
        try {
            $userId = Auth::id();
            $this->terrainRepository->create($request, $userId);
            
            return redirect()->route('proprietaire.terrains.index')
                ->with('success', 'Le terrain a été ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de l\'ajout du terrain: ' . $e->getMessage());
        }
    }

  
    public function show(Terrain $terrain)
    {
        Gate::authorize('view', $terrain);
        
        $terrain = $this->terrainRepository->getWithRelations($terrain);
        $reservations = $this->reservationRepository->getReservationsByTerrain($terrain->id);
      
        return view('proprietaire.terrains.show', ['terrain' => $terrain, 'reservations' => $reservations]);
    }

   
    public function edit(Terrain $terrain)
    {
        Gate::authorize('update', $terrain);
        
        $terrain = $this->terrainRepository->getWithRelations($terrain);
        $services = Service::all();
        
        return view('proprietaire.terrains.edit', [
            'terrain' => $terrain,
            'services' => $services
        ]);
    }

   
    public function update(TerrainRequest $request, Terrain $terrain)
    {
        Gate::authorize('update', $terrain);
        
        try {
            $this->terrainRepository->update($request, $terrain);
            
            return redirect()->route('proprietaire.terrains.show', $terrain->id)
                ->with('success', 'Le terrain a été mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour du terrain: ' . $e->getMessage());
        }
    }

   
    public function destroy(Terrain $terrain)
    {
      if($this->terrainRepository->isDeleted($terrain)){
            return redirect()->back()
                ->with('error', 'Le terrain a déjà été supprimé.');
        }else{
            if($this->terrainRepository->delete($terrain)){
            return redirect()->route('proprietaire.terrains.index')
                ->with('success', 'Le terrain a été supprimé avec succès.');
        }else{
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression du terrain.');  
      }
        }     
       
    }
}