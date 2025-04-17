<?php

namespace App\Http\Controllers\proprietaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\TerrainRequest;
use App\Models\Service;
use App\Models\Terrain;
use App\Repositories\Interface\TerrainRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TerrainController extends Controller
{
    /**
     * Le repository de terrains
     *
     * @var TerrainRepositoryInterface
     */
    protected $terrainRepository;

    /**
     * Crée une nouvelle instance du contrôleur
     *
     * @param TerrainRepositoryInterface $terrainRepository
     */
    public function __construct(TerrainRepositoryInterface $terrainRepository)
    {
        $this->terrainRepository = $terrainRepository;
    }

    /**
     * Affiche tous les terrains du propriétaire connecté
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user_id = Auth::id();
        $terrains = $this->terrainRepository->getAllByProprietaire($user_id);
        
        return view('proprietaire.terrains.index', ["terrains" => $terrains]);
    }

    /**
     * Met à jour le statut d'un terrain
     *
     * @param Request $request
     * @param Terrain $terrain
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Terrain $terrain)
    {
        $request->validate(['status' => 'required | in:disponible,occupé,maintenance']);
        
        $success = $this->terrainRepository->updateStatus($request, $terrain);
        
        if (!$success) {
            return back()->with('error', "Il n'est pas possible de modifier le statut du terrain car l'administrateur n'a pas encore validé ce dernier.");
        }
        
        return back()->with('success', 'La modification a été effectuée avec succès.');
    }

    /**
     * Affiche le formulaire de création d'un terrain
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $services = Service::all();
        return view('proprietaire.terrains.create', ['services' => $services]);
    }

    /**
     * Enregistre un nouveau terrain
     *
     * @param TerrainRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Affiche les détails d'un terrain
     *
     * @param Terrain $terrain
     * @return \Illuminate\View\View
     */
    public function show(Terrain $terrain)
    {
        Gate::authorize('view', $terrain);
        
        $terrain = $this->terrainRepository->getWithRelations($terrain);
        
        return view('proprietaire.terrains.show', ['terrain' => $terrain]);
    }

    /**
     * Affiche le formulaire de modification d'un terrain
     *
     * @param Terrain $terrain
     * @return \Illuminate\View\View
     */
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

    /**
     * Met à jour un terrain
     *
     * @param TerrainRequest $request
     * @param Terrain $terrain
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Supprime un terrain
     *
     * @param Terrain $terrain
     * @return \Illuminate\Http\RedirectResponse
     */
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