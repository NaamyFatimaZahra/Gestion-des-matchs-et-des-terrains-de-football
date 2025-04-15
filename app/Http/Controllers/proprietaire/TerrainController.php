<?php

namespace App\Http\Controllers\proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Terrain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request){
        $request->validate([
            'name'=>'required | string',
            'description'=>'required | string',
            'capacity'=>'required | integer |min:10',
            'price'=>'required | numeric | min:0',
           'surface' => 'required|in:gazon_naturel,gazon_synthetique,gazon_hybride,turf_artificiel,stabilise,sable,beton,terre_battue,indoor_synthetique,altra_resist',
           'payment_method'=>'required',
           'city'=>'required| string',
           'adress'=>'required | string',
           'latitude'=>'required | numeric',
           'images' => 'required|array',
           'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
           'longitude'=>'required|numeric',
           'services'=>'required',
           'services.*'=>'required | exists:services,id',

        ]);
    
    
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
