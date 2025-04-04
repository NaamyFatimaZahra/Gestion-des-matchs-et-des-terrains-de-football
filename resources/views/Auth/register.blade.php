<!-- resources/views/auth/register.blade.php -->

@extends('Layout.guest')
@section('title', 'Inscription')

@section('content')
    <section class=" flex h-[100vh]">
    <div class="flex justify-between items-center w-[70%] m-auto h-[80vh]    bg-white shadow-lg rounded-lg overflow-hidden"> 
    
      <div class="relative h-full w-[50%] bg-[#580a21] rounded-tr-[8rem] rounded-br-[8rem]">
       <!-- <img src="{{ asset('assets/img/stud.jpg') }}" alt="image de stud" class="w-full h-full"> -->
         <div class="absolute left-[50%] top-[50%] translate-x-[-50%]  translate-y-[-50%] flex justify-center items-center flex-col">
             <!-- Logo/Icon avec Font Awesome -->
            <div class="flex justify-center mb-4">
                <div class="h-16 w-16 rounded-full border-2 border-[white] flex items-center justify-center">
                    <i class="fas fa-user text-[white] text-3xl"></i>
                </div>
            </div>
            
            <!-- Titre -->
            <h2 class="text-2xl font-medium text-center text-[white] mb-1">Bienvenue, cela prend moins de 60 secondes</h2>  
            <p class="text-center text-gray-500 mb-6">Vous avez déjà un compte ? </p>
       
            <a href="{{ route('showLogin') }}" class="text-[#580a21]  pt-[1rem] bg-[white] py-[1rem] px-[1rem] text-center rounded-lg w-[70%]">Connectez-vous</a>
      
         </div>
      </div>

        <!-- Formulaire -->
            <form method="POST" id="form" class="max-w-md w-[50%]  p-8 " action="{{ route('register') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                
            
                    <!-- Nom -->
                    <div class="w-ful">
                        <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Votre nom : <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="w-full">
                        <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Adresse e-mail : <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
            

                <!-- Mot de passe -->
              
                 <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Mot de passe : <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirmation du mot de passe -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1">Répéter le mot de passe : <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
                    <span class="text-red-500 text-xs hidden" id='password_confirmation_span'></span>
                    @error('password_confirmation')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
              

               
                 <!-- Ville -->
                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-600 mb-1">Ville : <span class="text-red-500">*</span></label>
                    <select id="city" name="city" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
                        <option value="">Sélectionnez une ville</option>
                    </select>
                    @error('city')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Sélection du rôle -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-600 mb-1">Rôle : <span class="text-red-500">*</span></label>
                    <select id="role" name="role" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
                        @foreach ($roles as $role)
                        <option value="{{ $role['id'] }}">{{$role['name']}}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
               

                <!-- Bouton de soumission avec Font Awesome -->
                <div>
                    <button type="submit" class="w-full px-4 py-3 bg-[#580a21] text-white rounded-md hover:bg-[#7a0d2b] focus:outline-none focus:ring-2 focus:ring-[#580a21] flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Script pour la validation des mots de passe -->
    <!-- <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            let password = document.getElementById('password').value;
            let passwordConfirmed = document.getElementById('password_confirmation').value;
            let span = document.getElementById('password_confirmation_span');

            if (password !== passwordConfirmed) {
                span.innerHTML = 'Les mots de passe ne correspondent pas';
                span.classList.remove('hidden');
                event.preventDefault(); // Empêche la soumission du formulaire
            } else {
                span.classList.add('hidden');
            }
        });
    </script> -->

    <script>
        // Fonction pour charger les villes marocaines depuis l'API GeoNames
        document.addEventListener('DOMContentLoaded', function() {
            // URL de l'API GeoNames avec vos paramètres
            const apiUrl = 'http://api.geonames.org/searchJSON?country=MA&username=fatizahra&featureClass=P&maxRows=1000';
            
            // Sélectionner l'élément select
            const citySelect = document.getElementById('city');
            
            // Fonction pour trier par ordre alphabétique
            const sortByName = (a, b) => {
                return a.name.localeCompare(b.name);
            };
            
            // Vider le contenu actuel du select
            citySelect.innerHTML = '<option value="">Sélectionnez une ville</option>';
            
            // Ajouter un indicateur de chargement visuel (spinner)
            citySelect.disabled = true;
            const loadingContainer = document.createElement('div');
            loadingContainer.id = 'loading-cities-container';
            loadingContainer.className = 'flex items-center mt-1';
            loadingContainer.innerHTML = `
                <div class="mr-2"><i class="fas fa-spinner fa-spin text-[#580a21]"></i></div>
                <span id="loading-cities" class="text-sm text-gray-500">Chargement des villes...</span>
            `;
            citySelect.parentNode.appendChild(loadingContainer);
            
            // Récupérer les données de l'API
            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur réseau: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    // Récupérer les villes et les trier par ordre alphabétique
                    const cities = data.geonames.filter(city => city.fcl === 'P').sort(sortByName);
                    
                    // Ajouter chaque ville comme option dans le select
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                    
                    // Supprimer l'indicateur de chargement et activer le select
                    document.getElementById('loading-cities-container').remove();
                    citySelect.disabled = false;
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des villes:', error);
                    
                    // En cas d'erreur, afficher un message et réactiver le champ
                    document.getElementById('loading-cities').textContent = 'Erreur lors du chargement des villes. Veuillez saisir manuellement.';
                    document.querySelector('#loading-cities-container .fa-spinner').style.display = 'none';
                    citySelect.disabled = false;
                    
                    // Charger une liste de secours des principales villes
                    const fallbackCities = [
                        'Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Tanger', 'Agadir', 
                        'Meknès', 'Oujda', 'Kénitra', 'Tétouan', 'Safi', 'El Jadida'
                    ];
                    
                    fallbackCities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city;
                        option.textContent = city;
                        citySelect.appendChild(option);
                    });
                });
        });
    </script>
    <script src="{{ asset('/public/js/morrocaineCities.js') }}"></script>
    <script>
       console.log(moroccanCities);
    </script>
@endsection