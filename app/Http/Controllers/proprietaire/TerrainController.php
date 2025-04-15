<?php

namespace App\Http\Controllers\proprietaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\TerrainRequest;
use App\Models\Document;
use App\Models\Service;
use App\Models\Terrain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TerrainController extends Controller
{
    public function index(){
          $user_id=Auth::user()->id;
          $terrains=Terrain::where('proprietaire_id','=',$user_id)->get();
        return view('proprietaire.terrains.index',["terrains"=>$terrains]);
    }
 

    public function updateStatus(Request $request, Terrain $terrain){

        $request->validate(['status'=>'required | in:disponible,occupé,maintenance']);
        if($terrain->admin_approval==='en_attente'){
        return back()->with('error', "Il n'est pas possible de modifier le statut du terrain car l'administrateur n'a pas encore validé ce dernier.");
        }
        $terrain->status=$request->status;
        $terrain->save();
         return back()->with('success', 'La modification a été effectuée avec succès.');


    }



    public function create(){
      $services=Service::all();
      return view('proprietaire.terrains.create',['services'=>$services]);

    }

    public function store(TerrainRequest $request){
       
     $validated = $request->validated();
     $userId = Auth::id();

     DB::beginTransaction();
        
        // Créer un nouveau terrain avec les données validées
        $terrain = new Terrain();
        $terrain->name = $validated['name'];
        $terrain->description = $validated['description'];
        $terrain->capacity = $validated['capacity'];
        $terrain->price = $validated['price'];
        $terrain->surface = $validated['surface'];
        $terrain->payment_method = $validated['payment_method'];
        $terrain->city = $validated['city'];
        $terrain->adress = $validated['adress'];
        $terrain->latitude = $validated['latitude'];
        $terrain->longitude = $validated['longitude'];
        $terrain->proprietaire_id = $userId;
        $terrain->contact = $validated['contact'];
        
        // Enregistrer le terrain dans la base de données
        $terrain->save();

         foreach ($validated['services'] as $serviceId) {
                // Associer le service au terrain (utiliser un prix par défaut de 0 pour la relation pivot)
                $terrain->services()->attach($serviceId, ['price' => 0]);
            }


          foreach ($request->file('images') as $image) {
                // Générer un nom unique pour l'image
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                
                // Stocker l'image dans le répertoire de stockage (storage/app/public/terrains)
                $imagePath = $image->storeAs('terrains', $imageName, 'public');
                
                // Créer un nouveau document pour l'image
                $document = new Document();
                $document->terrain_id = $terrain->id;
                $document->photo_path = $imagePath;
                $document->save();
            }
         DB::commit();
          return redirect()->route('proprietaire.terrains.index')->with('success', 'Le terrain a été ajoute avec succès.');
    }

    public function show(Terrain $terrain){
        $terrain->with('services');
        return view('proprietaire.terrains.show',['terrain'=>$terrain]);
    }

    public function edit(Terrain $terrain){
        
    }

    public function update(Request $request , Terrain $terrain){
        
    }


    public function destroy(Terrain $terrain){
        
    }
}
