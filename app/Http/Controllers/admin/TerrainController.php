<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Terrain;
use Illuminate\Http\Request;

class TerrainController extends Controller
{
    
    public function index(){
        $terrains= Terrain::all();
         return view('admin.terrains.index',['terrains'=>$terrains]);
    }
   

     public function show(Terrain $terrain){
         return view('admin.terrains.terrainDetails',['terrain'=>$terrain]);
    }

    public function updateApproval(Request $request, Terrain $terrain){
        $request->validate(['admin_approval'=>'required | in:approuve,rejete,suspended']);
        $terrain->admin_approval=  $request->admin_approval;
        if ($request->admin_approval == 'approuve') {
            $terrain->status = 'disponible'; 
        } 
         $terrain->save();
          return back()->with('success', 'La modification a été effectuée avec succès.');
    }
}
