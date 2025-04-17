@extends('Layout.dashboard')
@section('title', 'Réservations des Terrains')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 text-gray-200">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Alerte de succès avec animation -->
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
                <a href="{{url()->previous()}} class="bg-gray-700 hover:bg-gray-600 text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors duration-200 shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-white">Réservations des Terrains</h1>
            </div>
            
            <div>
                <a href="" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition-colors duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nouvelle réservation
                </a>
            </div>
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

                                        <option value="terminee" {{ $reservation->status == 'terminee' ? 'selected' : '' }} class=" text-white">Terminée</option>
                                        <option value="annulee" {{ $reservation->status == 'annulee' ? 'selected' : '' }} class=" text-white">Annulée</option>
                                    </select>

                                </form>
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
</div>

@endsection