<?php
namespace App\Http\Controllers\joueur;
use App\Http\Controllers\Controller;
class TerrainController extends Controller
{
    public function index()
    {
        return view('joueur.terrains');
    }


}