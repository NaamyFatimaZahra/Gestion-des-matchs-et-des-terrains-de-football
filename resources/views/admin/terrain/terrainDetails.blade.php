@extends('Layout.dashboard')
@section('title', 'Détails du Terrain')
@section('content')

<div class="container mx-auto px-4 py-8 mt-[4rem] text-gray-300">
    <!-- En-tête avec titre et boutons d'action -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.terrains.index') }}" class="bg-gray-700 hover:bg-gray-600 rounded-full w-8 h-8 flex items-center justify-center">
                <i class="fas fa-arrow-left text-gray-400"></i>
            </a>
            <h1 class="text-2xl font-bold text-white">Détails du Terrain</h1>
        </div>
        <div class="flex gap-3">
           
            <a href="" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm flex items-center">
                <i class="fas fa-calendar-alt mr-2"></i> Disponibilités
            </a>
        </div>
    </div>

    @if(session('success'))
        <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>

        <script>
            setTimeout(function() {
                const alert = document.getElementById('success-alert');
                if(alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }
            }, 2000);
        </script>
    @endif

    <!-- Informations principales du terrain -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Colonne 1: Image et statuts -->
        <div class="bg-gray-900 rounded-lg shadow-md overflow-hidden border border-gray-700">
            <div class="relative h-48 bg-gray-800">
                <img src="/api/placeholder/400/320" alt="Photo du terrain" class="w-full h-full object-cover">
                <div class="absolute top-4 right-4 flex flex-col space-y-2">
                    <span class="bg-red-600 text-white text-xs px-2 py-1 rounded">
                      
                    </span>
                </div>
            </div>
            <div class="p-4">
                <h2 class="text-xl font-bold text-white mb-2">{{ $terrain->name }}</h2>
                <div class="flex items-center text-gray-400 text-sm mb-3">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span>{{ $terrain->adress }}, {{ $terrain->city }}</span>
                </div>
                
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-2 py-1 text-xs font-semibold rounded
                        {{ $terrain->status === 'disponible' ? 'bg-green-900 text-green-100' : 
                         ($terrain->status === 'occupé' ? 'bg-blue-900 text-blue-100' : 
                         ($terrain->status === 'maintenance' ? 'bg-yellow-900 text-yellow-100' : 'bg-gray-700 text-gray-300')) }}">
                        {{ $terrain->status === 'disponible' ? 'Disponible' : 
                           ($terrain->status === 'occupé' ? 'Occupé' : 
                           ($terrain->status === 'maintenance' ? 'Maintenance' : 'En attente')) }}
                    </span>
                    
                    <span class="px-2 py-1 text-xs font-semibold rounded
                        {{ $terrain->admin_approval === 'approuve' ? 'bg-green-900 text-green-100' : 
                         ($terrain->admin_approval === 'rejete' ? 'bg-red-900 text-red-100' : 
                         ($terrain->admin_approval === 'suspended' ? 'bg-orange-900 text-orange-100' : 'bg-yellow-900 text-yellow-100')) }}">
                        {{ $terrain->admin_approval === 'approuve' ? 'Approuvé' : 
                           ($terrain->admin_approval === 'rejete' ? 'Rejeté' : 
                           ($terrain->admin_approval === 'suspended' ? 'Suspendu' : 'En attente d\'approbation')) }}
                    </span>
                </div>
                
                <div class="border-t border-gray-800 pt-3 mt-3">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-400">Prix:</span>
                        <span class="font-semibold text-white">{{ number_format($terrain->price, 2) }} MAD/heure</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-400">Méthode de paiement:</span>
                        <span>{{ $terrain->payment_method === 'en_ligne' ? 'En ligne' : 
                             ($terrain->payment_method === 'sur_place' ? 'Sur place' : 'Les deux') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Capacité:</span>
                        <span>{{ $terrain->capacity ?? 'Non spécifié' }} joueurs</span>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 pt-3 mt-3">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-400">Réservations:</span>
                        <span class="font-semibold">{{ $terrain->reservation_count }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Date d'ajout:</span>
                        <span>{{ $terrain->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Colonne 2: Détails & Propriétaire -->
        <div class="bg-gray-900 rounded-lg shadow-md overflow-hidden border border-gray-700 lg:col-span-2">
            <div class="p-4 border-b border-gray-800">
                <h3 class="text-lg font-semibold mb-2">Description</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    {{ $terrain->description ?? 'Aucune description disponible.' }}
                </p>
            </div>
            
            <div class="p-4 border-b border-gray-800">
                <h3 class="text-lg font-semibold mb-3">Informations sur le propriétaire</h3>
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-gray-700 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <div>
                        <div class="font-medium">{{ $terrain->proprietaire->name ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-400">{{ $terrain->proprietaire->email ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-400">Contact: {{ $terrain->contact ?? 'Non spécifié' }}</div>
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-3">Localisation</h3>
                <div class="h-52 bg-gray-800 rounded-lg relative mb-3">
                    <img src="/api/placeholder/400/320" alt="Carte" class="w-full h-full object-cover rounded-lg">
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="text-sm text-gray-400">Adresse</div>
                        <div>{{ $terrain->adress }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-400">Ville</div>
                        <div>{{ $terrain->city }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-400">Latitude</div>
                        <div>{{ $terrain->latitude ?? 'Non spécifié' }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-400">Longitude</div>
                        <div>{{ $terrain->longitude ?? 'Non spécifié' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Réservations récentes -->
    <div class="bg-gray-900 rounded-lg shadow-md overflow-hidden border border-gray-700 mb-6">
        <div class="p-4 border-b border-gray-800 flex justify-between items-center">
            <h3 class="font-semibold">Réservations récentes</h3>
            <a href="" class="text-sm text-red-500 hover:text-red-400">Voir toutes</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Heure
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Client
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Montant
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-800">
                    @forelse($reservations ?? [] as $reservation)
                    <tr class="hover:bg-gray-800 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $reservation->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $reservation->date_reservation->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $reservation->heure_debut }} - {{ $reservation->heure_fin }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $reservation->user->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded
                                {{ $reservation->status === 'confirmee' ? 'bg-green-900 text-green-100' : 
                                 ($reservation->status === 'en_attente' ? 'bg-yellow-900 text-yellow-100' : 
                                 ($reservation->status === 'annulee' ? 'bg-red-900 text-red-100' : 'bg-blue-900 text-blue-100')) }}">
                                {{ $reservation->status === 'confirmee' ? 'Confirmée' : 
                                   ($reservation->status === 'en_attente' ? 'En attente' : 
                                   ($reservation->status === 'annulee' ? 'Annulée' : 'Terminée')) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ number_format($reservation->montant, 2) }} MAD
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-400">
                            Aucune réservation trouvée.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Actions administratives -->
    <div class="bg-gray-900 rounded-lg shadow-md overflow-hidden border border-gray-700">
        <div class="p-4 border-b border-gray-800">
            <h3 class="font-semibold">Actions administratives</h3>
        </div>
        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
           
            
            <div>
                <h4 class="text-sm font-medium mb-2">Modifier l'approbation administrative</h4>
                <form action="{{ route('admin.terrains.update-approval', $terrain->id) }}" method="POST" class="flex items-center space-x-2">
                    @csrf
                    @method('PATCH')
                    <select name="admin_approval" class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white flex-grow">
                        <option value="en_attente" {{ $terrain->admin_approval === 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="approuve" {{ $terrain->admin_approval === 'approuve' ? 'selected' : '' }}>Approuvé</option>
                        <option value="rejete" {{ $terrain->admin_approval === 'rejete' ? 'selected' : '' }}>Rejeté</option>
                        <option value="suspended" {{ $terrain->admin_approval === 'suspended' ? 'selected' : '' }}>Suspendu</option>
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection