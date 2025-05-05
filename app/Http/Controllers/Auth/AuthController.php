<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;
    
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
    
    public function showLogin()
    {
        return view("Auth.login");
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if ($this->authService->attemptLogin($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            $redirect = $this->authService->getRedirectPath($user);
            
            return redirect()->route($redirect['route'])->with('success', $redirect['message']);
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }
    
    public function showRegister()
    {
        $roles = $this->authService->getRoles();
        return view("Auth.register", ['roles' => $roles]);
    }

    public function register(RegisterRequest $request)
    {
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'city' => $request->city,
            'role_id' => $request->role
        ];
        
        $user = $this->authService->register($userData);
        
        Auth::login($user);
        
        $redirect = $this->authService->getRedirectPath($user);
        
        if (is_string($redirect['route'])) {
            return redirect($redirect['route'])->with('success', 'Inscription réussie !');
        } else {
            return redirect()->route($redirect['route'])->with('success', 'Inscription réussie !');
        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        
        return redirect()->route('showLogin')->with('success', 'Déconnexion réussie !');
    }
}