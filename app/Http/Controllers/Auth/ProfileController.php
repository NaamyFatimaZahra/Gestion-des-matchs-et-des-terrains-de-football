<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ProfileServiceInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $profileService;
    
    public function __construct(ProfileServiceInterface $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index()
    {
        $user = $this->profileService->getUserProfile();
        return view('Auth.profile', ['user' => $user]);
    }

    public function edit()
    {
        $user = $this->profileService->getUserProfile();
        return view('Auth.profile-edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
            'city' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'email', 'city', 'phone_number', 'bio']);
        
        $success = $this->profileService->updateUserProfile($data);

        if ($success) {
            return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès.');
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du profil.')->withInput();
        }
    }
    
    public function updateProfilePicture(Request $request)
    {
        // Validation dans le contrôleur
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Délégation au service
        $success = $this->profileService->updateProfilePicture($request);
        
        if ($success) {
            return redirect()->route('profile')->with('success', 'Photo de profil mise à jour avec succès.');
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de la photo.')->withInput();
        }
    }
}