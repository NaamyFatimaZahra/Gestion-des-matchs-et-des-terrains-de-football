@extends('Layout.dashboard')
@section('title', 'Détails du Terrain')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 text-gray-200">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Alerte de succès avec animation -->
       @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

    <script>
        // Faire disparaître le message après 2 secondes
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if(alert) {
                // Option 1: Suppression immédiate
                // alert.remove();
                
                // Option 2: Disparition en fondu (plus élégant)
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }
        }, 2000);
    </script>
@endif

<!-- Message d'erreur général -->
   @if(session('error'))
    <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
        <button type="button" class="absolute top-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
            <span class="sr-only">Fermer</span>
            <i class="fas fa-times"></i>
        </button>
    </div>
   @endif

        <!-- En-tête avec navigation et titre -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
            <div class="flex items-center space-x-4">
                <a href="{{ url()->previous() }}" class="bg-gray-700 hover:bg-gray-600 text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors duration-200 shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-white">{{ $terrain->name }}</h1>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('proprietaire.terrain.edit', $terrain->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium flex items-center transition-colors duration-200 shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Modifier
                </a>
                <a href="" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg text-sm font-medium flex items-center transition-colors duration-200 shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Disponibilités
                </a>
            </div>
        </div>

        <!-- Cartes principales d'information -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
            <!-- Carte de l'image et infos principales -->
            <div class="lg:col-span-4 bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-700 transition-transform duration-300 hover:shadow-2xl">
                <!-- Remplacez la section existante de l'image du terrain -->
<div class="relative">
    <!-- Images du terrain avec slider -->
    <div class="slider-container relative h-64 overflow-hidden">
        <div class="slider-wrapper flex transition-transform duration-500 ease-in-out h-full">
            @foreach ($terrain->Documents()->pluck('photo_path') as $index => $image)
                <div class="slide flex-shrink-0 w-full h-full">
                    <img src="{{ asset('storage/'.$image) }}" alt="Photo du terrain {{ $index + 1 }}" class="w-full h-64 object-cover">
                </div>
            @endforeach
        </div>
        
        <!-- Contrôles slider -->
        <button class="slider-control prev absolute top-1/2 left-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="slider-control next absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        
        <!-- Indicateurs de position -->
        <div class="slider-dots absolute bottom-3 left-0 right-0 flex justify-center space-x-2 z-10">
            @foreach ($terrain->Documents()->pluck('photo_path') as $index => $image)
                <button class="slider-dot w-2 h-2 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-opacity" data-index="{{ $index }}"></button>
            @endforeach
        </div>
    </div>

    <!-- Statut du terrain (garder la même partie) -->
    <div class="absolute top-4 right-4 flex flex-col space-y-2">
        <span class="bg-opacity-80 bg-gray-900 text-white text-xs px-3 py-1 rounded-full flex items-center">
            <span class="w-2 h-2 rounded-full mr-2 
                {{ $terrain->status === 'disponible' ? 'bg-green-400' : 
                ($terrain->status === 'occupé' ? 'bg-blue-400' : 
                ($terrain->status === 'maintenance' ? 'bg-yellow-400' : 'bg-gray-400')) }}"></span>
            {{ $terrain->status === 'disponible' ? 'Disponible' : 
            ($terrain->status === 'occupé' ? 'Occupé' : 
            ($terrain->status === 'maintenance' ? 'Maintenance' : 'En attente')) }}
        </span>
        
        <span class="bg-opacity-80 bg-gray-900 text-white text-xs px-3 py-1 rounded-full flex items-center">
            <span class="w-2 h-2 rounded-full mr-2 
                {{ $terrain->admin_approval === 'approuve' ? 'bg-green-400' : 
                ($terrain->admin_approval === 'rejete' ? 'bg-red-400' : 
                ($terrain->admin_approval === 'suspended' ? 'bg-orange-400' : 'bg-yellow-400')) }}"></span>
            {{ $terrain->admin_approval === 'approuve' ? 'Approuvé' : 
            ($terrain->admin_approval === 'rejete' ? 'Rejeté' : 
            ($terrain->admin_approval === 'suspended' ? 'Suspendu' : 'En attente d\'approbation')) }}
        </span>
    </div>
</div>
                
                <div class="p-6">
                    <div class="flex items-center text-gray-300 text-sm mb-4">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>{{ $terrain->adress }}, {{ $terrain->city }}</span>
                    </div>
                    
                    <!-- Informations financières -->
                    <div class="bg-gray-900 bg-opacity-50 rounded-lg p-4 mb-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-400">Tarif horaire</span>
                            <span class="text-xl font-bold text-white">{{ number_format($terrain->price, 2) }} MAD</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-400 block mb-1">Paiement</span>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    {{ $terrain->payment_method === 'en_ligne' ? 'En ligne' : 
                                     ($terrain->payment_method === 'sur_place' ? 'Sur place' : 'Les deux') }}
                                </div>
                            </div>
                            <div>
                                <span class="text-gray-400 block mb-1">Capacité</span>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    {{ $terrain->capacity ?? 'Non spécifié' }} joueurs
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statistiques -->
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="bg-gray-900 bg-opacity-50 rounded-lg p-3">
                            <span class="block text-sm text-gray-400 mb-1">Réservations</span>
                            <span class="block text-xl font-bold">{{ $terrain->reservation_count }}</span>
                        </div>
                        <div class="bg-gray-900 bg-opacity-50 rounded-lg p-3">
                            <span class="block text-sm text-gray-400 mb-1">Ajouté le</span>
                            <span class="block text-lg">{{ $terrain->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Section d'informations détaillées -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Description et propriétaire -->
                <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-700">
                    <div class="lg:flex">
                        <div class="lg:w-2/3 p-6">
                            <h3 class="text-xl font-semibold mb-4 flex items-center text-white">
                                <svg class="w-5 h-5 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Description
                            </h3>
                            <div class="text-gray-300 leading-relaxed">
                                {{ $terrain->description ?? 'Aucune description disponible pour ce terrain.' }}
                            </div>
                        </div>
                        
                        <div class="lg:w-1/3 p-6 bg-gray-850 bg-opacity-50 lg:border-l border-gray-700">
                            <h3 class="text-xl font-semibold mb-4 flex items-center text-white">
                                <svg class="w-5 h-5 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Propriétaire
                            </h3>
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-full bg-gray-700 flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-white">{{ $terrain->proprietaire->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-400">{{ $terrain->proprietaire->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="flex items-center text-gray-300">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $terrain->contact ?? 'Non spécifié' }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Localisation -->
                <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4 flex items-center text-white">
                            <svg class="w-5 h-5 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Localisation
                        </h3>
                        
                        <div  id="map" class="relative h-64 bg-gray-900 rounded-lg overflow-hidden mb-4">
                            <img src="/api/placeholder/400/320" alt="Carte" class="w-full h-full object-cover">
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                                <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center mb-1 shadow-lg animate-bounce">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">{{ $terrain->name }}</div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-gray-900 bg-opacity-60 p-3 rounded-lg">
                                <div class="text-sm text-gray-400 mb-1">Adresse</div>
                                <div class="font-medium">{{ $terrain->adress }}</div>
                            </div>
                            <div class="bg-gray-900 bg-opacity-60 p-3 rounded-lg">
                                <div class="text-sm text-gray-400 mb-1">Ville</div>
                                <div class="font-medium">{{ $terrain->city }}</div>
                            </div>
                            <div class="bg-gray-900 bg-opacity-60 p-3 rounded-lg">
                                <div class="text-sm text-gray-400 mb-1">Latitude</div>
                                <div class="font-medium">{{ $terrain->latitude ?? 'Non spécifié' }}</div>
                            </div>
                            <div class="bg-gray-900 bg-opacity-60 p-3 rounded-lg">
                                <div class="text-sm text-gray-400 mb-1">Longitude</div>
                                <div class="font-medium">{{ $terrain->longitude ?? 'Non spécifié' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        





<!-- Services du terrain -->
<div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-700 mb-8">
    <div class="p-6 border-b border-gray-700 flex justify-between items-center">
        <h3 class="text-xl font-semibold flex items-center text-white">
            <svg class="w-5 h-5 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            Services disponibles
        </h3>
        
    </div>
    
    <div class="p-6">
        @if($terrain->services && $terrain->services->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($terrain->services as $service)
            
                <div class="bg-gray-900 bg-opacity-60 rounded-lg p-4 border border-gray-700 hover:border-gray-600 transition-all duration-200">
                    <div class="flex items-center mb-3">
                     
                        <div>
                            <div class="font-medium text-white">{{ $service->name}}</div>
                            <div class="text-sm text-gray-400">
                                @if($service->pivot->price > 0)
                                    {{ number_format($service->pivot->price, 2) }} MAD
                                @else
                                    Gratuit
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center py-10 text-center">
                <svg class="w-16 h-16 mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <p class="text-gray-400 mb-4">Aucun service n'est actuellement configuré pour ce terrain.</p>
                <a href="" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium flex items-center transition-colors duration-200 shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Ajouter des services
                </a>
            </div>
        @endif
    </div>
</div>















        <!-- Réservations récentes -->
        <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-700 mb-8">
            <div class="p-6 border-b border-gray-700 flex justify-between items-center">
                <h3 class="text-xl font-semibold flex items-center text-white">
                    <svg class="w-5 h-5 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Réservations récentes
                </h3>
                <a href="" class="bg-gray-700 hover:bg-gray-600 text-white text-sm px-4 py-2 rounded-lg flex items-center transition-colors duration-200">
                    <span>Voir toutes</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Tableau des réservations -->
        <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Terrain</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Heure début</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Heure fin</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Durée (H)</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse($reservations as $reservation)
                        <tr class="hover:bg-gray-750 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="font-medium text-white">#{{ $reservation->id }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{   route('proprietaire.terrain.show',$reservation->terrain->id )  }}" class="text-blue-400 hover:text-blue-300 hover:underline transition-colors">
                                    {{ $reservation->terrain->name ?? 'N/A' }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center mr-2">
                                        @if($reservation->user && $reservation->user->profile_photo)
                                            <img src="{{ asset('storage/' . $reservation->user->profile_photo) }}" alt="Photo de profil" class="w-8 h-8 rounded-full object-cover">
                                        @else
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="text-gray-300">
                                        {{ $reservation->reservationUsers->count() }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ \Carbon\Carbon::parse($reservation->heure_debut)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ \Carbon\Carbon::parse($reservation->heure_fin)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ \Carbon\Carbon::parse($reservation->heure_debut)->diffInHours(\Carbon\Carbon::parse($reservation->heure_fin)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                              @if ($reservation->status==='terminee')
                              <span class="bg-blue-500 text-white text-xs font-medium px-2.5 py-1 rounded-full">
                                  {{ $reservation->status }}
                              </span>
                              @else
                                <form action="{{ route('proprietaire.reservation.update-status', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                                                       <select name="status" onchange="this.form.submit()" class="border rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 
                                        {{ $reservation->status == 'confirmee' ? 'bg-green-700 text-white border-green-600' : 
                                           ($reservation->status == 'en_attente' ? 'bg-yellow-700 text-white border-yellow-600' : 
                                           ($reservation->status == 'terminee' ? 'bg-blue-700 text-white border-blue-600' : 
                                           'bg-red-700 text-white border-red-600')) }}">
                                        <option value="confirmee" {{ $reservation->status == 'confirmee' ? 'selected' : '' }} class=" text-white">Confirmée</option>

                                          @if ($reservation->status == 'en_attente')
                                        <option value="en_attente" {{ $reservation->status == 'en_attente' ? 'selected' : '' }} class=" text-white">En attente</option>
                                          @endif

                                        <option value="annulee" {{ $reservation->status == 'annulee' ? 'selected' : '' }} class=" text-white">Annulée</option>
                                    </select>

                                </form>
                              @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 mb-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p>Aucune réservation trouvée</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        
        <!-- Actions administratives -->
        <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-700">
            <div class="p-6 border-b border-gray-700">
                <h3 class="text-xl font-semibold flex items-center text-white">
                    <svg class="w-5 h-5 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    Actions administratives
                </h3>
            </div>
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Statut du terrain -->
                <div class="bg-gray-900 bg-opacity-50 p-5 rounded-lg">
                    <h4 class="text-lg font-medium mb-4 text-white">Modifier le statut du terrain</h4>
                    <form action="{{ route('proprietaire.terrain.update-status', $terrain->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-400 mb-2">Statut opérationnel</label>
                                <select id="status" name="status" class="bg-gray-800 text-white border border-gray-700 rounded-lg px-4 py-3 w-full focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                                    <option value="disponible" {{ $terrain->status === 'disponible' ? 'selected' : '' }}>
                                        <option value="disponible" {{ $terrain->status === 'disponible' ? 'selected' : '' }}>Disponible</option>
                                    <option value="occupé" {{ $terrain->status === 'occupé' ? 'selected' : '' }}>Occupé</option>
                                    <option value="maintenance" {{ $terrain->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                @if ($terrain->status === 'en_attente')
                                    <option value="en_attente" selected>En attente</option>
                                
                                @endif
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg text-sm font-medium w-full flex items-center justify-center transition-colors duration-200 shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Mettre à jour le statut
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
               
                <!-- Suppression du terrain -->
                <div class="bg-gray-900 bg-opacity-50 p-5 rounded-lg">
                    <h4 class="text-lg font-medium mb-4 text-white">Supprimer ce terrain</h4>
                    <p class="text-sm text-gray-400 mb-4">Attention: La suppression est irréversible et supprimera toutes les réservations associées à ce terrain.</p>
                    <form action="{{ route('proprietaire.terrain.destroy', $terrain->id) }}" method="POST" class="space-y-4" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce terrain? Cette action est irréversible.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg text-sm font-medium w-full flex items-center justify-center transition-colors duration-200 shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer ce terrain
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Commentaires et évaluations -->
        <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-700 mt-8">
            <div class="p-6 border-b border-gray-700">
                <h3 class="text-xl font-semibold flex items-center text-white">
                    <svg class="w-5 h-5 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    Commentaires et évaluations
                </h3>
            </div>
            
            <div class="p-6">
               {{-- Blade Template for Comments --}}
@forelse($terrain->comments as $comment)
    <div class="border-b border-gray-700 pb-5 mb-5 last:border-b-0 last:mb-0 last:pb-0">
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <div class="font-medium text-white">{{ $comment->user->name ?? 'Client Anonyme' }}</div>
                    <div class="text-sm text-gray-400">{{ $comment->created_at->format('d/m/Y') }}</div>
                </div>
            </div>
            <div class="flex items-center">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-600' }}" 
                         fill="currentColor" 
                         viewBox="0 0 20 20" 
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                @endfor
                
                {{-- Delete button/icon - Only show if user can delete --}}
             
                    <form method="POST" action="{{ route('proprietaire.comment.destroy', $comment) }}" class="ml-4" 
                        >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
             
            </div>
        </div>
        <div class="text-gray-300">
            {{ $comment->content }}
        </div>
    </div>
@empty
    <div class="text-center text-gray-400 py-4">
        Aucun commentaire disponible
    </div>
@endforelse
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqVU_6aeLYTiHfc4MLSvHrWri6wZ6SdwI"></script>
<script src="{{ asset('js/showMap.js') }}">

    
</script>
<script>
    
   document.addEventListener("DOMContentLoaded", function () {
                              showMap('{{ $terrain->latitude}}','{{ $terrain->longitude }}');
    });
   
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Éléments du slider
    const sliderWrapper = document.querySelector('.slider-wrapper');
    const slides = document.querySelectorAll('.slide');
    const prevButton = document.querySelector('.slider-control.prev');
    const nextButton = document.querySelector('.slider-control.next');
    const dots = document.querySelectorAll('.slider-dot');
    
    // Nombre total d'images
    const slideCount = slides.length;
    
    // Index actuel du slider
    let currentSlide = 0;
    
    // Masquer les contrôles si une seule image
    if (slideCount <= 1) {
        if (prevButton) prevButton.style.display = 'none';
        if (nextButton) nextButton.style.display = 'none';
        document.querySelector('.slider-dots').style.display = 'none';
        return;
    }
    
    // Mettre à jour l'affichage du slider
    function updateSlider() {
        // Déplacer le wrapper
        sliderWrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Mettre à jour les indicateurs
        dots.forEach((dot, index) => {
            if (index === currentSlide) {
                dot.classList.add('bg-opacity-100', 'w-3', 'h-3');
            } else {
                dot.classList.remove('bg-opacity-100', 'w-3', 'h-3');
            }
        });
    }
    
    // Action du bouton précédent
    if (prevButton) {
        prevButton.addEventListener('click', function() {
            currentSlide = (currentSlide - 1 + slideCount) % slideCount;
            updateSlider();
        });
    }
    
    // Action du bouton suivant
    if (nextButton) {
        nextButton.addEventListener('click', function() {
            currentSlide = (currentSlide + 1) % slideCount;
            updateSlider();
        });
    }
    
    // Action des points indicateurs
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            currentSlide = index;
            updateSlider();
        });
    });
    
    // Activer le premier indicateur au chargement
    if (dots.length > 0) {
        dots[0].classList.add('bg-opacity-100', 'w-3', 'h-3');
    }
    
    // Défilement automatique (optionnel)
    let autoSlide = setInterval(() => {
        currentSlide = (currentSlide + 1) % slideCount;
        updateSlider();
    }, 5000); // Changer d'image toutes les 5 secondes
    
    // Arrêter le défilement auto au survol
    const sliderContainer = document.querySelector('.slider-container');
    sliderContainer.addEventListener('mouseenter', () => {
        clearInterval(autoSlide);
    });
    
    // Reprendre le défilement auto quand la souris quitte le slider
    sliderContainer.addEventListener('mouseleave', () => {
        autoSlide = setInterval(() => {
            currentSlide = (currentSlide + 1) % slideCount;
            updateSlider();
        }, 5000);
    });
    
    // Gestion du swipe sur mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    sliderContainer.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, {passive: true});
    
    sliderContainer.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, {passive: true});
    
    function handleSwipe() {
        // Déterminer si le swipe est assez long pour être considéré
        if (Math.abs(touchEndX - touchStartX) > 50) {
            if (touchEndX < touchStartX) {
                // Swipe vers la gauche - image suivante
                currentSlide = (currentSlide + 1) % slideCount;
            } else {
                // Swipe vers la droite - image précédente
                currentSlide = (currentSlide - 1 + slideCount) % slideCount;
            }
            updateSlider();
        }
    }
});
</script>


@endsection