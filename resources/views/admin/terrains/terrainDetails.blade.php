@extends('Layout.dashboard')
@section('title', 'Détails du Terrain')
@section('content')

<div class=" mx-auto px-4 py-8 mt-[4rem] text-gray-800">
    <!-- En-tête avec titre et boutons d'action -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.terrains.index') }}" class="bg-[#580a21] hover:bg-[#420718] rounded-full w-8 h-8 flex items-center justify-center">
                <i class="fas fa-arrow-left text-white"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Détails du Terrain</h1>
        </div>
        <div class="flex gap-3">
           
            <a href="" class="bg-[#580a21] hover:bg-[#420718] text-white px-4 py-2 rounded-lg text-sm flex items-center">
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
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
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
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-control next absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg z-10">
                    <i class="fas fa-chevron-right"></i>
                </button>
                
                <!-- Indicateurs de position -->
                <div class="slider-dots absolute bottom-3 left-0 right-0 flex justify-center space-x-2 z-10">
                    @foreach ($terrain->Documents()->pluck('photo_path') as $index => $image)
                        <button class="slider-dot w-2 h-2 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-opacity" data-index="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>
            <!-- Status -->
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $terrain->name }}</h2>
                <div class="flex items-center text-gray-600 text-sm mb-3">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span>{{ $terrain->adress }}, {{ $terrain->city }}</span>
                </div>
                
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-2 py-1 text-xs font-semibold rounded
                        {{ $terrain->status === 'disponible' ? 'bg-emerald-500 text-white' : 
                         ($terrain->status === 'occupé' ? 'bg-rose-500 text-white' : 
                         ($terrain->status === 'maintenance' ? 'bg-amber-500 text-white' : 
                         'bg-blue-500 text-white')) }}">
                        {{ $terrain->status === 'disponible' ? 'Disponible' : 
                           ($terrain->status === 'occupé' ? 'Occupé' : 
                           ($terrain->status === 'maintenance' ? 'Maintenance' : 'En attente')) }}
                    </span>
                    
                    <span class="px-2 py-1 text-xs font-semibold rounded
                        {{ $terrain->admin_approval === 'approuve' ? 'bg-emerald-500 text-white' : 
                         ($terrain->admin_approval === 'rejete' ? 'bg-red-500 text-white' : 
                         ($terrain->admin_approval === 'suspended' ? 'bg-orange-500 text-white' : 
                         'bg-amber-500 text-white')) }}">
                        {{ $terrain->admin_approval === 'approuve' ? 'Approuvé' : 
                           ($terrain->admin_approval === 'rejete' ? 'Rejeté' : 
                           ($terrain->admin_approval === 'suspended' ? 'Suspendu' : 'En attente d\'approbation')) }}
                    </span>
                </div>
                
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Prix:</span>
                        <span class="font-semibold text-[#580a21]">{{ number_format($terrain->price, 2) }} MAD/heure</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Méthode de paiement:</span>
                        <span class="text-gray-800">{{ $terrain->payment_method === 'en_ligne' ? 'En ligne' : 
                             ($terrain->payment_method === 'sur_place' ? 'Sur place' : 'Les deux') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Capacité:</span>
                        <span class="text-gray-800">{{ $terrain->capacity ?? 'Non spécifié' }} joueurs</span>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Réservations:</span>
                        <span class="font-semibold text-gray-800">{{ $terrain->reservation_count }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Date d'ajout:</span>
                        <span class="text-gray-800">{{ $terrain->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Colonne 2: Détails & Propriétaire -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 lg:col-span-2">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Description</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $terrain->description ?? 'Aucune description disponible.' }}
                </p>
            </div>
            
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">Informations sur le propriétaire</h3>
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-rose-50 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-gray-500"></i>
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">{{ $terrain->proprietaire->name ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600">{{ $terrain->proprietaire->email ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600">Contact: {{ $terrain->contact ?? 'Non spécifié' }}</div>
                    </div>
                </div>
            </div>
            
           
              <!-- Localisation -->
                <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4 flex items-center text-gray-800">
                            <i class="fas fa-map-marker-alt mr-2 text-[#580a21]"></i>
                            Localisation
                        </h3>
                        
                        <div  id="map" class="relative h-64 bg-rose-50 rounded-lg overflow-hidden mb-4">
                            <img src="/api/placeholder/400/320" alt="Carte" class="w-full h-full object-cover">
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                                <div class="w-8 h-8 bg-[#580a21] rounded-full flex items-center justify-center mb-1 shadow-lg animate-bounce">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div class="bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">{{ $terrain->name }}</div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-rose-50 p-3 rounded-lg">
                                <div class="text-sm text-gray-600 mb-1">Adresse</div>
                                <div class="font-medium text-gray-800">{{ $terrain->adress }}</div>
                            </div>
                            <div class="bg-rose-50 p-3 rounded-lg">
                                <div class="text-sm text-gray-600 mb-1">Ville</div>
                                <div class="font-medium text-gray-800">{{ $terrain->city }}</div>
                            </div>
                            <div class="bg-rose-50 p-3 rounded-lg">
                                <div class="text-sm text-gray-600 mb-1">Latitude</div>
                                <div class="font-medium text-gray-800">{{ $terrain->latitude ?? 'Non spécifié' }}</div>
                            </div>
                            <div class="bg-rose-50 p-3 rounded-lg">
                                <div class="text-sm text-gray-600 mb-1">Longitude</div>
                                <div class="font-medium text-gray-800">{{ $terrain->longitude ?? 'Non spécifié' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
  <!-- Services du terrain -->
<div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200 mb-8">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-xl font-semibold flex items-center text-gray-800">
            <i class="fas fa-bolt mr-2 text-[#580a21]"></i>
            Services disponibles
        </h3>
        
    </div>
    
    <div class="p-6">
        @if($terrain->services && $terrain->services->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($terrain->services as $service)
            
                <div class="bg-rose-50 rounded-lg p-4 border border-gray-200 hover:border-[#580a21] transition-all duration-200">
                    <div class="flex items-center mb-3">
                     
                        <div>
                            <div class="font-medium text-gray-800">{{ $service->name}}</div>
                            <div class="text-sm text-[#580a21]">
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
                <i class="fas fa-bolt text-gray-400 text-6xl mb-4"></i>
                <p class="text-gray-600 mb-4">Aucun service n'est actuellement configuré pour ce terrain.</p>
               
            </div>
        @endif
    </div>
</div>
    
    <!-- Actions administratives -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <h3 class="font-semibold text-gray-800">Actions administratives</h3>
        </div>
        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
           
            
            <div>
                <h4 class="text-sm font-medium mb-2 text-gray-800">Modifier l'approbation administrative</h4>
                <form action="{{ route('admin.terrains.update-approval', $terrain->id) }}" method="POST" class="flex items-center space-x-2">
                    @csrf
                    @method('PATCH')
                    <select name="admin_approval" class="bg-rose-50 border border-gray-300 rounded-lg px-4 py-2 text-gray-800 flex-grow">
                        <option value="en_attente" {{ $terrain->admin_approval === 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="approuve" {{ $terrain->admin_approval === 'approuve' ? 'selected' : '' }}>Approuvé</option>
                        <option value="rejete" {{ $terrain->admin_approval === 'rejete' ? 'selected' : '' }}>Rejeté</option>
                        <option value="suspended" {{ $terrain->admin_approval === 'suspended' ? 'selected' : '' }}>Suspendu</option>
                    </select>
                    <button type="submit" class="bg-[#580a21] hover:bg-[#420718] text-white px-4 py-2 rounded-lg">
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqVU_6aeLYTiHfc4MLSvHrWri6wZ6SdwI"></script>
<script src="{{ asset('js/showMap.js') }}"></script>


<script>
     document.addEventListener("DOMContentLoaded", function () {
                              showMap('{{ $terrain->latitude}}','{{ $terrain->longitude }}');
    });

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