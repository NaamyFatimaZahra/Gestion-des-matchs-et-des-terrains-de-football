<?php

namespace App\Services;

use App\Repositories\Interface\UserRepositoryInterface;
use App\Services\Interfaces\ProfileServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileService implements ProfileServiceInterface
{
    private $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function getUserProfile()
    {
        return Auth::user();
    }
    
    public function updateUserProfile(array $data)
    {
        $userId = Auth::id();
        return $this->userRepository->updateUserProfile($userId, $data);
    }
    
    public function updateProfilePicture(Request $request)
    {
        // Validation déplacée au contrôleur
        $user = Auth::user();
        
        
        
        // Stockage de la nouvelle image
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');
        
        // Mise à jour via repository
        return $this->userRepository->updateProfilePicture($user->id, $path);
    }
}