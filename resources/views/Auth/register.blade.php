<!-- resources/views/auth/register.blade.php -->

@extends('Layout.guest')
@section('title', 'Inscription')

@section('content')
    <section class="min-h-screen py-8 px-4 pt-24 flex items-center justify-center  ">
        <div class="flex flex-col lg:flex-row w-full max-w-5xl mx-auto bg-rose-50 shadow-lg rounded-lg overflow-hidden  ">
            
            <!-- Section gauche (image/bienvenue) -->
            <div class="relative w-full lg:w-1/2 bg-[#580a21] min-h-[300px] lg:min-h-[500px] lg:rounded-tr-[8rem] lg:rounded-br-[8rem]">
                <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 flex justify-center items-center flex-col w-full px-6">
                    <!-- Logo/Icon -->
                    <div class="flex justify-center mb-4">
                        <div class="h-16 w-16 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-user text-white text-3xl"></i>
                        </div>
                    </div>
                    
                    <!-- Titre -->
                    <h2 class="text-xl md:text-2xl font-medium text-center text-white mb-1">Bienvenue, cela prend moins de 60 secondes</h2>  
                    <p class="text-center text-gray-300 mb-6">Vous avez déjà un compte ?</p>
               
                    <a href="{{ route('showLogin') }}" class="text-[#580a21] bg-white py-3 px-6 text-center rounded-lg w-full max-w-xs">Connectez-vous</a>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="w-full lg:w-1/2 p-4 md:p-6 lg:p-8">
                <form method="POST" id="form" class="w-full" action="{{ route('register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <!-- Nom -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Votre nom : <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Adresse e-mail : <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" value="{{ old('email') }}" required>
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

                    <!-- Confirmation du mot de passe -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1">Répéter le mot de passe : <span class="text-red-500">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
                        <span class="text-red-500 text-xs hidden" id='password_confirmation_span'></span>
                        @error('password_confirmation')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                  
                    <!-- Ville -->
                    <div class="mb-4">
                        <label for="city" class="block text-sm font-medium text-gray-600 mb-1">Ville : <span class="text-red-500">*</span></label>
                        <select id="city" name="city" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
                            <option value="">Sélectionnez une ville</option>
                        </select>
                        @error('city')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sélection du rôle -->
                    <div class="mb-6">
                        <label for="role" class="block text-sm font-medium text-gray-600 mb-1">Rôle : <span class="text-red-500">*</span></label>
                        <select id="role" name="role" class="w-full capitalize px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
                            @foreach ($roles as $role)
                            <option class="capitalize" value="{{ $role['id'] }}">{{$role['name']==='proprietaire'?'propriétaire':$role['name']}}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                   
                    <!-- Bouton de soumission -->
                    <div>
                        <button type="submit" class="w-full px-4 py-3 bg-[#580a21] text-white rounded-md hover:bg-[#7a0d2b] focus:outline-none focus:ring-2 focus:ring-[#580a21] flex items-center justify-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            S'inscrire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Validation des mots de passe -->
    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            let password = document.getElementById('password').value;
            let passwordConfirmed = document.getElementById('password_confirmation').value;
            let span = document.getElementById('password_confirmation_span');

            if (password !== passwordConfirmed) {
                span.innerHTML = 'Les mots de passe ne correspondent pas';
                span.classList.remove('hidden');
                event.preventDefault(); // Empêche la soumission du formulaire
            } else {
                span.classList.add('hidden');
            }
        });
    </script>
    
    <script src="{{ asset('js/morrocaineCities.js') }}"></script>
@endsection