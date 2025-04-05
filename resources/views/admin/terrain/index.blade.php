@extends('Layout.dashboard')
@section('title', 'Gestion des Terrains')
@section('content')
<div class="flex-1 overflow-auto p-6 bg-gray-100">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Liste des terrains</h1>
        <button class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg flex items-center">
            <a href="{{ route('admin.terrains.create') }}"><i class="fas fa-plus mr-2"></i> Ajouter un terrain</a>
        </button>
    </div>

    <!-- Filtres et recherche -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-wrap justify-between gap-4">
            <div class="flex items-center">
                <div class="relative">
                    <input type="text" placeholder="Rechercher un terrain..." class="border border-gray-300 rounded-lg pl-10 pr-4 py-2 w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <select class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Status</option>
                    <option value="active">Actif</option>
                    <option value="inactive">Inactif</option>
                    <option value="pending">En attente</option>
                </select>
                <select class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Disponibilité</option>
                    <option value="available">Disponible</option>
                    <option value="booked">Réservé</option>
                    <option value="maintenance">En maintenance</option>
                </select>
                <select class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Photos validées</option>
                    <option value="validated">Validées</option>
                    <option value="pending">En attente</option>
                    <option value="rejected">Rejetées</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Tableau des terrains -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center">
                            Terrain <i class="fas fa-sort ml-1"></i>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center">
                            Localisation <i class="fas fa-sort ml-1"></i>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center">
                            Status <i class="fas fa-sort ml-1"></i>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center">
                            Disponibilité
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center">
                            Photos
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center">
                            Dernière mise à jour <i class="fas fa-sort ml-1"></i>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Terrain 1 -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" alt="Terrain" class="h-10 w-10 rounded-md mr-3">
                            <div>
                                <div class="font-medium text-gray-900">Terrain Parc Central</div>
                                <div class="text-sm text-gray-500">Football à 7</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">Paris 19ème</div>
                        <div class="text-sm text-gray-500">10 Avenue du Parc</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Actif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="h-3 w-3 rounded-full bg-green-500 mr-2"></span>
                            <span class="text-sm text-gray-900">Disponible</span>
                        </div>
                        <button class="text-xs text-blue-600 hover:text-blue-800 mt-1">
                            <i class="fas fa-calendar-alt mr-1"></i> Gérer
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i> Validées (5)
                            </span>
                        </div>
                        <button class="text-xs text-blue-600 hover:text-blue-800 mt-1">
                            <i class="fas fa-images mr-1"></i> Voir
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        15/03/2025
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <button class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- Terrain 2 -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" alt="Terrain" class="h-10 w-10 rounded-md mr-3">
                            <div>
                                <div class="font-medium text-gray-900">Terrain République</div>
                                <div class="text-sm text-gray-500">Football à 5</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">Paris 11ème</div>
                        <div class="text-sm text-gray-500">25 Rue Oberkampf</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            En attente
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="h-3 w-3 rounded-full bg-red-500 mr-2"></span>
                            <span class="text-sm text-gray-900">Réservé</span>
                        </div>
                        <button class="text-xs text-blue-600 hover:text-blue-800 mt-1">
                            <i class="fas fa-calendar-alt mr-1"></i> Gérer
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i> En attente (3)
                            </span>
                        </div>
                        <button class="text-xs text-blue-600 hover:text-blue-800 mt-1">
                            <i class="fas fa-images mr-1"></i> Valider
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        10/03/2025
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <button class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- Terrain 3 -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" alt="Terrain" class="h-10 w-10 rounded-md mr-3">
                            <div>
                                <div class="font-medium text-gray-900">Terrain Stade Nord</div>
                                <div class="text-sm text-gray-500">Football à 11</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">Paris 18ème</div>
                        <div class="text-sm text-gray-500">35 Boulevard Ney</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Inactif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="h-3 w-3 rounded-full bg-gray-500 mr-2"></span>
                            <span class="text-sm text-gray-900">En maintenance</span>
                        </div>
                        <button class="text-xs text-blue-600 hover:text-blue-800 mt-1">
                            <i class="fas fa-calendar-alt mr-1"></i> Gérer
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i> Rejetées (2)
                            </span>
                        </div>
                        <button class="text-xs text-blue-600 hover:text-blue-800 mt-1">
                            <i class="fas fa-images mr-1"></i> Voir
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        05/03/2025
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <button class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">3</span> sur <span class="font-medium">12</span> terrains
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600 hover:bg-blue-100">
                            1
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            2
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            3
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            4
                        </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modals (en commentaire pour référence future) -->
    <!--
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Gérer les disponibilités</h2>
            <div class="mb-4">
                <div class="bg-gray-100 p-4 rounded-lg">
                    Calendrier des disponibilités à implémenter
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button class="px-4 py-2 bg-gray-300 rounded-lg">Annuler</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">Enregistrer</button>
            </div>
        </div>
    </div>
    
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Validation des photos</h2>
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <img src="/api/placeholder/200/150" alt="Photo du terrain" class="w-full h-32 object-cover rounded-lg">
                    <div class="flex justify-between mt-2">
                        <button class="text-red-600"><i class="fas fa-times"></i> Rejeter</button>
                        <button class="text-green-600"><i class="fas fa-check"></i> Valider</button>
                    </div>
                </div>
                <div>
                    <img src="/api/placeholder/200/150" alt="Photo du terrain" class="w-full h-32 object-cover rounded-lg">
                    <div class="flex justify-between mt-2">
                        <button class="text-red-600"><i class="fas fa-times"></i> Rejeter</button>
                        <button class="text-green-600"><i class="fas fa-check"></i> Valider</button>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button class="px-4 py-2 bg-gray-300 rounded-lg">Fermer</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">Enregistrer tout</button>
            </div>
        </div>
    </div>
    -->
</div>
@endsection