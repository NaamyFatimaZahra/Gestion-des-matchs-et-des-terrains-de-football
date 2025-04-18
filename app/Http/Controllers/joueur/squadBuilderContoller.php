<?php

namespace App\Http\Controllers\joueur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class squadBuilderContoller extends Controller
{
    public function index()
    {
        return view('joueur.squadBuilder');
    }

    
}
