<!-- resources/views/auth/login.blade.php -->

@extends('Layout.guest')
@section('title', 'Connexion')

@section('content')
    <section class="flex h-[100vh]">
        <div class="flex justify-between items-center w-[70%] m-auto h-[80vh] bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Section de gauche (identique à la page d'inscription) -->
            <div class="relative h-full w-[50%] bg-[#580a21] rounded-tr-[8rem] rounded-br-[8rem]">
                <div class="absolute left-[50%] top-[50%] translate-x-[-50%] translate-y-[-50%] flex justify-center items-center flex-col">
                    <!-- Logo/Icon avec Font Awesome -->
                    <div class="flex justify-center mb-4">
                        <div class="h-16 w-16 rounded-full border-2 border-[white] flex items-center justify-center">
                            <i class="fas fa-user text-[white] text-3xl"></i>
                        </div>
                    </div>
                    
                    <!-- Titre -->
                    <h2 class="text-2xl font-medium text-center text-[white] mb-1">Content de vous revoir !</h2>
                    <p class="text-center text-gray-500 mb-6">Vous n'avez pas de compte ?</p>
                    <a href="{{ route('showRegister') }}" class="text-[#580a21] pt-[1rem] bg-[white] py-[1rem] px-[1rem] text-center rounded-lg w-[70%]">Inscrivez-vous</a>
                </div>
            </div>

            <!-- Formulaire de connexion -->
            <form method="POST" class="max-w-md w-[50%] p-8" action="{{ route('login') }}">
                @csrf

                <!-- Affichage du message de réussite s'il existe -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
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

                <!-- Se souvenir de moi -->
                <div class="mb-6 flex items-center justify-between">
                    <label for="remember" class="inline-flex items-center">
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
    </section>
@endsection