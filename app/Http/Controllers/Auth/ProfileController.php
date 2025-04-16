<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('Auth.profile',['user' => $user]);
    }

    // public function updateProfile(Request $request)
    // {
    //     // Validation des données
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255',
    //         'city' => 'required|string|max:255',
    //     ]);

    //     // Récupérer l'utilisateur authentifié
    //     $user = auth()->user();

    //     // Mettre à jour les informations de l'utilisateur
    //     $user->update($request->only('name', 'email', 'city'));

    //     return redirect()->back()->with('success', 'Profil mis à jour avec succès !');
    // }
}
