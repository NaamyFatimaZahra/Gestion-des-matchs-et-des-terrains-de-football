@extends('Layout.dashboard')
@section('title', 'Ajouter un terrain')
@section('content')
<div class="flex-1 overflow-auto p-6 bg-gray-100">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ajouter un nouveau terrain</h1>
        <p class="text-gray-600">Remplissez les informations ci-dessous pour créer un nouveau terrain</p>
    </div>

    <form action="{{ route('admin.terrain.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow overflow-hidden">
        @csrf
        
        <!-- Informations générales -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Informations générales</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom du terrain <span class="text-red-500">*</span></label>
                    <input type="text" name="nom" id="nom" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="proprietaire_id" class="block text-sm font-medium text-gray-700 mb-1">Propriétaire</label>
                    <select name="proprietaire_id" id="proprietaire_id" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Sélectionner un propriétaire</option>
                       
                        <option value="1">Propriétaire 1</option>
                        <option value="2">Propriétaire 2</option>
                       
                    </select>
                </div>
                
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacité</label>
                    <input type="number" name="capacity" id="capacity" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Prix (MAD) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="price" id="price" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Méthode de paiement <span class="text-red-500">*</span></label>
                    <select name="payment_method" id="payment_method" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Sélectionner une méthode</option>
                        <option value="en_ligne">En ligne</option>
                        <option value="sur_place">Sur place</option>
                        <option value="les_deux">Les deux</option>
                    </select>
                </div>
                
                <div>
                    <label for="surface" class="block text-sm font-medium text-gray-700 mb-1">Type de surface <span class="text-red-500">*</span></label>
                    <select name="surface" id="surface" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Sélectionner une surface</option>
                        <option value="gazon_naturel">Gazon naturel</option>
                        <option value="gazon_synthetique">Gazon synthétique</option>
                        <option value="gazon_hybride">Gazon hybride</option>
                        <option value="turf_artificiel">Turf artificiel</option>
                        <option value="stabilise">Stabilisé (Maâreb)</option>
                        <option value="sable">Sable</option>
                        <option value="beton">Béton</option>
                        <option value="terre_battue">Terre battue</option>
                        <option value="indoor_synthetique">Indoor synthétique</option>
                        <option value="altra_resist">Altra Resist</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
        </div>
        
        <!-- Localisation -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Localisation</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Ville <span class="text-red-500">*</span></label>
                    <input type="text" name="city" id="city" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="adress" class="block text-sm font-medium text-gray-700 mb-1">Adresse <span class="text-red-500">*</span></label>
                    <input type="text" name="adress" id="adress" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                    <input type="text" name="latitude" id="latitude" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                    <input type="text" name="longitude" id="longitude" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
                    <input type="text" name="contact" id="contact" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <!-- Carte pour sélectionner l'emplacement (à implémenter avec JavaScript et une API comme Google Maps) -->
            <div class="mt-6 bg-gray-100 rounded-lg p-4 h-64 flex items-center justify-center">
                <div class="text-center text-gray-500">
                    <i class="fas fa-map-marker-alt text-3xl mb-2"></i>
                    <p>Carte pour sélectionner l'emplacement</p>
                    <p class="text-xs mt-2">Cliquez sur la carte pour définir automatiquement la latitude et la longitude</p>
                </div>
            </div>
        </div>
        
        <!-- Photos et médias -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Photos et médias</h2>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Images du terrain</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" name="images[]" id="images" multiple class="hidden">
                    <label for="images" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500">Cliquez ou glissez-déposez les photos ici</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG ou JPEG (max. 5MB par image)</p>
                        <button type="button" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Parcourir les fichiers
                        </button>
                    </label>
                </div>
                <div class="grid grid-cols-4 gap-4 mt-4" id="image-preview">
                    <!-- Les aperçus d'images téléchargées apparaîtront ici -->
                </div>
            </div>
        </div>
        
        <!-- Statut et paramètres administratifs -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Statut et paramètres administratifs</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut initial</label>
                    <select name="status" id="status" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="en_attente">En attente</option>
                        <option value="disponible">Disponible</option>
                        <option value="occupé">Occupé</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
                
                <div>
                    <label for="admin_approval" class="block text-sm font-medium text-gray-700 mb-1">Approbation administrative</label>
                    <select name="admin_approval" id="admin_approval" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending">En attente</option>
                        <option value="approved">Approuvé</option>
                        <option value="rejected">Rejeté</option>
                    </select>
                </div>
                
                <div class="flex items-center mt-6">
                    <input type="checkbox" name="verified" id="verified" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="verified" class="ml-2 block text-sm text-gray-700">Marquer comme vérifié</label>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" name="active" id="active" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="active" class="ml-2 block text-sm text-gray-700">Activer immédiatement</label>
                </div>
            </div>
        </div>
        
        <!-- Services (si vous souhaitez les ajouter directement) -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Services disponibles</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Ces services devraient être générés dynamiquement depuis votre base de données -->
                <div class="border rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="services[]" value="1" id="service_1" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_1" class="ml-2 block text-sm font-medium text-gray-700">Vestiaires</label>
                        </div>
                        <span class="text-sm text-gray-500">+50 MAD</span>
                    </div>
                    <div class="mt-2 ml-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="service_inclus[1]" id="service_inclus_1" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_inclus_1" class="ml-2 block text-sm text-gray-500">Inclus dans le prix</label>
                        </div>
                    </div>
                </div>
                
                <div class="border rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="services[]" value="2" id="service_2" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_2" class="ml-2 block text-sm font-medium text-gray-700">Douches</label>
                        </div>
                        <span class="text-sm text-gray-500">+30 MAD</span>
                    </div>
                    <div class="mt-2 ml-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="service_inclus[2]" id="service_inclus_2" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_inclus_2" class="ml-2 block text-sm text-gray-500">Inclus dans le prix</label>
                        </div>
                    </div>
                </div>
                
                <div class="border rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="services[]" value="3" id="service_3" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_3" class="ml-2 block text-sm font-medium text-gray-700">Éclairage</label>
                        </div>
                        <span class="text-sm text-gray-500">+100 MAD</span>
                    </div>
                    <div class="mt-2 ml-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="service_inclus[3]" id="service_inclus_3" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_inclus_3" class="ml-2 block text-sm text-gray-500">Inclus dans le prix</label>
                        </div>
                    </div>
                </div>
                
                <div class="border rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="services[]" value="4" id="service_4" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_4" class="ml-2 block text-sm font-medium text-gray-700">Parking</label>
                        </div>
                        <span class="text-sm text-gray-500">+20 MAD</span>
                    </div>
                    <div class="mt-2 ml-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="service_inclus[4]" id="service_inclus_4" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_inclus_4" class="ml-2 block text-sm text-gray-500">Inclus dans le prix</label>
                        </div>
                    </div>
                </div>
                
                <div class="border rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="services[]" value="5" id="service_5" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_5" class="ml-2 block text-sm font-medium text-gray-700">Équipements (chasubles, ballons)</label>
                        </div>
                        <span class="text-sm text-gray-500">+40 MAD</span>
                    </div>
                    <div class="mt-2 ml-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="service_inclus[5]" id="service_inclus_5" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_inclus_5" class="ml-2 block text-sm text-gray-500">Inclus dans le prix</label>
                        </div>
                    </div>
                </div>
                
                <div class="border rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="services[]" value="6" id="service_6" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="service_6" class="ml-2 block text-sm font-medium text-gray-700">Cafétéria</label>
                        </div>
                        <span class="text-sm text-gray-500">+0 MAD</span>
                    </div>
                    <div class="mt-2 ml-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="service_inclus[6]" id="service_inclus_6" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                            <label for="service_inclus_6" class="ml-2 block text-sm text-gray-500">Inclus dans le prix</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Boutons d'action -->
        <div class="p-6 flex justify-end space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Annuler
            </a>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-save mr-2"></i> Enregistrer le terrain
            </button>
        </div>
    </form>
</div>

<!-- Script pour la prévisualisation des images (à compléter avec du JavaScript) -->
<script>
    // Ajoutez ici le code JavaScript pour la prévisualisation des images
    // et pour la gestion de la carte (Google Maps ou similaire)
</script>
@endsection