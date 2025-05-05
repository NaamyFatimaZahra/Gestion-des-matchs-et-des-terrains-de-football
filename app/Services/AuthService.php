<?php

namespace App\Services;

use App\Repositories\Interface\UserRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthService implements AuthServiceInterface
{
    protected $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function attemptLogin(array $credentials, bool $remember)
    {
        return Auth::attempt($credentials, $remember);
    }
    
    public function register(array $userData)
    {
        return $this->userRepository->create($userData);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
    
    public function getRedirectPath($user)
    {
        $adminRoleId = $this->userRepository->findRoleIdByName('admin');
        $proprietaireRoleId = $this->userRepository->findRoleIdByName('proprietaire');
        
        if ($user->role_id == $adminRoleId) {
            return ['route' => 'admin.dashboard', 'message' => 'Connexion administrative réussie !'];
        } else if ($user->role_id == $proprietaireRoleId) {
            return ['route' => 'proprietaire.dashboard', 'message' => 'Connexion administrative réussie !'];
        } else {
            return ['route' => '/home', 'message' => 'Connexion réussie !'];
        }
    }
    
    public function getRoles()
    {
        return $this->userRepository->getRolesExceptAdmin();
    }
}