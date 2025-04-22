@extends('Layout.dashboard')
@section('title', 'Ajouter un Terrain')
@section('content')

<div class="container mx-auto px-4 py-8 mt-[4rem] text-gray-800">
     <div class="">

    <!-- En-tête avec titre et bouton de retour -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ajouter un Terrain</h1>
        <a href="{{ route('proprietaire.terrains.index') }}" class="bg-rose-50 hover:bg-rose-100 text-gray-800 px-4 py-2 rounded-lg flex items-center transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
        </a>
    </div>

    <!-- Card principale du formulaire -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <!-- Bannière supérieure -->
        <div class="bg-[#580a21] py-4 px-6 flex items-center">
            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-3">
                <i class="fas fa-futbol text-white"></i>
            </div>
            <div>
                <h2 class="text-white font-bold">Nouveau Terrain</h2>
                <p class="text-white/80 text-sm">Remplissez les informations ci-dessous</p>
            </div>
        </div>
   </div>

        <!-- Contenu du formulaire -->
        <form action="{{ route('proprietaire.terrain.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <!-- Erreurs de validation -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                        <p class="font-medium">Veuillez corriger les erreurs suivantes:</p>
                    </div>
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li class="mb-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Sections avec tabs -->
            <div class="mb-6">
                <div class="flex border-b border-gray-200 mb-4">
                    <button type="button" class="px-4 py-2 text-[#580a21] border-b-2 border-[#580a21] font-medium" onclick="navigateToSection('info')">Informations</button>
                    <button type="button" class="px-4 py-2 text-gray-500 hover:text-gray-800" onclick="navigateToSection('localisation')">Localisation</button>
                    <button type="button" class="px-4 py-2 text-gray-500 hover:text-gray-800" onclick="navigateToSection('photo')">Photos</button>
                    <button type="button" class="px-4 py-2 text-gray-500 hover:text-gray-800" onclick="navigateToSection('service')">Services</button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Colonne gauche -->
                <div class="space-y-5">
                    <!-- Nom du terrain -->
                    <div class="space-y-2">
                        <label for="name" class="flex items-center text-sm font-medium text-gray-700">
                            <i class="fas fa-tag text-[#580a21] mr-2"></i>
                            Nom du terrain <span class="text-[#580a21] ml-1">*</span>
                        </label>
                        <input type="text" name="name" id="name" required 
                            class="bg-white border border-gray-200 rounded-lg px-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300"
                            placeholder="Ex: Terrain de foot Al Manar">
                    </div>
                    
                    <!-- Description -->
                    <div class="space-y-2">
                        <label for="description" class="flex items-center text-sm font-medium text-gray-700">
                            <i class="fas fa-align-left text-[#580a21] mr-2"></i>
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4" 
                            class="bg-white border border-gray-200 rounded-lg px-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300"
                            placeholder="Décrivez votre terrain (équipements, avantages, etc.)"></textarea>
                    </div>
                    
                    <!-- Capacité -->
                    <div class="space-y-2">
                        <label for="capacity" class="flex items-center text-sm font-medium text-gray-700">
                            <i class="fas fa-users text-[#580a21] mr-2"></i>
                            Capacité (nombre de joueurs)
                        </label>
                        <input type="number" name="capacity" id="capacity" min="1" 
                            class="bg-white border border-gray-200 rounded-lg px-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300"
                            placeholder="Ex: 22">
                    </div>
                    
                    <!-- Prix -->
                    <div class="space-y-2">
                        <label for="price" class="flex items-center text-sm font-medium text-gray-700">
                            <i class="fas fa-money-bill-wave text-[#580a21] mr-2"></i>
                            Prix par heure (MAD) <span class="text-[#580a21] ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="price" id="price" required min="0" step="0.01" 
                                class="bg-white border border-gray-200 rounded-lg pl-10 pr-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300"
                                placeholder="Ex: 300">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">MAD</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne droite -->
                <div class="space-y-5">
                    <!-- Type de surface -->
                    <div class="space-y-2">
                        <label for="surface" class="flex items-center text-sm font-medium text-gray-700">
                            <i class="fas fa-layer-group text-[#580a21] mr-2"></i>
                            Type de surface <span class="text-[#580a21] ml-1">*</span>
                        </label>
                        <select name="surface" id="surface" required 
                            class="bg-white border border-gray-200 rounded-lg px-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300">
                            <option value="">Sélectionner une surface</option>
                            <option value="gazon_naturel">Gazon naturel</option>
                            <option value="gazon_synthetique">Gazon synthétique</option>
                            <option value="gazon_hybride">Gazon hybride</option>
                            <option value="turf_artificiel">Turf artificiel</option>
                            <option value="stabilise">Stabilisé</option>
                            <option value="sable">Sable</option>
                            <option value="beton">Béton</option>
                            <option value="terre_battue">Terre battue</option>
                            <option value="indoor_synthetique">Indoor synthétique</option>
                            <option value="altra_resist">Ultra résistant</option>
                        </select>
                    </div>
                    
                   <!-- Ville -->
                    <div class="space-y-2">
                        <label for="city" class="flex items-center text-sm font-medium text-gray-700">
                            <i class="fas fa-city text-[#580a21] mr-2"></i>
                            Ville <span class="text-[#580a21] ml-1">*</span>
                        </label>
                       <select id="city" name="city" class="bg-white border border-gray-200 rounded-lg px-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300" required>
                        <option value="">Sélectionnez une ville</option>
                    </select>
                    </div>
                    
                    <!-- Adresse -->
                    <div class="space-y-2">
                        <label for="adress" class="flex items-center text-sm font-medium text-gray-700">
                            <i class="fas fa-map-marker-alt text-[#580a21] mr-2"></i>
                            Adresse <span class="text-[#580a21] ml-1">*</span>
                        </label>
                        <input type="text" name="adress" id="adress" required 
                            class="bg-white border border-gray-200 rounded-lg px-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300"
                            placeholder="Ex: 123 Boulevard Mohammed V">
                    </div>


                    <!-- Mode de paiement -->
                    <div class="space-y-2 ">
                        <label for="payment_method" class="flex items-center text-sm font-medium text-gray-700">
                            <i class="fas fa-credit-card text-[#580a21] mr-2"></i>
                            Mode de paiement <span class="text-[#580a21] ml-1">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-3 mt-8">
                           
                            <div class="relative">
                                <input type="radio" name="payment_method" id="payment_local" value="sur_place" class="hidden peer">
                                <label for="payment_local" class="flex flex-col items-center justify-center p-3 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-[#580a21] peer-checked:bg-[#580a21]/10 transition duration-300 h-full">
                                    <i class="fas fa-store text-xl mb-1"></i>
                                    <span class="text-sm font-medium">Sur place</span>
                                </label>
                            </div>
                         
                        </div>
                    </div>
                    
                   
                </div>
            </div>
            
            <!-- Coordonnées géographiques et contact -->
            <div id="localisation" class="mt-6 p-5 bg-rose-50 rounded-xl border border-gray-200">
                <h3 class="text-gray-800 font-medium mb-4 flex items-center">
                    <i class="fas fa-map text-[#580a21] mr-2"></i>
                    Coordonnées supplémentaires
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label for="latitude" class="text-sm font-medium text-gray-700">Latitude</label>
                        <input type="number" name="latitude" id="latitude" 
                            class="bg-white border border-gray-200 rounded-lg px-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300"
                            placeholder="Ex: 33.5731104">
                    </div>
                    <div class="space-y-2">
                        <label for="longitude" class="text-sm font-medium text-gray-700">Longitude</label>
                        <input type="number" name="longitude" id="longitude" 
                            class="bg-white border border-gray-200 rounded-lg px-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300"
                            placeholder="Ex: -7.5898434">
                    </div>
                    <div class="space-y-2">
                        <label for="contact" class="text-sm font-medium text-gray-700">Numéro de contact</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-500"></i>
                            </div>
                            <input type="number" name="contact" id="contact" 
                                class="bg-white border border-gray-200 rounded-lg pl-10 pr-4 py-3 w-full text-gray-800 focus:border-[#580a21] focus:ring-1 focus:ring-[#580a21] transition duration-300"
                                placeholder="Ex: +212 661-234567">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Téléchargement des photos -->
            <div id="photo" class="mt-6 p-5 bg-rose-50 rounded-xl border border-gray-200">
                <h3 class="text-gray-800 font-medium mb-4 flex items-center">
                    <i class="fas fa-images text-[#580a21] mr-2"></i>
                    Photos du terrain
                </h3>
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center relative">
                    <input type="file"  class="hidden" id="imageUpload" accept="image/*" name="images[]" multiple>
                    <label for="imageUpload" class="cursor-pointer peer">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-cloud-upload-alt text-3xl text-[#580a21]"></i>
                        </div>
                        <h4 class="text-gray-800 font-medium mb-1">Déposez vos images ici</h4>
                        <p class="text-gray-600 mb-2">ou cliquez pour télécharger des images</p>
                        <p class="text-xs text-gray-500">JPG, PNG,JPEG,WEBP (max. 5MB par image)</p>
                    </label>
                </div>
                <p><span class="text-[#580a21]">*Info:</span> si tu veut ajouter plusier image clisk sur controle et choisie votre image</p>
                <div id="image-preview"  class="mt-3 grid grid-cols-3 md:grid-cols-5 gap-2"></div>
                
            </div>
            
            <!-- Services disponibles -->
            <div id="service" class="mt-6 p-5 bg-rose-50 rounded-xl border border-gray-200">
                <h3 class="text-gray-800 font-medium mb-4 flex items-center">
                    <i class="fas fa-concierge-bell text-[#580a21] mr-2"></i>
                    Services disponibles
                </h3>
                <p class="text-gray-600 mb-4 text-sm">Sélectionnez les services que vous proposez sur ce terrain</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($services as $service)
                        <div class="relative">
                            <input type="checkbox" name="services[]" id="service_{{ $service->id }}" value="{{ $service->id }}" class="hidden peer">
                            <label for="service_{{ $service->id }}" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-[#580a21] peer-checked:bg-[#580a21]/10 transition duration-300">
                                <div class="w-8 h-8 rounded-md bg-rose-50 flex items-center justify-center mr-3 peer-checked:bg-[#580a21]">
                                    <i class="fas fa-plus text-gray-500 peer-checked:text-white"></i>
                                </div>
                                <span class="text-gray-800">{{ $service->name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Boutons d'action -->
            <div class="mt-8 flex flex-wrap gap-4 justify-end">
               
                <button type="submit" class="px-6 py-3 bg-[#580a21] hover:bg-[#420718] text-white rounded-lg font-medium flex items-center transition duration-300">
                    <i class="fas fa-save mr-2"></i> Enregistrer le terrain
                </button>
            </div>
        </form>
    </div>
    
    <!-- Progression -->
    <div class="mt-6 flex justify-center">
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <span class="text-[#580a21]">Étape 1</span>
            <i class="fas fa-chevron-right text-gray-400"></i>
            <span>Publication</span>
        </div>
    </div>
</div>


</n>

<!-- Script pour la prévisualisation des images -->
<script>


 
  document.getElementById('imageUpload').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML='';
    const files = e.target.files;
    
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        const file = files[i];
        console.log(file);
        
        reader.onload = function(event) {
            const imageUrl = event.target.result;
            preview.innerHTML += `
                <div class="relative">
                    <img src="${imageUrl}" class="h-26 w-26 object-cover rounded-lg">
                    <button type="button" class="absolute top-1 right-1 bg-[#580a21] text-white rounded-full w-5 h-5 flex items-center justify-center"
                            onclick="this.parentElement.remove()">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            `;
        };
        
        reader.readAsDataURL(file);
    }
});


function navigateToSection(sectionId){
     const section = document.getElementById(sectionId);
             console.log(sectionId);
            if (section) {
                
                section.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
             }
}
          
    


</script>

  <script src="{{ asset('js/morrocaineCities.js') }}"></script>
@endsection