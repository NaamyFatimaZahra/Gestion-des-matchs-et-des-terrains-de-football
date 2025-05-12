@extends('Layout.guest')
@section('title', 'Liste des Squads')
@section('content')
<section class="w-[100%] min-h-[100vh] relative">
    <!-- Image de fond -->
    <div class="relative md:w-[100%] w-[100%] h-full">
        <img
            src="../assets/img/stud-red.svg"
            class="fixed w-[100%] h-[100vh] object-cover z-[-3] md:brightness-[50%]"
            alt="" />
    </div>

    <div class="min-h-[100vh] text-[white] relative z-10 pt-12 md:pt-16">
        <header class="bg-[#580a21] py-20 text-center">
            <div class="text-xs uppercase tracking-wide mb-2">
                <a href="#" class="hover:text-red-500">Home</a> /
                <span class="text-gray-400">Squads</span>
            </div>
            <h1 class="text-4xl font-bold uppercase">Match Schedule</h1>
        </header>

        <!-- Composant Filtre Stylé (sans jaune) -->
        <div class="w-full max-w-4xl mx-auto mt-[-2rem] mb-8 px-4">

            <!-- Bloc Filtre Principal -->
            <div class="bg-[#3b2c2c] rounded-2xl shadow-lg overflow-hidden text-white">
                <form action="" method="GET">
                    <div class="flex flex-col md:flex-row items-stretch divide-y md:divide-y-0 md:divide-x divide-[#4a3a3a]">

                        <!-- Ville -->
                        <div class="flex-1 p-4">
                            <div class="flex items-center">
                                <div class="text-[#aab0b5] mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <label for="city" class="block text-sm text-gray-300 font-medium">Ville</label>
                                    <select onchange="cityFilter()" name="city" id="city" class="w-full bg-[#3b2c2c] text-white border-none  text-base focus:outline-none">
                                        <option value="">Toutes les villes</option>
                                        <!-- Options dynamiques -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Formation -->
                        <div class="flex-1 p-4">
                            <div class="flex items-center">
                                <div class="text-[#aab0b5] mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <label for="formation" class="block text-sm text-gray-300 font-medium">Formation</label>
                                    <select onchange="formationFilter()" name="formation" id="formation" class="w-full bg-[#3b2c2c] text-white border-none  text-base focus:outline-none">
                                        <option value="">Toutes les formations</option>
                                        <option value="121" {{ request('formation') == '121' ? 'selected' : '' }}>1-2-1</option>
                                        <option value="331" {{ request('formation') == '331' ? 'selected' : '' }}>3-3-1</option>
                                        <option value="433" {{ request('formation') == '433' ? 'selected' : '' }}>4-3-3</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Recherche -->
                        <div class="flex-1 p-4">
                            <div class="flex items-center">
                                <div class="text-[#aab0b5] mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <label for="search" class="block text-sm text-gray-300 font-medium">Recherche</label>
                                    <input

                                        type="text"
                                        name="search"
                                        id="search"
                                        placeholder="Nom du squad..."
                                        class="w-full capitalize bg-transparent border-none text-white text-base focus:outline-none placeholder-gray-400"
                                        value="" />
                                </div>
                            </div>
                        </div>

                        <!-- Bouton Submit -->
                        <div class="p-4 flex items-center justify-center gap-4 ">
                            <a onclick="searchFilter()" class="bg-[#580a21]  cursor-pointer hover:bg-[#420718] text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                Rechercher
                            </a>
                            <a onclick="clearFilter()" class="bg-[#580a21] cursor-pointer hover:bg-[#420718] text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                Clear
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>



        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-6 lg:p-8 min-h-[60vh]">
            <div class="max-w-7xl mx-auto">


                <!-- Success Message -->
                @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-md relative" role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" class="absolute top-[50%] translate-y-[-50%] right-0 mr-2 text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-md relative" role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button type="button" class="absolute top-[50%] translate-y-[-50%] right-0 mr-2 text-red-700 hover:text-red-900" onclick="this.parentElement.style.display='none'">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @endif

                <!-- Squads Grid - Responsive -->
                <div id="container_squads" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
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
                            <div class="flex">
                                @forelse($squad->players as $player)
                                <img
                                    src="{{isset($player->profile_picture)? asset('storage/'. $player->profile_picture): asset('storage/profile-pictures/blank-profile.webp') }}"
                                    alt="Player image"
                                    class="w-8 h-8 ml-[-7px] object-contain rounded-full border-solid border-[3px] border-[#580a21] " />
                                @empty

                                @endforelse
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-600/30">

                                <a href="{{ route('joueur.squad.show',$squad->id) }}" class="bg-[#580a21] hover:bg-[#420718] text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300 text-xs sm:text-sm">
                                    Voir détails
                                </a>
                                @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
                                <form action="{{ route('squads.destroy', $squad->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce squad?')"
                                        class="bg-[#580a21] hover:bg-bg-[#580a21] text-white py-1 px-2 rounded-lg transition duration-300">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endif
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
    <!-- Remplacez la section de pagination avec la version corrigée suivante -->

    <!-- Pagination dynamique avec Laravel -->
    @if ($squads->hasPages())
    <div class="pagination-container my-8 px-4">
        <nav aria-label="Pagination" class="flex justify-center">
            <ul class="inline-flex items-center -space-x-px rounded-lg bg-[#3b2c2c]/80 shadow-lg overflow-hidden">

                <!-- Bouton Previous -->
                @if ($squads->onFirstPage())
                <li>
                    <span class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-[#3b2c2c]/50 border-r border-[#4a3a3a] rounded-l-lg cursor-not-allowed">
                        <span class="sr-only">Previous</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </li>
                @else
                <li>
                    <a href="{{ $squads->previousPageUrl() }}"
                        class="block px-3 py-2 ml-0 leading-tight text-gray-300 bg-[#3b2c2c] border-r border-[#4a3a3a] rounded-l-lg hover:bg-[#580a21]/70 hover:text-white transition-colors duration-300">
                        <span class="sr-only">Previous</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </li>
                @endif

                <!-- Pages - Méthode simple pour éviter l'erreur $elements -->
                @for ($i = 1; $i <= $squads->lastPage(); $i++)
                    @if ($i == $squads->currentPage())
                    <li>
                        <span aria-current="page"
                            class="z-10 px-3 py-2 leading-tight text-white border border-[#580a21] bg-[#580a21]">
                            {{ $i }}
                        </span>
                    </li>
                    @else
                    <li>
                        <a href="{{ $squads->url($i) }}"
                            class="px-3 py-2 leading-tight text-gray-300 bg-[#3b2c2c] border-x border-[#4a3a3a] hover:bg-[#580a21]/20 hover:text-white transition-colors duration-300">
                            {{ $i }}
                        </a>
                    </li>
                    @endif
                    @endfor

                    <!-- Bouton Next -->
                    @if ($squads->hasMorePages())
                    <li>
                        <a href="{{ $squads->nextPageUrl() }}"
                            class="block px-3 py-2 leading-tight text-gray-300 bg-[#3b2c2c] border-l border-[#4a3a3a] rounded-r-lg hover:bg-[#580a21]/70 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Next</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </li>
                    @else
                    <li>
                        <span class="block px-3 py-2 leading-tight text-gray-500 bg-[#3b2c2c]/50 border-l border-[#4a3a3a] rounded-r-lg cursor-not-allowed">
                            <span class="sr-only">Next</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </li>
                    @endif
            </ul>
        </nav>
    </div>

    <!-- Version mobile simplifiée dynamique (visible uniquement sur très petits écrans) -->
    <div class="pagination-mobile sm:hidden my-6 px-4">
        <div class="flex justify-between items-center">
            @if ($squads->onFirstPage())
            <span class="inline-flex items-center px-4 py-2 text-sm bg-[#3b2c2c]/50 text-gray-500 rounded-lg cursor-not-allowed">
                <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                </svg>
                Précédent
            </span>
            @else
            <a href="{{ $squads->previousPageUrl() }}" class="inline-flex items-center px-4 py-2 text-sm bg-[#3b2c2c] text-gray-300 rounded-lg hover:bg-[#580a21]/70 hover:text-white transition-colors duration-300">
                <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                </svg>
                Précédent
            </a>
            @endif

            <span class="text-sm text-gray-300">Page {{ $squads->currentPage() }} sur {{ $squads->lastPage() }}</span>

            @if ($squads->hasMorePages())
            <a href="{{ $squads->nextPageUrl() }}" class="inline-flex items-center px-4 py-2 text-sm bg-[#3b2c2c] text-gray-300 rounded-lg hover:bg-[#580a21]/70 hover:text-white transition-colors duration-300">
                Suivant
                <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
            @else
            <span class="inline-flex items-center px-4 py-2 text-sm bg-[#3b2c2c]/50 text-gray-500 rounded-lg cursor-not-allowed">
                Suivant
                <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </span>
            @endif
        </div>
    </div>
    @endif
</section>
<script src="{{ asset('js/morrocaineCities.js') }}"></script>
<script>
    const selectOptionFormation = document.getElementById('formation');
    const selectOptionCity = document.getElementById('city');
    const selectOptionSearch = document.getElementById('search');
    const container = document.getElementById('container_squads');

    function formationFilter() {
        selectOptionCity.value = '';
        selectOptionSearch.value = '';
        let formationValue = selectOptionFormation.value;
        let typeFilter = 'formation';
        fetchData(typeFilter, formationValue);

    }


    function searchFilter() {
        selectOptionCity.value = '';
        selectOptionFormation.value = '';
        let searchValue = selectOptionSearch.value;
        let typeFilter = 'search';
        fetchData(typeFilter, searchValue);

    }

    function clearFilter() {
        selectOptionCity.value = '';
        selectOptionFormation.value = '';
        selectOptionSearch.value = '';
        fetchData('clear', 'clear');
    }

    function cityFilter() {
        selectOptionFormation.value = '';
        selectOptionSearch.value = '';
        let cityValue = selectOptionCity.value;
        let typeFilter = 'city';
        fetchData(typeFilter, cityValue);

    }

    function fetchData(typeFilter, formationValue) {
        fetch(`/joueur/squad/filter/${typeFilter}/${formationValue}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => {
                if (!response.ok) throw new Error('Erreur réseau');
                return response.json();
            })
            .then(data => {
                updateSquadsContainer(data);

            })
            .catch(error => {
                console.error("Erreur:", error);
            });

    }

    function updateSquadsContainer(squads) {

        if (squads.length === 0) {
            container.innerHTML = `
            <div class="col-span-1 sm:col-span-2 lg:col-span-3 p-8 bg-[#685f5fe8] rounded-xl shadow text-center">
                <p class="text-[#d8d9dd] text-lg">Aucun squad ne correspond à vos critères.</p>
                <a href="/joueur/squadBuilder/create" class="inline-block mt-4 text-[#580a21] hover:underline">Créer un nouveau squad</a>
            </div>
        `;
            return;
        }

        let html = '';

        squads.forEach(squad => {
            // Déterminer la couleur de la bordure
            let borderColor = 'border-red-500';
            if (squad.players_count >= 5 && squad.players_count < 10) {
                borderColor = 'border-yellow-500';
            } else if (squad.players_count >= 10) {
                borderColor = 'border-green-500';
            }

            // Générer le HTML pour les joueurs (avatars)
            let playersHtml = '';
            if (squad.players && squad.players.length > 0) {
                squad.players.forEach(player => {
                    const profilePic = player.profile_picture ?
                        `/storage/${player.profile_picture}` :
                        '/storage/profile-pictures/blank-profile.webp';

                    playersHtml += `
                    <img
                        src="${profilePic}"
                        alt="Player image"
                        class="w-8 h-8 ml-[-7px] object-contain rounded-full border-solid border-[3px] border-[#580a21]"
                    />
                `;
                });
            }

            // Bouton de suppression conditionnel
            let deleteButton = '';
            if (squad.is_admin) {
                deleteButton = `
                <form action="/squads/${squad.id}" method="POST" class="inline">
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce squad?')" 
                        class="bg-[#580a21] hover:bg-[#580a21] text-white py-1 px-2 rounded-lg transition duration-300">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            `;
            }

            // Générer le HTML pour chaque squad
            html += `
            <div class="bg-[#685f5fe8] rounded-xl shadow-md overflow-hidden 
                border-t-4 ${borderColor}
                hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105">
                <div class="p-4 sm:p-5">
                    <h3 class="text-base sm:text-lg font-bold text-white mb-2">${squad.name_squad}</h3>
                    <div class="flex items-center text-xs sm:text-sm mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-300 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-[#d8d9dd]">${squad.city}</span>
                    </div>
                    <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                        <span class="bg-[#580a21]/20 text-[#d8d9dd] text-xs px-2 py-1 rounded-full">${squad.formation}</span>
                        <span class="bg-gray-600/30 text-[#d8d9dd] text-xs px-2 py-1 rounded-full">
                            Joueurs: ${squad.players.length}
                        </span>
                    </div>
                    <div class="flex">
                        ${playersHtml}
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-600/30">
                        <a href="/joueur/squad/${squad.id}" class="bg-[#580a21] hover:bg-[#420718] text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300 text-xs sm:text-sm">
                            Voir détails
                        </a>
                        ${deleteButton}
                    </div>
                </div>
            </div>
        `;
        });

        container.innerHTML = html;
    }
</script>
@endsection