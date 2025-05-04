@extends('Layout.guest')
@section('title', 'Liste des Terrains')
@section('content')
<section class="w-[100%] min-h-[130vh] relative ">
    <!-- Image de fond -->
    <div class="relative md:w-[100%] w-[100%] h-full">
        <img 
            src="../assets/img/stud-red.svg" 
            class="fixed w-[100%] h-[100vh] object-cover z-[-3] md:brightness-[50%]" 
            alt="" 
        />
    </div>

    <div class="min-h-[100vh] text-[white] relative z-10 pt-16 pb-[5rem]">
        <header class="bg-[#580a21] py-20 text-center">
            <div class="text-xs uppercase tracking-wide mb-2">
                <a href="#" class="hover:text-red-500">Home</a> / 
                <span class="text-gray-400">Terrains</span>
            </div>
            <h1 class="text-4xl font-bold uppercase">Liste des Terrains</h1>
        </header>

      <!-- Composant Filtre Stylé avec Barre de Recherche -->
<div class="w-full max-w-4xl mx-auto mt-[-2rem] mb-8 px-4">
    <!-- Bloc Filtre Principal -->
    <div class="bg-[#3b2c2c] rounded-2xl shadow-lg overflow-hidden text-white">
        <form action="" method="GET">
            <div class="flex flex-col md:flex-row items-stretch divide-y md:divide-y-0 md:divide-x divide-[#4a3a3a]">
                <!-- Surface -->
                <div class="flex-1 p-4">
                    <div class="flex items-center">
                        <div class="text-[#aab0b5] mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <label for="surface" class="block text-sm text-gray-300 font-medium">Surface</label>
                            <select onchange="surfaceFilter()" name="surface" id="surface" class="w-full bg-[#3b2c2c] text-white border-none text-base focus:outline-none">
                                <option value="">Toutes les surfaces</option>
                                <option value="gazon_naturel">Gazon naturel</option>
                                <option value="gazon_synthetique">Gazon synthétique</option>
                                <option value="gazon_hybride">Gazon hybride</option>
                                <option value="turf_artificiel">Turf artificiel</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Prix Range -->
                <div class="flex-1 p-4">
                    <div class="flex items-center">
                        <div class="text-[#aab0b5] mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="w-full">
                            <label for="max_price" class="block text-sm text-gray-300 font-medium">Prix Max</label>
                            <select onchange="priceFilter()" name="max_price" id="max_price" class="w-full bg-[#3b2c2c] text-white border-none text-base focus:outline-none">
                                <option value="">Tous les prix</option>
                                <option value="200">Jusqu'à 200 Dh</option>
                                <option value="400">Jusqu'à 400 Dh</option>
                                <option value="600">Jusqu'à 600 Dh</option>
                                <option value="800">Jusqu'à 800 Dh</option>
                                <option value="1000">Jusqu'à 1000 Dh</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Barre de Recherche -->
                <div class="flex-1 p-4">
                    <div class="flex items-center">
                        <div class="text-[#aab0b5] mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div class="w-full">
                            <label for="search" class="block text-sm text-gray-300 font-medium">Recherche</label>
                            <input 
                                type="text" 
                                name="search" 
                                id="search" 
                                placeholder="Nom du terrain..." 
                                class="w-full bg-transparent border-none text-white text-base focus:outline-none placeholder-gray-500"
                            >
                        </div>
                    </div>
                </div>

                <!-- Bouton Submit -->
                <div class="p-4 flex items-center justify-center gap-4">
                    <a onclick="searchFilter()" class="bg-[#580a21] cursor-pointer hover:bg-[#420718] text-white font-bold py-2 px-4 rounded-lg transition duration-300">
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

                <!-- Terrains Grid - Responsive -->
                <div id="terrains_container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    @forelse ($terrains as $terrain)
                        <div class="bg-[#685f5fe8] rounded-xl shadow-md overflow-hidden 
                            border-t-4 
                            @if($terrain->status == 'disponible')
                                border-green-500
                            @elseif($terrain->status == 'occupé')
                                border-yellow-500
                            @elseif($terrain->status == 'maintenance')
                                border-red-500
                            @else
                                border-gray-500
                            @endif
                            hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105">

                            <div class="relative">
                                <img src="{{ asset('storage/'.$terrain->Documents->first()->photo_path) }}" class="w-full h-40 sm:h-48 object-cover{{ $terrain->status == 'maintenance' ? ' opacity-75' : '' }}" alt="{{ $terrain->name }}">
                          
                                <div class="absolute top-0 right-0 
                                    @if($terrain->status == 'disponible')
                                        bg-green-500
                                    @elseif($terrain->status == 'occupé')
                                        bg-yellow-500
                                    @elseif($terrain->status == 'maintenance')
                                        bg-red-500
                                    @else
                                        bg-gray-500
                                    @endif
                                    text-white px-3 py-1 m-2 rounded-full text-xs font-bold">
                                    {{ ucfirst($terrain->status) }}
                                </div>
                            </div>
                            <div class="p-4 sm:p-5">
                                <h3 class="text-base sm:text-lg font-bold text-white mb-2">{{ $terrain->name }}</h3>
                                <div class="flex items-center text-xs sm:text-sm mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-300 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-[#d8d9dd]">{{ $terrain->city }}, {{ $terrain->adress }}</span>
                                </div>
                                <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                                    <span class="bg-[#580a21]/20 text-[#d8d9dd] text-xs px-2 py-1 rounded-full">{{ $terrain->surface }}</span>
                                    <span class="bg-gray-600/30 text-[#d8d9dd] text-xs px-2 py-1 rounded-full">{{ $terrain->capacity }} vs {{ $terrain->capacity }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-3 border-t border-gray-600/30">
                                    <span class="text-white font-bold text-sm sm:text-base">{{ $terrain->price }} Dh/h</span>
                                    
                                    <a href="{{ route('details_terrain',$terrain->id) }}" class="bg-[#580a21] hover:bg-[#420718] text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300 text-xs sm:text-sm">
                                        Voir détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 sm:col-span-2 lg:col-span-3 p-8 bg-[#685f5fe8] rounded-xl shadow text-center">
                            <p class="text-[#d8d9dd] text-lg">Aucun terrain ne correspond à vos critères.</p>
                            <a href="" class="inline-block mt-4 text-[#580a21] hover:underline">Voir tous les terrains</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const selectOptionSurface = document.getElementById('surface');
    const selectOptionMaxPrice = document.getElementById('max_price');
    const selectOptionSearch = document.getElementById('search');
    const container = document.getElementById('terrains_container');

    function surfaceFilter() {
        selectOptionMaxPrice.value = '';
        selectOptionSearch.value = '';
        let surfaceValue = selectOptionSurface.value;
        let typeFilter = 'surface';
      
      
        fetchData(typeFilter, surfaceValue);
    }

    function priceFilter() {
        selectOptionSurface.value = '';
        selectOptionSearch.value = '';
        let priceValue = selectOptionMaxPrice.value;
        let typeFilter = 'max_price';
        fetchData(typeFilter, priceValue);
    }

    function searchFilter() {
        selectOptionSurface.value = '';
        selectOptionMaxPrice.value = '';
        let searchValue = selectOptionSearch.value;
        let typeFilter = 'search';
        fetchData(typeFilter, searchValue);
    }

    function clearFilter() {
        selectOptionSurface.value = '';
        selectOptionMaxPrice.value = '';
        selectOptionSearch.value = '';
        fetchData('clear', 'clear');
    }

    function fetchData(typeFilter, filterValue) {
        fetch(`/terrains/filter/${typeFilter}/${filterValue}`, {
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
              
            
            updateTerrainsContainer(data);
        })
        .catch(error => {
            console.error("Erreur:", error);
        });
    }

   function updateTerrainsContainer(terrains) {
    
     
    if (terrains.length === 0) {
        container.innerHTML = `
            <div class="col-span-1 sm:col-span-2 lg:col-span-3 p-8 bg-[#685f5fe8] rounded-xl shadow text-center">
                <p class="text-[#d8d9dd] text-lg">Aucun terrain ne correspond à vos critères.</p>
                <a href="/terrains" class="inline-block mt-4 text-[#580a21] hover:underline">Voir tous les terrains</a>
            </div>
        `;
        return;
    }
    
    let html = '';
    
    terrains.forEach(terrain => {
        // Déterminer la couleur de la bordure
        let borderColor = 'border-gray-500';
        if (terrain.status === 'disponible') {
            borderColor = 'border-green-500';
        } else if (terrain.status === 'occupé') {
            borderColor = 'border-yellow-500';
        } else if (terrain.status === 'maintenance') {
            borderColor = 'border-red-500';
        }
        
        // Générer le HTML pour chaque terrain
        html += `
            <div class="bg-[#685f5fe8] rounded-xl shadow-md overflow-hidden 
                border-t-4 ${borderColor}
                hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105">
                <div class="relative">
                    <img src="/storage/${terrain.documents[0].photo_path}" class="w-full h-40 sm:h-48 object-cover${terrain.status === 'maintenance' ? ' opacity-75' : ''}" alt="${terrain.name}">
                    <div class="absolute top-0 right-0 
                        ${terrain.status === 'disponible' ? 'bg-green-500' : 
                         terrain.status === 'occupé' ? 'bg-yellow-500' : 
                         terrain.status === 'maintenance' ? 'bg-red-500' : 'bg-gray-500'}
                        text-white px-3 py-1 m-2 rounded-full text-xs font-bold">
                        ${terrain.status.charAt(0).toUpperCase() + terrain.status.slice(1)}
                    </div>
                </div>
                <div class="p-4 sm:p-5">
                    <h3 class="text-base sm:text-lg font-bold text-white mb-2">${terrain.name}</h3>
                    <div class="flex items-center text-xs sm:text-sm mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 text-gray-300 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-[#d8d9dd]">${terrain.city}, ${terrain.adress}</span>
                    </div>
                    <div class="flex flex-wrap gap-1 sm:gap-2 mb-3">
                        <span class="bg-[#580a21]/20 text-[#d8d9dd] text-xs px-2 py-1 rounded-full">${terrain.surface}</span>
                        <span class="bg-gray-600/30 text-[#d8d9dd] text-xs px-2 py-1 rounded-full">${terrain.capacity} vs ${terrain.capacity}</span>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-600/30">
                        <span class="text-white font-bold text-sm sm:text-base">${terrain.price} Dh/h</span>
                        <a href="/terrains/${terrain.id}" class="bg-[#580a21] hover:bg-[#420718] text-white py-1 px-2 sm:px-3 rounded-lg transition duration-300 text-xs sm:text-sm">
                            Voir détails
                        </a>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;

}
</script>
@endsection