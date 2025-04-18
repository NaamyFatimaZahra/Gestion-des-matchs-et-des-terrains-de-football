@extends('Layout.guest')
@section('title', 'Liste des Terrains')
@section('content')
<section class="w-full">
    <div class="flex flex-col md:flex-row min-h-[100vh] bg-rose-50 pt-16">
        <!-- Sidebar - Mobile Toggle -->
        <div class="md:hidden p-4 bg-white border-b border-gray-200">
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
        <div id="sidebarFilters" class="w-full md:w-64 lg:w-72 bg-white shadow-md p-4 md:p-6 border-r border-gray-200 hidden md:block">
            <div class="mb-6">
              
                <h2 class="text-xl font-bold text-gray-800 mb-2">Filtres</h2>
                <div class="h-0.5 w-16 bg-[#580a21] my-3 opacity-75"></div>
            </div>

            <form action="" method="GET" class="space-y-5">
                <!-- Statut -->
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Statut</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="status[]" value="disponible" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Disponible</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="status[]" value="occupé" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Occupé</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="status[]" value="maintenance" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Maintenance</span>
                        </label>
                    </div>
                </div>

                <!-- Prix -->
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Prix</h3>
                    <div class="space-y-2">
                        <label class="block text-xs text-gray-500">Min: <span id="minPriceValue">0</span> Dh</label>
                        <input type="range" name="min_price" min="0" max="1000" value="0" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#580a21]" id="minPrice">
                        
                        <label class="block text-xs text-gray-500">Max: <span id="maxPriceValue">1000</span> Dh</label>
                        <input type="range" name="max_price" min="0" max="1000" value="1000" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#580a21]" id="maxPrice">
                    </div>
                </div>

                <!-- Surface -->
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Surface</h3>
                    <div class="space-y-2 max-h-40 overflow-y-auto scrollbar-thin scrollbar-thumb-[#580a21] scrollbar-track-gray-100">
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="gazon_naturel" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Gazon naturel</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="gazon_synthetique" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Gazon synthétique</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="gazon_hybride" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Gazon hybride</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="turf_artificiel" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Turf artificiel</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="stabilise" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Stabilisé</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="sable" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Sable</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="beton" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Béton</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="terre_battue" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Terre battue</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="indoor_synthetique" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Indoor synthétique</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="surface[]" value="altra_resist" class="rounded text-[#580a21] focus:ring-[#580a21]">
                            <span class="ml-2 text-sm text-gray-600">Altra resist</span>
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

                    <button type="reset" class="w-full border border-gray-300 text-gray-600 py-2 px-4 rounded-lg transition duration-300 font-medium text-sm flex items-center justify-center hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Réinitialiser
                    </button>
                </div>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                <div class="mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Liste des Terrains</h1>
                    <div class="h-0.5 w-20 bg-[#580a21] my-3 opacity-75"></div>
                </div>

                <!-- Tabs pour les statuts - scrollable sur mobile -->
                <div class="mb-6 border-b border-gray-200 overflow-x-auto pb-1">
                    <ul class="flex whitespace-nowrap -mb-px text-sm font-medium text-center min-w-max">
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 border-b-2 border-[#580a21] rounded-t-lg text-[#580a21]">Tous</a>
                        </li>
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Disponible</a>
                        </li>
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Occupé</a>
                        </li>
                        <li class="mr-2">
                            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Maintenance</a>
                        </li>
                    </ul>
                </div>

                <!-- Terrains Grid - Responsive -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    <!-- Terrain Card - Disponible -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-green-500 hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="{{ asset('assets/img/terrain1.jpg') }}" class="w-full h-40 sm:h-48 object-cover" alt="Terrain de football">
                            <div class="absolute top-0 right-0 bg-green-500 text-white px-3 py-1 m-2 rounded-full text-xs font-bold">
                                Disponible
                            </div>
                        </div>
                        <div class="p-4 sm:p-5">
                            <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Terrain Casablanca Centre</h3>
                            <div class="flex items-center text-xs sm:text-sm mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600">Casablanca, Maârif</span>
                            </div>
                            <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                                <span class="bg-rose-50 text-[#580a21] text-xs px-2 py-1 rounded-full">Gazon synthétique</span>
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">5 vs 5</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                <span class="text-[#580a21] font-bold text-sm sm:text-base">200 Dh/h</span>
                                <a href="#" class="bg-[#580a21] hover:bg-[#420718] text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300 text-xs sm:text-sm">
                                    Réserver
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Terrain Card - Occupé -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-yellow-500 hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="{{ asset('assets/img/terrain2.jpg') }}" class="w-full h-40 sm:h-48 object-cover" alt="Terrain de football">
                            <div class="absolute top-0 right-0 bg-yellow-500 text-white px-3 py-1 m-2 rounded-full text-xs font-bold">
                                Occupé
                            </div>
                        </div>
                        <div class="p-4 sm:p-5">
                            <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Terrain Maarif Stadium</h3>
                            <div class="flex items-center text-xs sm:text-sm mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600">Casablanca, Belvédère</span>
                            </div>
                            <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                                <span class="bg-rose-50 text-[#580a21] text-xs px-2 py-1 rounded-full">Gazon naturel</span>
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">11 vs 11</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                <span class="text-[#580a21] font-bold text-sm sm:text-base">350 Dh/h</span>
                                <a href="#" class="bg-gray-300 cursor-not-allowed text-gray-600 py-1 px-2 sm:px-3 rounded-lg text-xs sm:text-sm">
                                    Indisponible
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Terrain Card - Maintenance -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-red-500 hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="{{ asset('assets/img/terrain3.jpg') }}" class="w-full h-40 sm:h-48 object-cover opacity-75" alt="Terrain de football">
                            <div class="absolute top-0 right-0 bg-red-500 text-white px-3 py-1 m-2 rounded-full text-xs font-bold">
                                Maintenance
                            </div>
                        </div>
                        <div class="p-4 sm:p-5">
                            <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Terrain Indoor Anfa</h3>
                            <div class="flex items-center text-xs sm:text-sm mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600">Casablanca, Anfa</span>
                            </div>
                            <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                                <span class="bg-rose-50 text-[#580a21] text-xs px-2 py-1 rounded-full">Indoor synthétique</span>
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">7 vs 7</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                <span class="text-[#580a21] font-bold text-sm sm:text-base">280 Dh/h</span>
                                <span class="bg-red-100 text-red-700 py-1 px-2 sm:px-3 rounded-lg text-xs sm:text-sm">
                                    En maintenance
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Autres exemples de terrains... -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-green-500 hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="{{ asset('assets/img/terrain4.jpg') }}" class="w-full h-40 sm:h-48 object-cover" alt="Terrain de football">
                            <div class="absolute top-0 right-0 bg-green-500 text-white px-3 py-1 m-2 rounded-full text-xs font-bold">
                                Disponible
                            </div>
                        </div>
                        <div class="p-4 sm:p-5">
                            <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Terrain Beach Soccer</h3>
                            <div class="flex items-center text-xs sm:text-sm mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600">Casablanca, Aïn Diab</span>
                            </div>
                            <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                                <span class="bg-rose-50 text-[#580a21] text-xs px-2 py-1 rounded-full">Sable</span>
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">5 vs 5</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                <span class="text-[#580a21] font-bold text-sm sm:text-base">150 Dh/h</span>
                                <a href="#" class="bg-[#580a21] hover:bg-[#420718] text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300 text-xs sm:text-sm">
                                    Réserver
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-green-500 hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="{{ asset('assets/img/terrain5.jpg') }}" class="w-full h-40 sm:h-48 object-cover" alt="Terrain de football">
                            <div class="absolute top-0 right-0 bg-green-500 text-white px-3 py-1 m-2 rounded-full text-xs font-bold">
                                Disponible
                            </div>
                        </div>
                        <div class="p-4 sm:p-5">
                            <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Terrain Foot Academy</h3>
                            <div class="flex items-center text-xs sm:text-sm mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600">Casablanca, Les Princesses</span>
                            </div>
                            <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                                <span class="bg-rose-50 text-[#580a21] text-xs px-2 py-1 rounded-full">Turf artificiel</span>
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">7 vs 7</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                <span class="text-[#580a21] font-bold text-sm sm:text-base">220 Dh/h</span>
                                <a href="#" class="bg-[#580a21] hover:bg-[#420718] text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300 text-xs sm:text-sm">
                                    Réserver
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-yellow-500 hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="{{ asset('assets/img/terrain6.jpg') }}" class="w-full h-40 sm:h-48 object-cover" alt="Terrain de football">
                            <div class="absolute top-0 right-0 bg-yellow-500 text-white px-3 py-1 m-2 rounded-full text-xs font-bold">
                                Occupé
                            </div>
                        </div>
                        <div class="p-4 sm:p-5">
                            <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Terrain Sport City</h3>
                            <div class="flex items-center text-xs sm:text-sm mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600">Casablanca, Californie</span>
                            </div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="bg-rose-50 text-[#580a21] text-xs px-2 py-1 rounded-full">Gazon hybride</span>
                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">11 vs 11</span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                            <span class="text-[#580a21] font-bold">400 Dh/h</span>
                            <a href="#" class="bg-gray-300 cursor-not-allowed text-gray-600 py-1 px-3 rounded-lg text-sm">
                                Indisponible
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <nav class="inline-flex rounded-md shadow">
                    <a href="#" class="py-2 px-4 bg-white border border-gray-300 rounded-l-md text-sm font-medium text-gray-500 hover:bg-gray-50">
                        Précédent
                    </a>
                    <a href="#" class="py-2 px-4 bg-white border-t border-b border-gray-300 text-sm font-medium text-[#580a21]">
                        1
                    </a>
                    <a href="#" class="py-2 px-4 bg-white border-t border-b border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        2
                    </a>
                    <a href="#" class="py-2 px-4 bg-white border-t border-b border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        3
                    </a>
                    <a href="#" class="py-2 px-4 bg-white border border-gray-300 rounded-r-md text-sm font-medium text-gray-500 hover:bg-gray-50">
                        Suivant
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    // Script pour mettre à jour les valeurs des filtres de prix
    document.addEventListener('DOMContentLoaded', function() {
        const minPrice = document.getElementById('minPrice');
        const maxPrice = document.getElementById('maxPrice');
        const minPriceValue = document.getElementById('minPriceValue');
        const maxPriceValue = document.getElementById('maxPriceValue');

        minPrice.addEventListener('input', function() {
            minPriceValue.textContent = this.value;
            // S'assurer que min ne dépasse pas max
            if (parseInt(this.value) > parseInt(maxPrice.value)) {
                maxPrice.value = this.value;
                maxPriceValue.textContent = this.value;
            }
        });

        maxPrice.addEventListener('input', function() {
            maxPriceValue.textContent = this.value;
            // S'assurer que max n'est pas inférieur à min
            if (parseInt(this.value) < parseInt(minPrice.value)) {
                minPrice.value = this.value;
                minPriceValue.textContent = this.value;
            }
        });
    });
</script>
   </section>
@endsection