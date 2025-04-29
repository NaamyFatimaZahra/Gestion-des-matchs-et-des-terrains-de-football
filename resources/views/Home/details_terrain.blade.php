@extends('Layout.guest')
@section('title', 'Détails du Terrain')
@section('content')

<div class="min-h-screen bg-rose-50 text-gray-800 pt-16">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Alerte de succès avec animation -->
       @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

    <script>
        // Faire disparaître le message après 2 secondes
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if(alert) {
                // Option 1: Suppression immédiate
                // alert.remove();
                
                // Option 2: Disparition en fondu (plus élégant)
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
                <a href="{{ route('terrains') }}" class="bg-[#580a21] hover:bg-[#420718] text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors duration-200 shadow-md">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-800">{{ $terrain->name }}</h1>
            </div>
            <div class="flex flex-wrap gap-3">
              
                <a href="" class="bg-[#580a21] hover:bg-[#420718] text-white px-5 py-2 rounded-lg text-sm font-medium flex items-center transition-colors duration-200 shadow-md">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Disponibilités
                </a>
            </div>
        </div>

        <!-- Cartes principales d'information -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
            <!-- Carte de l'image et infos principales -->
            <div class="lg:col-span-4 bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200 transition-transform duration-300 hover:shadow-2xl">
                <!-- Remplacez la section existante de l'image du terrain -->
<div class="relative">
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

    <!-- Statut du terrain (garder la même partie) -->
    <div class="absolute top-4 right-4 flex flex-col space-y-2">
        <span class="bg-opacity-80 bg-gray-900 text-white text-xs px-3 py-1 rounded-full flex items-center">
            <span class="w-2 h-2 rounded-full mr-2 
                {{ $terrain->status === 'disponible' ? 'bg-green-400' : 
                ($terrain->status === 'occupé' ? 'bg-yellow-400' : 
                ($terrain->status === 'maintenance' ? 'bg-red-400' : 'bg-gray-400')) }}"></span>
            {{ $terrain->status === 'disponible' ? 'Disponible' : 
            ($terrain->status === 'occupé' ? 'Occupé' : 
            ($terrain->status === 'maintenance' ? 'Maintenance' : 'En attente')) }}
        </span>
        
        <span class="bg-opacity-80 bg-gray-900 text-white text-xs px-3 py-1 rounded-full flex items-center">
            <span class="w-2 h-2 rounded-full mr-2 
                {{ $terrain->admin_approval === 'approuve' ? 'bg-green-400' : 
                ($terrain->admin_approval === 'rejete' ? 'bg-red-400' : 
                ($terrain->admin_approval === 'suspended' ? 'bg-orange-400' : 'bg-yellow-400')) }}"></span>
            {{ $terrain->admin_approval === 'approuve' ? 'Approuvé' : 
            ($terrain->admin_approval === 'rejete' ? 'Rejeté' : 
            ($terrain->admin_approval === 'suspended' ? 'Suspendu' : 'En attente d\'approbation')) }}
        </span>
    </div>
</div>
                
                <div class="p-6">
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-500"></i>
                        <span>{{ $terrain->adress }}, {{ $terrain->city }}</span>
                    </div>
                    
                    <!-- Informations financières -->
                    <div class="bg-rose-50 rounded-lg p-4 mb-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-600">Tarif horaire</span>
                            <span class="text-xl font-bold text-[#580a21]">{{ number_format($terrain->price, 2) }} MAD</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600 block mb-1">Paiement</span>
                                <div class="flex items-center">
                                    <i class="fas fa-credit-card mr-1 text-gray-500"></i>
                                    {{ $terrain->payment_method === 'en_ligne' ? 'En ligne' : 
                                     ($terrain->payment_method === 'sur_place' ? 'Sur place' : 'Les deux') }}
                                </div>
                            </div>
                            <div>
                                <span class="text-gray-600 block mb-1">Capacité</span>
                                <div class="flex items-center">
                                    <i class="fas fa-users mr-1 text-gray-500"></i>
                                    {{ $terrain->capacity ?? 'Non spécifié' }} joueurs
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statistiques -->
                    <div class="grid grid-cols-2 gap-4 text-center">
                       
                        <div class="bg-rose-50 rounded-lg p-3">
                            <span class="block text-sm text-gray-600 mb-1">Ajouté le</span>
                            <span class="block text-lg text-gray-800">{{ $terrain->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Section d'informations détaillées -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Description et propriétaire -->
                <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="lg:flex">
                        <div class="lg:w-2/3 p-6">
                            <h3 class="text-xl font-semibold mb-4 flex items-center text-gray-800">
                                <i class="fas fa-info-circle mr-2 text-[#580a21]"></i>
                                Description
                            </h3>
                            <div class="text-gray-600 leading-relaxed">
                                {{ $terrain->description ?? 'Aucune description disponible pour ce terrain.' }}
                            </div>
                        </div>
                        
                        <div class="lg:w-1/3 p-6 bg-rose-50 lg:border-l border-gray-200">
                            <h3 class="text-xl font-semibold mb-4 flex items-center text-gray-800">
                                <i class="fas fa-user mr-2 text-[#580a21]"></i>
                                Propriétaire
                            </h3>
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-gray-500"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800">{{ $terrain->proprietaire->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-600">{{ $terrain->proprietaire->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone mr-2 text-gray-500"></i>
                                {{ $terrain->contact ?? 'Non spécifié' }}
                            </div>
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

      
        
     
        
       <!-- Commentaires et évaluations -->
<div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200 mt-8">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-xl font-semibold flex items-center text-gray-800">
            <i class="fas fa-comments mr-2 text-[#580a21]"></i>
            Commentaires et évaluations
        </h3>
    </div>
    
    <div class="p-6">
        <!-- Formulaire d'ajout de commentaire -->
        <div class="bg-rose-50 p-5 rounded-lg mb-6">
            <h4 class="font-semibold text-gray-800 mb-4">Laissez votre avis</h4>
            <form action="{{ route('joueur.comment.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Votre note</label>
                    <div class="flex space-x-1">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" class="rating-star text-2xl text-gray-300 hover:text-yellow-400 transition-colors" data-value="{{ $i }}">
                                ★
                            </button>
                        @endfor
                        <input type="hidden" name="rating" id="rating-value" value="0">
                        <input type="hidden" name="terrain_id" id="terrain_id" value="{{ $terrain->id }}">
                    </div>
                </div>
                <div>
                    <label for="comment" class="block text-gray-700 text-sm font-medium mb-2">Votre commentaire</label>
                    <textarea id="comment" name="content" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#580a21] focus:border-transparent" placeholder="Partagez votre expérience sur ce terrain..."></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-[#580a21] hover:bg-[#420718] text-white px-5 py-2 rounded-lg text-sm font-medium transition-colors duration-200 shadow-md">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Publier
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des commentaires -->
        @forelse($terrain->comments as $comment)
            <div class="border-b border-gray-200 pb-5 mb-5 last:border-b-0 last:mb-0 last:pb-0">
                <div class="flex justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                            <i class="fas fa-user text-gray-500"></i>
                        </div>
                        <div>
                            <div class="font-medium text-gray-800">{{ 
                            Auth::check() && Auth::user()->name === $comment->user->name ? 'VOUS' : $comment->user->name 
                            }}</div>
                            <div class="text-sm text-gray-600">{{ $comment->created_at->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                fill="currentColor" 
                                viewBox="0 0 20 20" 
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                        
                        {{-- Delete button/icon - Only show if user can delete --}}
                        @if(Auth::check() && Auth::user()->id === $comment->user_id )
                            <form method="POST" action="{{ route('joueur.comment.destroy', $comment) }}" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-[#580a21] transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="text-gray-600">
                    {{ $comment->content }}
                </div>
            </div>
        @empty
            <div class="text-center text-gray-600 py-4">
                Aucun commentaire disponible
            </div>
        @endforelse
    </div>
</div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqVU_6aeLYTiHfc4MLSvHrWri6wZ6SdwI"></script>
<script src="{{ asset('js/showMap.js') }}">

    
</script>
<script>
    
   document.addEventListener("DOMContentLoaded", function () {
                              showMap('{{ $terrain->latitude}}','{{ $terrain->longitude }}');
    });
   
</script>


<script>
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


//rating stars
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating-value');
    
    // Fonction pour mettre à jour l'affichage des étoiles
    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('text-yellow-400');
                star.classList.remove('text-gray-300');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
        ratingInput.value = rating;
    }
    
    // Ajouter les événements de clic sur chaque étoile
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = parseInt(this.getAttribute('data-value'));
            updateStars(value);
        });
        
        // Effet de survol
        star.addEventListener('mouseover', function() {
            const value = parseInt(this.getAttribute('data-value'));
            
            stars.forEach((s, index) => {
                if (index < value) {
                    s.classList.add('text-yellow-400');
                    s.classList.remove('text-gray-300');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                }
            });
        });
        
        // Rétablir l'affichage quand la souris quitte la zone des étoiles
        document.querySelector('.rating-star').parentElement.addEventListener('mouseleave', function() {
            const currentRating = parseInt(ratingInput.value);
            updateStars(currentRating);
        });
    });
});
</script>


@endsection