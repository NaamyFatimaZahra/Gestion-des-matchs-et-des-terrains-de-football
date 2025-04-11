@extends('Layout.dashboard')
@section('title', 'Ajouter un Terrain')
@section('content')

<div class="container mx-auto px-4 py-8 mt-[4rem] text-gray-300">
    <!-- En-tête avec titre et bouton de retour -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Ajouter un Terrain</h1>
        <a href="{{ route('proprietaire.terrains.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
        </a>
    </div>

    <!-- Formulaire d'ajout -->
    <div class="bg-gray-900 rounded-lg shadow-md p-6 border border-gray-700">
        <form action="{{ route('proprietaire.terrain.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Erreurs de validation -->
            @if ($errors->any())
                <div class="bg-red-900 border border-red-700 text-red-100 px-4 py-3 rounded relative mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informations générales -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom du terrain *</label>
                        <input type="text" name="name" id="name" required 
                            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white"
                            placeholder="Ex: Terrain de foot Al Manar">
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                        <textarea name="description" id="description" rows="4" 
                            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white"
                            placeholder="Décrivez votre terrain (équipements, avantages, etc.)"></textarea>
                    </div>
                    
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-300 mb-1">Capacité (nombre de joueurs)</label>
                        <input type="number" name="capacity" id="capacity" min="1" 
                            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white"
                            placeholder="Ex: 22">
                    </div>
                    
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-300 mb-1">Prix par heure (MAD) *</label>
                        <input type="number" name="price" id="price" required min="0" step="0.01" 
                            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white"
                            placeholder="Ex: 300">
                    </div>
                    
                    <div>
                        <label for="surface" class="block text-sm font-medium text-gray-300 mb-1">Type de surface *</label>
                        <select name="surface" id="surface" required 
                            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white">
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
                    
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-300 mb-1">Mode de paiement *</label>
                        <select name="payment_method" id="payment_method" required 
                            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white">
                            <option value="">Sélectionner un mode de paiement</option>
                            <option value="en_ligne">En ligne</option>
                            <option value="sur_place">Sur place</option>
                            <option value="les_deux">Les deux</option>
                        </select>
                    </div>
                </div>
                
                <!-- Localisation et contact -->
                <div class="space-y-4">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-300 mb-1">Ville *</label>
                        <input type="text" name="city" id="city" required 
                            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white"
                            placeholder="Ex: Casablanca">
                    </div>
                    
                    <div>
                        <label for="adress" class="block text-sm font-medium text-gray-300 mb-1">Adresse *</label>
                        <input type="text" name="adress" id="adress" required 
                            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white"
                            placeholder="Ex: 123 Boulevard Mohammed V">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-300 mb-1">Latitude</label>
                            <input type="text" name="latitude" id="latitude" 
                                class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white"
                                placeholder="Ex: 33.5731104">
                        </div>
                        <div>
                            <label for="longitude" class="block text-sm font-medium text-gray-300 mb-1">Longitude</label>
                            <input type="text" name="longitude" id="longitude" 
                                class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white"
                                placeholder="Ex: -7.5898434">
                        </div>
                    </div>
                    
                    <div>
                        <label for="contact" class="block text-sm font-medium text-gray-300 mb-1">Numéro de contact</label>
                        <input type="text" name="contact" id="contact" 
                            class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-full text-white"
                            placeholder="Ex: +212 661-234567">
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-300 mb-1">Photos du terrain</label>
                        <div class="border-2 border-dashed border-gray-700 rounded-lg p-6 text-center">
                            <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*">
                            <label for="images" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-500 mb-2"></i>
                                <p class="text-gray-400">Cliquez pour télécharger des images</p>
                                <p class="text-xs text-gray-500 mt-1">JPG, PNG (max. 5MB par image)</p>
                            </label>
                        </div>
                        <div id="image-preview" class="mt-3 grid grid-cols-3 gap-2"></div>
                    </div>
                </div>
            </div>
             
          <!-- Services disponibles -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Services disponibles</h2>
                <p class="text-gray-600 mb-4">Sélectionnez les services que vous proposez sur ce terrain</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($services as $service)
                        <div class="relative">
                            <input  type="checkbox" id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}" class="peer absolute opacity-0 h-0 w-0">
                            <label for="service_{{ $service->id }}" class="flex justify-between items-center w-full p-3 bg-white border border-gray-300 rounded-md cursor-pointer transition-all duration-150 hover:border-gray-400">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-{{ $service->icon ?? 'plus' }} text-gray-500 w-5 text-center"></i>
                                    <span class="text-gray-800">{{ $service->name }}</span>
                                    @if($service->price)
                                        <span class="ml-2 text-sm text-gray-500">{{ $service->price }} MAD</span>
                                    @endif
                                </div>
                                <div class="w-5 h-5 bg-white border border-gray-300 rounded-sm flex items-center justify-center peer-checked:bg-green-500 peer-checked:border-green-500">
                                    <i class="fas fa-check text-white text-xs hidden peer-checked:block"></i>
                                    <div class="peer-checked:block hidden">
                                        <svg class="w-3.5 h-3.5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>  
            
            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                    <i class="fas fa-save mr-2"></i> Enregistrer le terrain
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script pour la prévisualisation des images -->
<script>
    document.getElementById('images').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = ''; // Vider la prévisualisation
        
        if (this.files) {
            Array.from(this.files).forEach(file => {
                if (!file.type.match('image.*')) return;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'h-24 w-full object-cover rounded';
                    
                    div.appendChild(img);
                    preview.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    });
</script>

@endsection