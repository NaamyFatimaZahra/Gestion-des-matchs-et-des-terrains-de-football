@extends('Layout.dashboard')
@section('title', 'Réservations des Terrains')
@section('content')

<div class="container mx-auto px-2 py-4 mt-[4rem] text-gray-800 bg-rose-50">
    <!-- En-tête avec navigation et titre -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="bg-[#580a21] hover:bg-[#420718] text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors duration-200 shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Réservations des Terrains</h1>
        </div>
    </div>

    <!-- Alerte de succès avec animation -->
    @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 sm:px-4 sm:py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
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
    <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 sm:px-4 sm:py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
        <button type="button" class="absolute top-0 right-0 px-3 py-2 sm:px-4 sm:py-3" onclick="this.parentElement.remove()">
            <span class="sr-only">Fermer</span>
            <i class="fas fa-times text-sm sm:text-base"></i>
        </button>
    </div>
    @endif

    <!-- Mobile view (visible only on small screens) -->
    <div class="block lg:hidden">
        <div class="space-y-4">
            @forelse($reservations as $reservation)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-3 sm:p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <div class="flex items-center">
                            <a href="{{ route('proprietaire.terrain.show',$reservation->terrain->id ) }}" class="text-[#580a21] hover:text-[#420718] hover:underline transition-colors font-semibold text-sm sm:text-base">
                                {{ $reservation->terrain->name ?? 'N/A' }}
                            </a>
                            <span class="ml-2 text-xs font-medium text-gray-500">#{{ $reservation->id }}</span>
                        </div>

                        <div class="mt-1 flex items-center">
                            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center mr-2 flex-shrink-0">
                                @if($reservation->user && $reservation->user->profile_photo)
                                <img src="{{ asset('storage/' . $reservation->user->profile_photo) }}" alt="Photo de profil" class="w-6 h-6 rounded-full object-cover">
                                @else
                                <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                @endif
                            </div>
                            <span class="text-xs text-gray-600 truncate">{{ $reservation->user->name ?? 'Client' }}</span>
                        </div>
                    </div>

                    <div>
                        @if ($reservation->status==='terminee')
                        <span class="bg-blue-500 text-white text-xs font-medium px-2 py-1 rounded-full inline-block">
                            {{ $reservation->status }}
                        </span>
                        @else
                        <form action="{{ route('proprietaire.reservation.update-status', $reservation->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-[#580a21] 
                                {{ $reservation->status == 'confirmee' ? 'bg-green-500 text-white border-green-400' : 
                                ($reservation->status == 'en_attente' ? 'bg-yellow-500 text-white border-yellow-400' : 
                                ($reservation->status == 'terminee' ? 'bg-blue-500 text-white border-blue-400' : 
                                'bg-red-500 text-white border-red-400')) }}">
                                <option value="confirmee" {{ $reservation->status == 'confirmee' ? 'selected' : '' }} class="text-white">Confirmée</option>
                                @if ($reservation->status == 'en_attente')
                                <option value="en_attente" {{ $reservation->status == 'en_attente' ? 'selected' : '' }} class="text-white">En attente</option>
                                @endif
                                <option value="annulee" {{ $reservation->status == 'annulee' ? 'selected' : '' }} class="text-white">Annulée</option>
                            </select>
                        </form>
                        @endif
                    </div>
                </div>

                <div class="mt-2 pt-2 border-t border-gray-100 grid grid-cols-2 gap-2">
                    <div>
                        <p class="text-xs text-gray-500">Date:</p>
                        <p class="text-xs font-medium text-gray-700">{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Durée:</p>
                        <p class="text-xs font-medium text-gray-700">{{ \Carbon\Carbon::parse($reservation->heure_debut)->diffInHours(\Carbon\Carbon::parse($reservation->heure_fin)) }}H</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Heure début:</p>
                        <p class="text-xs font-medium text-gray-700">{{ \Carbon\Carbon::parse($reservation->heure_debut)->format('H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Heure fin:</p>
                        <p class="text-xs font-medium text-gray-700">{{ \Carbon\Carbon::parse($reservation->heure_fin)->format('H:i') }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 text-center text-gray-500">
                <div class="flex flex-col items-center py-4">
                    <svg class="w-8 h-8 sm:w-12 sm:h-12 mb-2 sm:mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-sm sm:text-base">Aucune réservation trouvée</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Desktop view (visible only on large screens) -->
    <div class="hidden lg:block bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#580a21]">
                    <tr>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Terrain</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Client</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Heure début</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Heure fin</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Durée (H)</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Statut</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($reservations as $reservation)
                    <tr class="hover:bg-rose-50 transition-colors duration-200">
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            <span class="font-medium">#{{ $reservation->id }}</span>
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            <a href="{{ route('proprietaire.terrain.show',$reservation->terrain->id ) }}" class="text-[#580a21] hover:text-[#420718] hover:underline transition-colors">
                                {{ $reservation->terrain->name ?? 'N/A' }}
                            </a>
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            <div class="flex items-center">
                                <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-rose-50 flex items-center justify-center mr-2 flex-shrink-0">
                                    @if($reservation->user && $reservation->user->profile_photo)
                                    <img src="{{ asset('storage/' . $reservation->user->profile_photo) }}" alt="Photo de profil" class="w-6 h-6 sm:w-8 sm:h-8 rounded-full object-cover">
                                    @else
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    @endif
                                </div>
                                <span class="text-xs sm:text-sm text-gray-800 truncate max-w-[120px] lg:max-w-full">
                                    {{ $reservation->user->name ?? 'Client' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            {{ \Carbon\Carbon::parse($reservation->heure_debut)->format('H:i') }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            {{ \Carbon\Carbon::parse($reservation->heure_fin)->format('H:i') }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            {{ \Carbon\Carbon::parse($reservation->heure_debut)->diffInHours(\Carbon\Carbon::parse($reservation->heure_fin)) }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm">
                            @if ($reservation->status==='terminee')
                            <span class="bg-blue-500 text-white text-xs font-medium px-2.5 py-1 rounded-full">
                                {{ $reservation->status }}
                            </span>
                            @else
                            <form action="{{ route('proprietaire.reservation.update-status', $reservation->id) }}" method="POST">
                                @csrf
                                @method('patch')
                                <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-xs sm:text-sm focus:outline-none focus:ring-1 focus:ring-[#580a21] 
                                    {{ $reservation->status == 'confirmee' ? 'bg-green-500 text-white border-green-400' : 
                                    ($reservation->status == 'en_attente' ? 'bg-yellow-500 text-white border-yellow-400' : 
                                    ($reservation->status == 'terminee' ? 'bg-blue-500 text-white border-blue-400' : 
                                    'bg-red-500 text-white border-red-400')) }}">
                                    <option value="confirmee" {{ $reservation->status == 'confirmee' ? 'selected' : '' }} class="text-white">Confirmée</option>
                                    @if ($reservation->status == 'en_attente')
                                    <option value="en_attente" {{ $reservation->status == 'en_attente' ? 'selected' : '' }} class="text-white">En attente</option>
                                    @endif
                                    <option value="annulee" {{ $reservation->status == 'annulee' ? 'selected' : '' }} class="text-white">Annulée</option>
                                </select>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 sm:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm text-gray-500">
                            <div class="flex flex-col items-center py-4 sm:py-6">
                                <svg class="w-8 h-8 sm:w-12 sm:h-12 mb-2 sm:mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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

    <!-- Pagination (if necessary) -->
    @if(isset($reservations) && $reservations instanceof \Illuminate\Pagination\LengthAwarePaginator && $reservations->hasPages())
    <div class="mt-4 sm:mt-6 px-2" id="pagination-container">
        <nav class="flex items-center justify-between bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-2 sm:p-4">
            <div class="flex-1 flex justify-between">
                <!-- Mobile pagination -->
                <div class="flex items-center sm:hidden justify-between w-full">
                    @if($reservations->onFirstPage())
                    <span class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                        Préc.
                    </span>
                    @else
                    <a href="{{ $reservations->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
                        Préc.
                    </a>
                    @endif

                    <span class="text-xs text-gray-700 mx-2">
                        Page {{ $reservations->currentPage() }}/{{ $reservations->lastPage() }}
                    </span>

                    @if($reservations->hasMorePages())
                    <a href="{{ $reservations->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
                        Suiv.
                    </a>
                    @else
                    <span class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                        Suiv.
                    </span>
                    @endif
                </div>

                <!-- Desktop pagination -->
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs sm:text-sm text-gray-700">
                            Affichage de <span class="font-medium">{{ $reservations->firstItem() }}</span> à <span class="font-medium">{{ $reservations->lastItem() }}</span> sur <span class="font-medium">{{ $reservations->total() }}</span> réservations
                        </p>
                    </div>

                    <div>
                        <span class="relative z-0 inline-flex shadow-sm rounded-md">
                            {{-- Previous page link --}}
                            @if($reservations->onFirstPage())
                            <span class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md">
                                <span class="sr-only">Précédent</span>
                                <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            @else
                            <a href="{{ $reservations->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-l-md hover:bg-rose-50">
                                <span class="sr-only">Précédent</span>
                                <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            @endif

                            {{-- Pagination links - Limited to 5 on smaller screens --}}
                            @php
                            $window = 2; // Links shown on each side of current page
                            $currentPage = $reservations->currentPage();
                            $lastPage = $reservations->lastPage();
                            $startPage = max(1, $currentPage - $window);
                            $endPage = min($lastPage, $currentPage + $window);

                            // Always show first and last page
                            $showFirstDots = $startPage > 1;
                            $showLastDots = $endPage < $lastPage;
                                @endphp

                                @if($showFirstDots)
                                <a href="{{ $reservations->url(1) }}" class="hidden sm:inline-flex relative items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-rose-50 hover:text-[#580a21]">
                                1
                                </a>
                                @if($startPage > 2)
                                <span class="hidden sm:inline-flex relative items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300">
                                    ...
                                </span>
                                @endif
                                @endif

                                @foreach(range($startPage, $endPage) as $page)
                                @if($page == $currentPage)
                                <span class="relative inline-flex items-center px-3 sm:px-4 py-1 sm:py-2 text-xs sm:text-sm font-medium text-white bg-[#580a21] border border-[#580a21]">
                                    {{ $page }}
                                </span>
                                @else
                                <a href="{{ $reservations->url($page) }}" class="relative inline-flex items-center px-3 sm:px-4 py-1 sm:py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-rose-50 hover:text-[#580a21]">
                                    {{ $page }}
                                </a>
                                @endif
                                @endforeach

                                @if($showLastDots)
                                @if($endPage < $lastPage - 1)
                                    <span class="hidden sm:inline-flex relative items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300">
                                    ...
                        </span>
                        @endif
                        <a href="{{ $reservations->url($lastPage) }}" class="hidden sm:inline-flex relative items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-rose-50 hover:text-[#580a21]">
                            {{ $lastPage }}
                        </a>
                        @endif

                        {{-- Next page link --}}
                        @if($reservations->hasMorePages())
                        <a href="{{ $reservations->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-r-md hover:bg-rose-50">
                            <span class="sr-only">Suivant</span>
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @else
                        <span class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-r-md">
                            <span class="sr-only">Suivant</span>
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        @endif
                        </span>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    @endif
</div>

@endsection