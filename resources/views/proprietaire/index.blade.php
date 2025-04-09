@extends('Layout.dashboard')
@section('title', 'Détails de l\'Utilisateur')
@section('content')


    <!-- Main Content -->
    <div class="container mx-auto p-4 mt-9">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Utilisateurs -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Utilisateurs</h3>
                    <div class="w-10 h-10 rounded-full bg-red-600/20 flex items-center justify-center">
                        <i class="fas fa-users text-red-600"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <span class="text-3xl font-bold mr-2">4,328</span>
                    <span class="text-green-500 flex items-center text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        12%
                    </span>
                </div>
                <p class="text-gray-400 text-sm mt-2">Depuis le mois dernier</p>
                <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                    <div class="bg-red-600 h-1 rounded-full" style="width: 78%"></div>
                </div>
            </div>

            <!-- Terrains Existants -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Terrains Existants</h3>
                    <div class="w-10 h-10 rounded-full bg-blue-600/20 flex items-center justify-center">
                        <i class="fas fa-futbol text-blue-600"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <span class="text-3xl font-bold mr-2">216</span>
                    <span class="text-gray-400 flex items-center text-sm">
                        <i class="fas fa-equals mr-1"></i>
                        0%
                    </span>
                </div>
                <p class="text-gray-400 text-sm mt-2">Terrains enregistrés</p>
                <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                    <div class="bg-blue-600 h-1 rounded-full" style="width: 65%"></div>
                </div>
            </div>

            <!-- Nouveaux Terrains -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Nouveaux Terrains</h3>
                    <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center">
                        <i class="fas fa-plus-circle text-green-600"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <span class="text-3xl font-bold mr-2">24</span>
                    <span class="text-green-500 flex items-center text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        18%
                    </span>
                </div>
                <p class="text-gray-400 text-sm mt-2">Ajoutés ce mois</p>
                <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                    <div class="bg-green-600 h-1 rounded-full" style="width: 35%"></div>
                </div>
            </div>
        </div>

        <!-- Detailed Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Graphique Utilisateurs -->
            <div class="col-span-1 lg:col-span-2 bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium">Évolution des Utilisateurs</h3>
                    <div class="flex space-x-2">
                        <button class="bg-gray-700 text-xs px-3 py-1 rounded hover:bg-gray-600">Mois</button>
                        <button class="bg-red-600 text-xs px-3 py-1 rounded">Année</button>
                    </div>
                </div>
                
                <div class="h-64 flex items-end space-x-2">
                    <div class="h-20 w-full bg-red-600/20 rounded-t-md hover:bg-red-600/40 transition-all"></div>
                    <div class="h-28 w-full bg-red-600/20 rounded-t-md hover:bg-red-600/40 transition-all"></div>
                    <div class="h-32 w-full bg-red-600/20 rounded-t-md hover:bg-red-600/40 transition-all"></div>
                    <div class="h-44 w-full bg-red-600/20 rounded-t-md hover:bg-red-600/40 transition-all"></div>
                    <div class="h-36 w-full bg-red-600/20 rounded-t-md hover:bg-red-600/40 transition-all"></div>
                    <div class="h-48 w-full bg-red-600/20 rounded-t-md hover:bg-red-600/40 transition-all"></div>
                    <div class="h-40 w-full bg-red-600/20 rounded-t-md hover:bg-red-600/40 transition-all"></div>
                    <div class="h-56 w-full bg-red-600/30 rounded-t-md hover:bg-red-600/50 transition-all"></div>
                    <div class="h-52 w-full bg-red-600/30 rounded-t-md hover:bg-red-600/50 transition-all"></div>
                    <div class="h-60 w-full bg-red-600 rounded-t-md hover:bg-red-600/90 transition-all"></div>
                </div>
                
                <div class="flex justify-between mt-2 text-xs text-gray-400">
                    <div>Jan</div>
                    <div>Fév</div>
                    <div>Mar</div>
                    <div>Avr</div>
                    <div>Mai</div>
                    <div>Juin</div>
                    <div>Juil</div>
                    <div>Août</div>
                    <div>Sep</div>
                    <div>Oct</div>
                </div>
            </div>

            <!-- Liste des derniers terrains ajoutés -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium">Nouveaux Terrains</h3>
                    <button class="text-xs text-red-600">Voir tout</button>
                </div>
                
                <div class="space-y-4">
                    <div class="bg-gray-700/30 rounded-lg p-3 hover:bg-gray-700/50 transition-all">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-md bg-green-600/20 flex items-center justify-center mr-3">
                                    <i class="fas fa-futbol text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium">Stade Municipal</h4>
                                    <p class="text-xs text-gray-400">Paris, France</p>
                                </div>
                            </div>
                            <div class="text-xs bg-green-600/20 text-green-600 px-2 py-1 rounded">Nouveau</div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700/30 rounded-lg p-3 hover:bg-gray-700/50 transition-all">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-md bg-green-600/20 flex items-center justify-center mr-3">
                                    <i class="fas fa-futbol text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium">Terrain Saint Michel</h4>
                                    <p class="text-xs text-gray-400">Lyon, France</p>
                                </div>
                            </div>
                            <div class="text-xs bg-green-600/20 text-green-600 px-2 py-1 rounded">Nouveau</div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700/30 rounded-lg p-3 hover:bg-gray-700/50 transition-all">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-md bg-green-600/20 flex items-center justify-center mr-3">
                                    <i class="fas fa-futbol text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium">Complexe Sportif</h4>
                                    <p class="text-xs text-gray-400">Marseille, France</p>
                                </div>
                            </div>
                            <div class="text-xs bg-green-600/20 text-green-600 px-2 py-1 rounded">Nouveau</div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700/30 rounded-lg p-3 hover:bg-gray-700/50 transition-all">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-md bg-blue-600/20 flex items-center justify-center mr-3">
                                    <i class="fas fa-futbol text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium">Stade Victor Hugo</h4>
                                    <p class="text-xs text-gray-400">Nice, France</p>
                                </div>
                            </div>
                            <div class="text-xs bg-blue-600/20 text-blue-500 px-2 py-1 rounded">Standard</div>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex justify-center">
                        <button class="bg-red-600 text-white px-4 py-2 rounded-full text-sm font-bold flex items-center">
                            <i class="fas fa-plus mr-2"></i> Ajouter un terrain
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistiques des Terrains - Partie ajoutée -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
            <!-- Terrains par Taux de Réservation -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Terrains par Taux de Réservation</h3>
                    <div class="w-10 h-10 rounded-full bg-red-600/20 flex items-center justify-center">
                        <i class="fas fa-calendar-check text-red-600"></i>
                    </div>
                </div>
                
                <!-- Graphique à barres horizontales -->
                <div class="mt-4 space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-300">Plus de 10 réservations</span>
                            <span class="font-medium text-red-500">35 terrains</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-red-600 rounded-full" style="width: 16%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-300">5 à 10 réservations</span>
                            <span class="font-medium text-red-400">72 terrains</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-red-500 rounded-full" style="width: 33%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-300">1 à 4 réservations</span>
                            <span class="font-medium text-red-300">81 terrains</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-red-400 rounded-full" style="width: 38%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-300">Aucune réservation</span>
                            <span class="font-medium text-gray-400">28 terrains</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gray-500 rounded-full" style="width: 13%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-gray-700/30 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-arrow-trend-up text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-white">107 terrains dépassent 5 réservations</h4>
                            <p class="text-sm text-gray-400">Soit 49.5% de l'ensemble des terrains</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button class="w-full bg-gray-700 text-white py-2 rounded-md hover:bg-gray-600 transition-all text-sm font-medium flex items-center justify-center">
                        <i class="fas fa-chart-line mr-2"></i>
                        Voir l'évolution dans le temps
                    </button>
                </div>
            </div>
            
            <!-- Répartition par Ville -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Répartition des Terrains par Ville</h3>
                    <div class="w-10 h-10 rounded-full bg-blue-600/20 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div class="bg-gray-700/30 p-4 rounded-lg hover:bg-gray-700/50 transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium text-white">Paris</h4>
                                <p class="text-2xl font-bold">42</p>
                            </div>
                            <div class="px-2 py-1 bg-red-600/20 text-red-400 rounded text-xs">
                                19.4%
                            </div>
                        </div>
                        <div class="mt-2 h-1 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-red-600 rounded-full" style="width: 19.4%"></div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700/30 p-4 rounded-lg hover:bg-gray-700/50 transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium text-white">Lyon</h4>
                                <p class="text-2xl font-bold">28</p>
                            </div>
                            <div class="px-2 py-1 bg-blue-600/20 text-blue-400 rounded text-xs">
                                13.0%
                            </div>
                        </div>
                        <div class="mt-2 h-1 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 rounded-full" style="width: 13.0%"></div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700/30 p-4 rounded-lg hover:bg-gray-700/50 transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium text-white">Marseille</h4>
                                <p class="text-2xl font-bold">23</p>
                            </div>
                            <div class="px-2 py-1 bg-green-600/20 text-green-400 rounded text-xs">
                                10.6%
                            </div>
                        </div>
                        <div class="mt-2 h-1 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-green-600 rounded-full" style="width: 10.6%"></div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700/30 p-4 rounded-lg hover:bg-gray-700/50 transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium text-white">Nice</h4>
                                <p class="text-2xl font-bold">18</p>
                            </div>
                            <div class="px-2 py-1 bg-purple-600/20 text-purple-400 rounded text-xs">
                                8.3%
                            </div>
                        </div>
                        <div class="mt-2 h-1 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-purple-600 rounded-full" style="width: 8.3%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-3">
                    <div class="bg-gray-700/20 p-2 rounded text-center">
                        <p class="text-sm text-gray-400">Bordeaux</p>
                        <p class="font-medium">14</p>
                    </div>
                    <div class="bg-gray-700/20 p-2 rounded text-center">
                        <p class="text-sm text-gray-400">Toulouse</p>
                        <p class="font-medium">12</p>
                    </div>
                    <div class="bg-gray-700/20 p-2 rounded text-center">
                        <p class="text-sm text-gray-400">Lille</p>
                        <p class="font-medium">11</p>
                    </div>
                    <div class="bg-gray-700/20 p-2 rounded text-center">
                        <p class="text-sm text-gray-400">Strasbourg</p>
                        <p class="font-medium">9</p>
                    </div>
                    <div class="bg-gray-700/20 p-2 rounded text-center">
                        <p class="text-sm text-gray-400">Nantes</p>
                        <p class="font-medium">8</p>
                    </div>
                    <div class="bg-gray-700/20 p-2 rounded text-center">
                        <p class="text-sm text-gray-400">Autres</p>
                        <p class="font-medium">51</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition-all text-sm font-medium flex items-center justify-center">
                        <i class="fas fa-list-ul mr-2"></i>
                        Afficher toutes les villes
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <button class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-all flex items-center">
                <i class="fas fa-file-export mr-2"></i>
                Exporter les statistiques
            </button>
            <button class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all flex items-center">
                <i class="fas fa-sync-alt mr-2"></i>
                Actualiser les données
            </button>
            <button class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all flex items-center">
                <i class="fas fa-cog mr-2"></i>
                Paramètres
            </button>
        </div>
    </div>
    
  
@endsection