@extends('Layout.guest')
@section('title', 'Liste des Squads')
@section('content')
<section class="w-[100%] min-h-[100vh] relative">
    <!-- Image de fond -->
    <div class="relative md:w-[100%] w-[100%] h-full">
        <img 
            src="../assets/img/stud-red.svg" 
            class="fixed w-[100%] h-[100vh] object-cover z-[-3] md:brightness-[50%]" 
            alt="" 
        />
    </div>

    <div class="flex  min-h-[100vh] relative z-10 pt-16">
        <!-- Sidebar - Mobile Toggle -->
        <div class="md:hidden p-4 bg-[#685f5fe8] border-b border-gray-200">
            <button id="toggleFiltersMobile" class="w-full flex items-center justify-between p-2 bg-[#580a21] hover:bg-[#420718] text-white rounded-lg transition duration-300">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filtres
                </span>
                <svg id="filterArrow" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <!-- Sidebar - Filters -->
        <div id="sidebarFilters" class="w-full md:w-64 lg:w-72 bg-[#685f5fe8] shadow-md p-4 md:p-6 border-r border-gray-200 hidden md:block">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-white mb-2">Filtres</h2>
                <div class="h-0.5 w-16 bg-[#580a21] my-3 opacity-75"></div>
            </div>
            <div class="flex-1">
            <input 
                type="text" 
                name="search" 
                placeholder="Rechercher par nom..." 
                class="pl-3 bg-white/20 text-white w-full h-[2.7rem] rounded-md capitalize outline-none placeholder-white"
                value="{{ request('search') }}"
            />
        </div>

            <form action="" method="GET" class="space-y-5 pt-7">
                <!-- City Filter -->
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-white mb-2">Ville</h3>
                    <select name="city" class="pl-3 bg-white/20 text-white w-full h-[2.7rem] rounded-md capitalize outline-none placeholder-white">
                        <option value="">Toutes les villes</option>
                        <!-- Add dynamic city options if needed -->
                    </select>
                </div>

                <!-- Formation Filter -->
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-white mb-2">Formation</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="formation" value="121" 
                                {{ request('formation') == '121' ? 'checked' : '' }}
                                class="rounded text-[#580a21] focus:ring-[#580a21] bg-white">
                            <span class="ml-2 text-sm text-white">1-2-1</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="formation" value="331" 
                                {{ request('formation') == '331' ? 'checked' : '' }}
                                class="rounded text-[#580a21] focus:ring-[#580a21] bg-white">
                            <span class="ml-2 text-sm text-white">3-3-1</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="formation" value="433" 
                                {{ request('formation') == '433' ? 'checked' : '' }}
                                class="rounded text-[#580a21] focus:ring-[#580a21] bg-white">
                            <span class="ml-2 text-sm text-white">4-3-3</span>
                        </label>
                    </div>
                </div>

                <div class="flex flex-col space-y-3">
                    <button type="submit" class="w-full bg-[#580a21] hover:bg-[#420718] text-white py-2 px-4 rounded-lg transition duration-300 font-medium text-sm flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Appliquer les filtres
                    </button>

                    <a href="" class="w-full border border-gray-300 text-white py-2 px-4 rounded-lg transition duration-300 font-medium text-sm flex items-center justify-center hover:bg-[#580a21]/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                <div class="mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">Liste des Squads</h1>
                    <div class="h-0.5 w-20 bg-[#580a21] my-3 opacity-75"></div>
                </div>

                <!-- Squads Grid - Responsive -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    @forelse ($squads as $squad)
                        <div class="bg-[#685f5fe8] rounded-xl shadow-md overflow-hidden 
                            border-t-4 
                            @if($squad->players->count() < 5)
                                border-red-500
                            @elseif($squad->players->count() >= 5 && $squad->players->count() < 10)
                                border-yellow-500
                            @else
                                border-green-500
                            @endif
                            hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105">

                            <div class="p-4 sm:p-5">
                                <h3 class="text-base sm:text-lg font-bold text-white mb-2">{{ $squad->name_squad }}</h3>
                                <div class="flex items-center text-xs sm:text-sm mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-300 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-[#d8d9dd]">{{ $squad->city }}</span>
                                </div>
                                <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                                    <span class="bg-[#580a21]/20 text-[#d8d9dd] text-xs px-2 py-1 rounded-full">{{ $squad->formation }}</span>
                                    <span class="bg-gray-600/30 text-[#d8d9dd] text-xs px-2 py-1 rounded-full">
                                        Joueurs: {{ $squad->players->count() }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center pt-3 border-t border-gray-600/30">
                                   
                                    <a href="{{ route('joueur.squad.show',$squad->id) }}" class="bg-[#580a21] hover:bg-[#420718] text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300 text-xs sm:text-sm">
                                        Voir détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 sm:col-span-2 lg:col-span-3 p-8 bg-[#685f5fe8] rounded-xl shadow text-center">
                            <p class="text-[#d8d9dd] text-lg">Aucun squad ne correspond à vos critères.</p>
                            <a href="{{ route('joueur.squadBuilder.create') }}" class="inline-block mt-4 text-[#580a21] hover:underline">Créer un nouveau squad</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleFiltersMobile');
        const filterArrow = document.getElementById('filterArrow');
        const sidebarFilters = document.getElementById('sidebarFilters');

        if (toggleButton && filterArrow && sidebarFilters) {
            toggleButton.addEventListener('click', function() {
                sidebarFilters.classList.toggle('hidden');
                filterArrow.classList.toggle('rotate-180');
            });
        }
    });
</script>
@endsection