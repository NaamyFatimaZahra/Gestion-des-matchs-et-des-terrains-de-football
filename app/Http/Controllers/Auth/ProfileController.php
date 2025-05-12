<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

       private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }



    public function index()
    {
        $user = Auth::user();
        return view('Auth.profile',['user' => $user]);
    }
     public function profileJoueurIndex(){
        $user = Auth::user();
        return view('Auth.profile-joueur', ['user' => $user]);
     }

    public function edit()
    {
        $user = Auth::user();
        return view('Auth.profile-edit', ['user' => $user]);
    }
    public function profileJoueurEdit()
    {
        $user = Auth::user();
        return view('Auth.profile-joueur-edit', ['user' => $user]);
    }

    public function update(Request $request, UserRepositoryInterface $userRepository)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'city' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        $userId = Auth::id();
        $data = $request->only(['name', 'email', 'city', 'phone_number', 'bio']);
        
        // Passer les données au repository pour qu'il les traite
        $success = $userRepository->updateUserProfile($userId, $data);

        if ($success) {
            return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès.');
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du profil.')->withInput();
        }
    }
    public function updateProfilePicture(Request $request, )
{
    // Valider la requête
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

    // Supprimer l'ancienne image si elle existe
    if ($user->profile_picture) {
        Storage::disk('public')->delete($user->profile_picture);
    }

    // Stocker la nouvelle image
    $path = $request->file('profile_picture')->store('profile-pictures', 'public');

    // Mettre à jour l'utilisateur via repository
    $this->userRepository->updateProfilePicture($user, $path);

    return redirect()->route('profile')->with('success', 'Photo de profil mise à jour avec succès.');
}
}
