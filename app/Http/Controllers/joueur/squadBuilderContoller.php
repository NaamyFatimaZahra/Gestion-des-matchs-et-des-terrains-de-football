<?php

namespace App\Http\Controllers\joueur;

use App\Http\Controllers\Controller;
use App\Http\Requests\SquadRequest;
use Illuminate\Http\Request;

class squadBuilderContoller extends Controller
{
    public function index()
    {
        return view('joueur.squadBuilder');
    }
    public function store(SquadRequest $request)
    {
        
    dd($request->all());
      
    }

    
}
