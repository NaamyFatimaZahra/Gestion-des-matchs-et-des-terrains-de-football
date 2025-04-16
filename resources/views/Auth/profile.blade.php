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
                    <button class="absolute bottom-0 right-0 bg-red-600 w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-700 transition-all">
                        <i class="fas fa-camera text-white"></i>
                    </button>
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
                        <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all flex items-center text-sm">
                            <i class="fas fa-edit mr-2"></i>
                            Modifier le profil
                        </button>
                        <button class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all flex items-center text-sm">
                            <i class="fas fa-key mr-2"></i>
                            Changer le mot de passe
                        </button>
                        <button class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all flex items-center text-sm">
                            <i class="fas fa-cog mr-2"></i>
                            Paramètres
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistiques de l'utilisateur -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Réservations -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Réservations</h3>
                    <div class="w-10 h-10 rounded-full bg-red-600/20 flex items-center justify-center">
                        <i class="fas fa-calendar-check text-red-600"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <span class="text-3xl font-bold mr-2">{{ $stats['reservations_count'] ?? 24 }}</span>
                    <span class="text-green-500 flex items-center text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        8%
                    </span>
                </div>
                <p class="text-gray-400 text-sm mt-2">Depuis l'inscription</p>
                <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                    <div class="bg-red-600 h-1 rounded-full" style="width: 68%"></div>
                </div>
            </div>

            <!-- Terrains Favoris -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Favoris</h3>
                    <div class="w-10 h-10 rounded-full bg-blue-600/20 flex items-center justify-center">
                        <i class="fas fa-heart text-blue-600"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <span class="text-3xl font-bold mr-2">{{ $stats['favorites_count'] ?? 7 }}</span>
                    <span class="text-gray-400 flex items-center text-sm">
                        <i class="fas fa-equals mr-1"></i>
                        0%
                    </span>
                </div>
                <p class="text-gray-400 text-sm mt-2">Terrains favoris</p>
                <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                    <div class="bg-blue-600 h-1 rounded-full" style="width: 45%"></div>
                </div>
            </div>

            <!-- Commentaires -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Commentaires</h3>
                    <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center">
                        <i class="fas fa-comment text-green-600"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <span class="text-3xl font-bold mr-2">{{ $stats['comments_count'] ?? 12 }}</span>
                    <span class="text-green-500 flex items-center text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        22%
                    </span>
                </div>
                <p class="text-gray-400 text-sm mt-2">Avis laissés</p>
                <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                    <div class="bg-green-600 h-1 rounded-full" style="width: 35%"></div>
                </div>
            </div>
            
            <!-- Membre depuis -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Membre depuis</h3>
                    <div class="w-10 h-10 rounded-full bg-purple-600/20 flex items-center justify-center">
                        <i class="fas fa-user-clock text-purple-600"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <span class="text-3xl font-bold mr-2">{{ $stats['days_member'] ?? 128 }}</span>
                    <span class="text-gray-400 flex items-center text-sm">jours</span>
                </div>
                <p class="text-gray-400 text-sm mt-2">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</p>
                <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                    <div class="bg-purple-600 h-1 rounded-full" style="width: 80%"></div>
                </div>
            </div>
        </div>

        <!-- Contenu détaillé -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Bio et informations -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium">À propos</h3>
                    <button class="text-xs text-red-600">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
                
                <div class="mb-6">
                    <h4 class="text-sm text-gray-400 mb-2">Biographie</h4>
                    <p class="text-gray-300">
                        {{ $user->bio ?? 'Cet utilisateur n\'a pas encore ajouté de biographie.' }}
                    </p>
                </div>
                
                <div class="mb-6">
                    <h4 class="text-sm text-gray-400 mb-2">Rôle</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-red-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-user-tag text-red-600"></i>
                        </div>
                        <span>{{ $user->role->name ?? 'Utilisateur' }}</span>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h4 class="text-sm text-gray-400 mb-2">Date d'inscription</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-blue-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-blue-600"></i>
                        </div>
                        <span>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</span>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-sm text-gray-400 mb-2">Dernière connexion</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-green-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-green-600"></i>
                        </div>
                        <span>{{ $user->last_login ?? 'Aujourd\'hui à 15:32' }}</span>
                    </div>
                </div>
            </div>

            <!-- Historique des réservations -->
            <div class="col-span-1 lg:col-span-2 bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium">Historique des réservations</h3>
                    <div class="flex space-x-2">
                        <button class="bg-gray-700 text-xs px-3 py-1 rounded hover:bg-gray-600">Récentes</button>
                        <button class="bg-red-600 text-xs px-3 py-1 rounded">Toutes</button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-gray-400 text-left text-sm">
                                <th class="pb-3 font-medium">Terrain</th>
                                <th class="pb-3 font-medium">Date</th>
                                <th class="pb-3 font-medium">Horaire</th>
                                <th class="pb-3 font-medium">Statut</th>
                                <th class="pb-3 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <!-- Boucle pour afficher les réservations -->
                            @foreach($reservations ?? [] as $reservation)
                                <tr class="text-gray-300">
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-md bg-red-600/20 flex items-center justify-center mr-3">
                                                <i class="fas fa-futbol text-red-600"></i>
                                            </div>
                                            <span>{{ $reservation->field->name ?? 'Stade Municipal' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3">{{ $reservation->date ?? '12/04/2025' }}</td>
                                    <td class="py-3">{{ $reservation->time_slot ?? '18:00 - 20:00' }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            @if(($reservation->status ?? 'confirmé') == 'confirmé') 
                                                bg-green-600/20 text-green-500
                                            @elseif(($reservation->status ?? 'confirmé') == 'en attente')
                                                bg-yellow-600/20 text-yellow-500
                                            @else
                                                bg-red-600/20 text-red-500
                                            @endif">
                                            {{ $reservation->status ?? 'Confirmé' }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex space-x-1">
                                            <button class="bg-blue-600/20 text-blue-500 p-2 rounded hover:bg-blue-600/40">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="bg-red-600/20 text-red-500 p-2 rounded hover:bg-red-600/40">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                            <!-- Exemple de réservations statiques si pas de données -->
                            @if(empty($reservations))
                                <tr class="text-gray-300">
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-md bg-red-600/20 flex items-center justify-center mr-3">
                                                <i class="fas fa-futbol text-red-600"></i>
                                            </div>
                                            <span>Stade Municipal</span>
                                        </div>
                                    </td>
                                    <td class="py-3">12/04/2025</td>
                                    <td class="py-3">18:00 - 20:00</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-xs bg-green-600/20 text-green-500">
                                            Confirmé
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex space-x-1">
                                            <button class="bg-blue-600/20 text-blue-500 p-2 rounded hover:bg-blue-600/40">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="bg-red-600/20 text-red-500 p-2 rounded hover:bg-red-600/40">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-gray-300">
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-md bg-blue-600/20 flex items-center justify-center mr-3">
                                                <i class="fas fa-futbol text-blue-600"></i>
                                            </div>
                                            <span>Terrain Saint Michel</span>
                                        </div>
                                    </td>
                                    <td class="py-3">09/04/2025</td>
                                    <td class="py-3">14:00 - 16:00</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-xs bg-yellow-600/20 text-yellow-500">
                                            En attente
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex space-x-1">
                                            <button class="bg-blue-600/20 text-blue-500 p-2 rounded hover:bg-blue-600/40">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="bg-red-600/20 text-red-500 p-2 rounded hover:bg-red-600/40">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-gray-300">
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-md bg-green-600/20 flex items-center justify-center mr-3">
                                                <i class="fas fa-futbol text-green-600"></i>
                                            </div>
                                            <span>Complexe Sportif</span>
                                        </div>
                                    </td>
                                    <td class="py-3">01/04/2025</td>
                                    <td class="py-3">20:00 - 22:00</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-xs bg-red-600/20 text-red-500">
                                            Annulé
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex space-x-1">
                                            <button class="bg-blue-600/20 text-blue-500 p-2 rounded hover:bg-blue-600/40">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="bg-gray-600/20 text-gray-500 p-2 rounded cursor-not-allowed">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6 flex justify-center">
                    <nav class="flex space-x-1">
                        <a href="#" class="px-3 py-1 rounded bg-gray-700 text-gray-300 hover:bg-gray-600">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="px-3 py-1 rounded bg-red-600 text-white">1</a>
                        <a href="#" class="px-3 py-1 rounded bg-gray-700 text-gray-300 hover:bg-gray-600">2</a>
                        <a href="#" class="px-3 py-1 rounded bg-gray-700 text-gray-300 hover:bg-gray-600">3</a>
                        <a href="#" class="px-3 py-1 rounded bg-gray-700 text-gray-300 hover:bg-gray-600">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        
        <!-- Section des terrains favoris -->
        <div class="mt-8 bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium">Terrains favoris</h3>
                <button class="text-xs text-red-600">Voir tous</button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Terrain favori 1 -->
                <div class="bg-gray-700/30 rounded-lg p-4 hover:bg-gray-700/50 transition-all">
                    <div class="relative h-40 mb-3 rounded-md overflow-hidden">
                        <img src="/api/placeholder/400/320" alt="Terrain" class="w-full h-full object-cover">
                        <div class="absolute top-2 right-2">
                            <button class="bg-red-600 w-8 h-8 rounded-full flex items-center justify-center">
                                <i class="fas fa-heart text-white"></i>
                            </button>
                        </div>
                    </div>
                    <h4 class="font-medium text-white">Stade Municipal</h4>
                    <p class="text-xs text-gray-400 mb-2">Paris, France</p>
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-500">
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star-half-alt text-xs"></i>
                        </div>
                        <span class="text-xs text-gray-400 ml-1">(48 avis)</span>
                    </div>
                    <button class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition-all text-sm">
                        Réserver
                    </button>
                </div>
                
                <!-- Terrain favori 2 -->
                <div class="bg-gray-700/30 rounded-lg p-4 hover:bg-gray-700/50 transition-all">
                    <div class="relative h-40 mb-3 rounded-md overflow-hidden">
                        <img src="/api/placeholder/400/320" alt="Terrain" class="w-full h-full object-cover">
                        <div class="absolute top-2 right-2">
                            <button class="bg-red-600 w-8 h-8 rounded-full flex items-center justify-center">
                                <i class="fas fa-heart text-white"></i>
                            </button>
                        </div>
                    </div>
                    <h4 class="font-medium text-white">Terrain Saint Michel</h4>
                    <p class="text-xs text-gray-400 mb-2">Lyon, France</p>
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-500">
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star text-xs"></i>
                            <i class="far fa-star text-xs"></i>
                        </div>
                        <span class="text-xs text-gray-400 ml-1">(36 avis)</span>
                    </div>
                    <button class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition-all text-sm">
                        Réserver
                    </button>
                </div>
                
                <!-- Terrain favori 3 -->
                <div class="bg-gray-700/30 rounded-lg p-4 hover:bg-gray-700/50 transition-all">
                    <div class="relative h-40 mb-3 rounded-md overflow-hidden">
                        <img src="/api/placeholder/400/320" alt="Terrain" class="w-full h-full object-cover">
                        <div class="absolute top-2 right-2">
                            <button class="bg-red-600 w-8 h-8 rounded-full flex items-center justify-center">
                                <i class="fas fa-heart text-white"></i>
                            </button>
                        </div>
                    </div>
                    <h4 class="font-medium text-white">Complexe Sportif</h4>
                    <p class="text-xs text-gray-400 mb-2">Marseille, France</p>
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-500">
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star text-xs"></i>
                            <i class="fas fa-star-half-alt text-xs"></i>
                            <i class="far fa-star text-xs"></i>
                        </div>
                        <span class="text-xs text-gray-400 ml-1">(22 avis)</span>
                    </div>
                    <button class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition-all text-sm">
                        Réserver
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Boutons d'action -->
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <button class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-all flex items-center">
                <i class="fas fa-calendar-plus mr-2"></i>
                Nouvelle réservation
            </button>
            <button class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all flex items-center">
                <i class="fas fa-history mr-2"></i>
                Historique complet
            </button>
            <button class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all flex items-center">
                <i class="fas fa-file-download mr-2"></i>
                Exporter les données
            </button>
        </div>
    </div>
    
@endsection