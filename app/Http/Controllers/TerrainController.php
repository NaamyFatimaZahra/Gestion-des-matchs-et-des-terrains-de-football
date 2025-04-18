<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
class TerrainController extends Controller
{
    public function index()
    {
        return view('Home.terrains');
    }


}