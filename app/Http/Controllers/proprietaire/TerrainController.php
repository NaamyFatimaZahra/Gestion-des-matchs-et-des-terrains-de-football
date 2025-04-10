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
            // dd($terrains);

        return view('proprietaire.terrains.index',["terrains"=>$terrains]);
    }
 

    public function updateStatus(Request $request, Terrain $terrain){

        $request->validate(['status'=>'required | in:disponible,occupé,maintenance']);

        $terrain->status=$request->status;
        $terrain->save();
         return back()->with('success', 'La modification a été effectuée avec succès.');


    }



    public function create(){
      $services=Service::all();
      return view('proprietaire.terrains.create',['services'=>$services]);

    }

    public function store(Request $request){
        
    }

    public function show(Terrain $terrain){
        return view('proprietaire.terrains.show',['terrain'=>$terrain]);
    }

    public function edit(Terrain $terrain){
        
    }

    public function update(Request $request , Terrain $terrain){
        
    }


    public function destroy(Terrain $terrain){
        
    }
}
