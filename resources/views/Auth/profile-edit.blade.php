@extends('Layout.dashboard')
@section('title', 'Modifier Profil')
@section('content')

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-9 max-w-4xl">
        <!-- Messages de succès et d'erreur -->
        @if(session('success'))
            <div id="success-alert" class="bg-rose-50 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Succès!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg onclick="document.getElementById('success-alert').style.display = 'none'" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Fermer</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        @endif

        @if(session('error'))
            <div id="error-alert" class="bg-rose-50 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Erreur!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg onclick="document.getElementById('error-alert').style.display = 'none'" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Fermer</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        @endif

        @if($errors->any())
            <div id="validation-errors" class="bg-rose-50 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Validation échouée!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg onclick="document.getElementById('validation-errors').style.display = 'none'" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Fermer</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        @endif

        <!-- En-tête du formulaire -->
        <div class="bg-rose-50 rounded-lg p-4 sm:p-6 border border-gray-200 shadow-md mb-8">
            <div class="flex flex-col sm:flex-row items-center mb-6">
                <div class="w-10 h-10 rounded-md bg-rose-100 flex items-center justify-center mb-2 sm:mb-0 sm:mr-3">
                    <i class="fas fa-user-edit text-[#420718e2]"></i>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800 text-center sm:text-left">Modifier mon profil</h1>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <!-- Photo de profil - Affichage et option de modification séparée -->
                    <div class="flex flex-col items-center mb-4">
                        <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6 h-full">
                            <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full overflow-hidden border-4 border-[#420718e2]">
                                @if($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo de profil" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-rose-50 flex items-center justify-center">
                                        <i class="fas fa-user text-3xl sm:text-4xl text-gray-500"></i>
                                    </div>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 mt-2 text-center sm:text-left sm:mt-0">Pour modifier votre photo, utilisez l'icône d'appareil photo sur votre profil</p>
                        </div>
                    </div>

                    <!-- Informations personnelles -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Nom -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-800">Nom complet</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-500"></i>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="bg-rose-100 border border-gray-300 text-gray-800 pl-10 pr-4 py-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-[#420718e2] focus:border-transparent">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-800">Adresse email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-500"></i>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="bg-rose-100 border border-gray-300 text-gray-800 pl-10 pr-4 py-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-[#420718e2] focus:border-transparent">
                            </div>
                        </div>

                        <!-- Ville -->
                        <div class="space-y-2">
                            <label for="city" class="block text-sm font-medium text-gray-800">Ville</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-500"></i>
                                </div>
                                <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}" class="bg-rose-100 border border-gray-300 text-gray-800 pl-10 pr-4 py-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-[#420718e2] focus:border-transparent">
                            </div>
                        </div>

                        <!-- Téléphone -->
                        <div class="space-y-2">
                            <label for="phone_number" class="block text-sm font-medium text-gray-800">Numéro de téléphone</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-500"></i>
                                </div>
                                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="bg-rose-100 border border-gray-300 text-gray-800 pl-10 pr-4 py-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-[#420718e2] focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Biographie -->
                    <div class="space-y-2">
                        <label for="bio" class="block text-sm font-medium text-gray-800">Biographie</label>
                        <textarea id="bio" name="bio" rows="4" class="bg-rose-100 border border-gray-300 text-gray-800 px-4 py-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-[#420718e2] focus:border-transparent">{{ old('bio', $user->bio) }}</textarea>
                        <p class="text-xs text-gray-600">Partagez quelques informations sur vous-même pour que les autres utilisateurs puissent vous connaître.</p>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row justify-center items-center gap-3 sm:gap-4 mt-8">
                    <button type="submit" class="w-full sm:w-auto bg-[#420718e2] text-white px-6 py-3 rounded-lg hover:bg-[#2d050fe2] transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('profile') }}" class="w-full sm:w-auto bg-rose-200 text-[#420718e2] px-6 py-3 rounded-lg hover:bg-rose-300 transition-all flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Auto-fermeture des alertes après 5 secondes
    setTimeout(function() {
        const alerts = document.querySelectorAll('#success-alert, #error-alert, #validation-errors');
        alerts.forEach(function(alert) {
            if (alert) {
                alert.style.display = 'none';
            }
        });
    }, 5000);
    </script>
@endsection