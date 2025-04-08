<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $services=Service::all();
       
        return view("admin.services.index",['services'=>$services]);
    }
    
   

    public function store(Request $request ){
        $request->validate([
            'service'=>'required|string',
        ]);
        // dd($request->service);
        Service::create([
            'name'=>$request->service
        ]);
         return back()->with('success','le service ajouter avec success');
    }


    public function update(Request $request , Service $service){
        $request->validate([
             'service'=>'required|string',
        ]);
        $service->update([
            'name'=>$request->service
        ]);
         return back()->with('success','le service modifier avec success');
    }

    public function destroy(Service $service){
         $service->delete();
         return back()->with('success','le service a ete supprimer avec success');
    }
}
