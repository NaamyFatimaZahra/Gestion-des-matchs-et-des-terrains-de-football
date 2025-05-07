<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\SendEmailConfirmation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLogin(){
        return view("Auth.login");
    }

   public function login(LoginRequest $request) {
    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
        
        // Vérifier si l'utilisateur est admin
        if ($user->role_id == Role::where('name','=', 'admin')->value('id')) {
            return redirect()->route('admin.dashboard')->with('success', 'Connexion administrative réussie !');
        } else if ($user->role_id == Role::where('name','=', 'proprietaire')->value('id')) {
            return redirect()->route('proprietaire.dashboard')->with('success', 'Connexion administrative réussie !');
        } else {
            return redirect('/home')->with('success', 'Connexion réussie !');
        }
    }

    // Si l'authentification a échoué
    return back()->withErrors([
        'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
    ])->onlyInput('email');
}
    public function showRegister(){
         $roles = Role::where('name', '!=', 'Admin')->get();
        return view("Auth.register", ['roles' => $roles]);
    }

    public function register(RegisterRequest $request)
    {
        // Créer l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'city' => $request->city, 
            'role_id' => $request->role,
            'status'=>$request->role===2 ?'pending':'active',
            'profile_picture' => 'default.jpg' 
        ]);

       
        Auth::login($user);
       
    if ($user->role_id == Role::where('name',"=", 'admin')->value('id')) {
        return redirect()->route('admin.dashboard')->with('success', 'Connexion administrative réussie !');
    } elseif($user->role_id == Role::where('name',"=", 'proprietaire')->value('id')) {
        return redirect()->route('proprietaire.dashboard')->with('success', 'Connexion administrative réussie !');
    }else {
        
        return redirect('/home')->with('success', 'Inscription réussie !');
    }
    }

    // Logout method
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('showLogin')->with('success', 'Déconnexion réussie !');
    
    }
}