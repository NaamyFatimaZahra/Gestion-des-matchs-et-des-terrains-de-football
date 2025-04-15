<?php

namespace App\Http\Controllers\proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('proprietaire.dashboard');
    }
}
