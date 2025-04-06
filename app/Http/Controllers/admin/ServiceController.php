<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function showTerrainForm(){
        return view('admin.terrain.form');
    }

     public function store(Request $request){
        
    }
}
