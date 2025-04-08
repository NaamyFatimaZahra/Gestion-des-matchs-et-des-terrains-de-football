<?php

namespace App\Http\Controllers;

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
        if ($user->role_id == Role::where('name', 'Admin')->value('id')) {
            return redirect()->route('admin.dashboard')->with('success', 'Connexion administrative réussie !');
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
            'status'=>$request->role===3 ?'active':'pending',
            'profile_picture' => 'default.jpg' 
        ]);

       
        Auth::login($user);
        // //send mail

        // $usermail=Auth::user()->email;
        // Mail::to( $usermail)->send(new SendEmailConfirmation());
       
    if ($user->role_id == Role::where('name', 'Admin')->value('id')) {
      
        return redirect()->route('admin.dashboard')->with('success', 'Connexion administrative réussie !');
    } else {
        
        return redirect('/home')->with('success', 'Inscription réussie !');
    }
    }

    // Logout method
    public function logout(Request $request)
    {


           //send mail

        // $usermail=Auth::user()->email;
        Mail::to( 'naamy.fatima.zahra@student.youcode.ma')->send(new SendEmailConfirmation());
        dd('message sent');
       
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('showLogin')->with('success', 'Déconnexion réussie !');
    
    }
}