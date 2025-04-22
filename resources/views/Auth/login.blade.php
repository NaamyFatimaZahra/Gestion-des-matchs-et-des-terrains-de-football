<!-- resources/views/auth/login.blade.php -->

@extends('Layout.guest')
@section('title', 'Connexion')

@section('content')
    <section class="min-h-[100vh]  px-4 py-16 lg:pt-0  flex items-center justify-center ">
        <div class="flex flex-col lg:flex-row w-full max-w-5xl mx-auto bg-rose-50 shadow-lg rounded-lg overflow-hidden">
            
            <!-- Section gauche (bienvenue) -->
            <div class="relative w-full lg:w-1/2 bg-[#580a21] min-h-[400px] lg:min-h-[500px] lg:rounded-tr-[8rem] lg:rounded-br-[8rem]">
                <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 flex justify-center items-center flex-col w-full px-6">
                    <!-- Logo/Icon -->
                    <div class="flex justify-center mb-4">
                        <div class="h-16 w-16 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-user text-white text-3xl"></i>
                        </div>
                    </div>
                    
                    <!-- Titre -->
                    <h2 class="text-xl md:text-2xl font-medium text-center text-white mb-1">Content de vous revoir !</h2>
                    <p class="text-center text-gray-300 mb-6">Vous n'avez pas de compte ?</p>
               
                    <a href="{{ route('showRegister') }}" class="text-[#580a21] bg-white py-3 px-6 text-center rounded-lg w-full max-w-xs">Inscrivez-vous</a>
                </div>
            </div>

            <!-- Formulaire de connexion -->
            <div class="w-full lg:w-1/2 p-4 md:p-6 lg:p-8">
                <form method="POST" class="w-full" action="{{ route('login') }}">
                    @csrf
    
                    <!-- Affichage du message de réussite s'il existe -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    <!-- Affichage des messages d'erreur -->
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
    
                    <!-- Titre du formulaire -->
                    <h2 class="text-2xl font-medium text-center text-[#580a21] mb-6">Connexion</h2>
    
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Adresse e-mail : <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Mot de passe : <span class="text-red-500">*</span></label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
                        @error('password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <!-- Se souvenir de moi et mot de passe oublié -->
                    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <label for="remember" class="inline-flex items-center mb-2 sm:mb-0">
                            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 border-gray-300 rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                        <a href="#" class="text-sm text-[#580a21] hover:underline">Mot de passe oublié ?</a>
                    </div>
    
                    <!-- Bouton de soumission -->
                    <div>
                        <button type="submit" class="w-full px-4 py-3 bg-[#580a21] text-white rounded-md hover:bg-[#7a0d2b] focus:outline-none focus:ring-2 focus:ring-[#580a21] flex items-center justify-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Se connecter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection