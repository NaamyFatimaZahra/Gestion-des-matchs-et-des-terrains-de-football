<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TerrainController extends Controller
{
    
    public function index(){
         return view('admin.terrain.index');
    }
    public function create(){
        return view('admin.terrain.form');
    }

     public function store(Request $request){
        
    }
}
