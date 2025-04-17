@extends('Layout.dashboard')
@section('title', 'Profil Utilisateur')
@section('content')

    <!-- Main Content -->
    <div class="container mx-auto p-4 mt-9">
        
        <!-- En-tête du profil -->
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 mb-8">
            <div class="flex flex-col md:flex-row items-center md:items-start">
                <!-- Photo de profil -->
                <div class="relative mb-4 md:mb-0 md:mr-8">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-red-600">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo de profil" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-user text-4xl text-gray-500"></i>
                            </div>
                        @endif
                    </div>
                    <a href="" class="absolute bottom-0 right-0 bg-red-600 w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-700 transition-all">
                        <i class="fas fa-camera text-white"></i>
                    </a>
                </div>
                
                <!-- Informations de base -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-col md:flex-row md:items-center mb-2">
                        <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                        <span class="bg-{{ $user->status === 'active' ? 'green' : ($user->status === 'suspended' ? 'red' : 'yellow') }}-600/20 text-{{ $user->status === 'active' ? 'green' : ($user->status === 'suspended' ? 'red' : 'yellow') }}-500 text-xs px-2 py-1 rounded ml-0 md:ml-3 mt-2 md:mt-0 inline-block">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    <p class="text-gray-400 mb-4">{{ $user->email }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-md bg-gray-700 flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-red-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Ville</p>
                                <p class="font-medium">{{ $user->city }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-md bg-gray-700 flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-red-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Téléphone</p>
                                <p class="font-medium">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-2">
                        <a href="" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all flex items-center text-sm">
                            <i class="fas fa-edit mr-2"></i>
                            Modifier le profil
                        </a>
                        <button class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all flex items-center text-sm">
                            <i class="fas fa-key mr-2"></i>
                            Changer le mot de passe
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Détails de l'utilisateur -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Informations personnelles -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium">Informations personnelles</h3>
                  
                </div>
                
                <div class="space-y-4">
                    <div class="bg-gray-700/30 rounded-lg p-4">
                        <h4 class="text-sm text-gray-400 mb-2">Nom</h4>
                        <p class="font-medium">{{ $user->name }}</p>
                    </div>
                    
                    <div class="bg-gray-700/30 rounded-lg p-4">
                        <h4 class="text-sm text-gray-400 mb-2">Email</h4>
                        <p class="font-medium">{{ $user->email }}</p>
                    </div>
                    
                    <div class="bg-gray-700/30 rounded-lg p-4">
                        <h4 class="text-sm text-gray-400 mb-2">Ville</h4>
                        <p class="font-medium">{{ $user->city }}</p>
                    </div>
                    
                    <div class="bg-gray-700/30 rounded-lg p-4">
                        <h4 class="text-sm text-gray-400 mb-2">Téléphone</h4>
                        <p class="font-medium">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                    </div>
                    
                    <div class="bg-gray-700/30 rounded-lg p-4">
                        <h4 class="text-sm text-gray-400 mb-2">Statut</h4>
                        <p class="font-medium">
                            <span class="px-2 py-1 rounded-full text-xs 
                                {{ $user->status === 'active' ? 'bg-green-600/20 text-green-500' : 
                                  ($user->status === 'suspended' ? 'bg-red-600/20 text-red-500' : 'bg-yellow-600/20 text-yellow-500') }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Biographie et Compte -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium">Profil</h3>
                  
                </div>
                
                <div class="bg-gray-700/30 rounded-lg p-4 mb-4">
                    <h4 class="text-sm text-gray-400 mb-2">Biographie</h4>
                    <p class="font-medium">
                        {{ $user->bio ?? 'Aucune biographie renseignée. Ajoutez une biographie pour vous présenter.' }}
                    </p>
                </div>
                
                <div class="bg-gray-700/30 rounded-lg p-4 mb-4">
                    <h4 class="text-sm text-gray-400 mb-2">Rôle</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-red-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-user-tag text-red-600"></i>
                        </div>
                        <span>{{ $user->role->name ?? 'Utilisateur' }}</span>
                    </div>
                </div>
                
                <div class="bg-gray-700/30 rounded-lg p-4 mb-4">
                    <h4 class="text-sm text-gray-400 mb-2">Date d'inscription</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-blue-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-blue-600"></i>
                        </div>
                        <span>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</span>
                    </div>
                </div>
                
                <div class="bg-gray-700/30 rounded-lg p-4">
                    <h4 class="text-sm text-gray-400 mb-2">Dernière mise à jour</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-green-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-green-600"></i>
                        </div>
                        <span>{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <a href="" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-all flex items-center">
                <i class="fas fa-user-edit mr-2"></i>
                Modifier mon profil
            </a>
            <button onclick="reloadPage()" class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all flex items-center">
                <i class="fas fa-sync-alt mr-2"></i>
                Actualiser les données
            </button>
        </div>
    </div>
    
    <script>
    function reloadPage() {
        location.reload();
    }
    </script>
    
@endsection