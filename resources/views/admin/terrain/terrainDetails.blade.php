<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du terrain</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex min-h-screen">
        <!-- Sidebar Left -->
        <div class="w-16 bg-gray-900 flex flex-col items-center py-4 border-r border-gray-800">
            <div class="mb-6 mt-2">
                <i class="fas fa-bars text-gray-400"></i>
            </div>
            <div class="flex flex-col space-y-6 items-center">
                <div class="sidebar-icon">
                    <i class="fas fa-chart-line text-gray-400"></i>
                </div>
                <div class="sidebar-icon">
                    <i class="fas fa-table-columns text-gray-400"></i>
                </div>
                <div class="sidebar-icon">
                    <i class="fas fa-heart text-gray-400"></i>
                </div>
                <div class="sidebar-icon bg-red-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-futbol text-white"></i>
                </div>
                <div class="sidebar-icon">
                    <i class="fas fa-basketball-ball text-gray-400"></i>
                </div>
                <div class="sidebar-icon">
                    <i class="fas fa-user text-gray-400"></i>
                </div>
                <div class="sidebar-icon">
                    <i class="fas fa-layer-group text-gray-400"></i>
                </div>
                <div class="sidebar-icon">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <div class="sidebar-icon">
                    <i class="fas fa-cog text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-800 p-6">
            <div class="max-w-5xl mx-auto">
                <!-- Header with actions -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <a href="#" class="bg-gray-700 rounded-full w-8 h-8 flex items-center justify-center mr-4">
                            <i class="fas fa-arrow-left text-gray-400"></i>
                        </a>
                        <h1 class="text-2xl font-bold">Détails du terrain</h1>
                    </div>
                    <div class="flex space-x-3">
                        <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm flex items-center">
                            <i class="fas fa-edit mr-2"></i> Modifier
                        </button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full text-sm flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i> Disponibilités
                        </button>
                    </div>
                </div>

                <!-- Terrain Details -->
                <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden mb-6">
                    <!-- Image Gallery -->
                    <div class="relative h-64 bg-gray-800">
                        <img src="/api/placeholder/800/400" alt="Photo du terrain" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="bg-red-600 text-white text-xs px-2 py-1 rounded">
                                Football
                            </span>
                        </div>
                        <div class="absolute bottom-4 right-4 flex space-x-2">
                            <button class="bg-gray-900 bg-opacity-70 rounded-full w-8 h-8 flex items-center justify-center">
                                <i class="fas fa-chevron-left text-white"></i>
                            </button>
                            <button class="bg-gray-900 bg-opacity-70 rounded-full w-8 h-8 flex items-center justify-center">
                                <i class="fas fa-chevron-right text-white"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Basic Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-xl font-bold">Terrain Olympique</h2>
                                <div class="flex items-center text-gray-400 text-sm mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>16 Avenue des Sports, 75001 Paris</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-bold text-red-500">45€<span class="text-sm text-gray-400">/heure</span></div>
                                <div class="text-sm text-gray-400 mt-1">Capacité: 22 joueurs</div>
                            </div>
                        </div>

                        <!-- Status Indicators -->
                        <div class="flex space-x-3 mb-6">
                            <div class="bg-green-900 bg-opacity-30 text-green-400 px-3 py-1 rounded-full text-xs flex items-center">
                                <i class="fas fa-check-circle mr-1"></i> Actif
                            </div>
                            <div class="bg-blue-900 bg-opacity-30 text-blue-400 px-3 py-1 rounded-full text-xs flex items-center">
                                <i class="fas fa-shield-alt mr-1"></i> Vérifié
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Description</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Terrain de football professionnel avec gazon synthétique de dernière génération. Idéal pour les matchs à 11 contre 11, ce terrain offre une expérience de jeu optimale quelles que soient les conditions météorologiques. Entièrement clôturé avec un système d'éclairage performant permettant des parties nocturnes.
                            </p>
                        </div>

                        <!-- Equipment and Services -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-3">Équipements et services</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                <div class="flex items-center text-gray-300 text-sm">
                                    <i class="fas fa-check text-green-500 mr-2"></i> Parking
                                </div>
                                <div class="flex items-center text-gray-300 text-sm">
                                    <i class="fas fa-check text-green-500 mr-2"></i> Vestiaires
                                </div>
                                <div class="flex items-center text-gray-300 text-sm">
                                    <i class="fas fa-check text-green-500 mr-2"></i> Douches
                                </div>
                                <div class="flex items-center text-gray-300 text-sm">
                                    <i class="fas fa-check text-green-500 mr-2"></i> Éclairage
                                </div>
                                <div class="flex items-center text-gray-300 text-sm">
                                    <i class="fas fa-check text-green-500 mr-2"></i> Cafétéria
                                </div>
                                <div class="flex items-center text-gray-300 text-sm">
                                    <i class="fas fa-check text-green-500 mr-2"></i> Wi-Fi
                                </div>
                            </div>
                        </div>

                        <!-- Availability -->
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Horaires d'ouverture</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center justify-between text-sm border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">Lundi</span>
                                    <span class="text-white">09:00 - 22:00</span>
                                </div>
                                <div class="flex items-center justify-between text-sm border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">Mardi</span>
                                    <span class="text-white">09:00 - 22:00</span>
                                </div>
                                <div class="flex items-center justify-between text-sm border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">Mercredi</span>
                                    <span class="text-white">09:00 - 22:00</span>
                                </div>
                                <div class="flex items-center justify-between text-sm border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">Jeudi</span>
                                    <span class="text-white">09:00 - 22:00</span>
                                </div>
                                <div class="flex items-center justify-between text-sm border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">Vendredi</span>
                                    <span class="text-white">09:00 - 23:00</span>
                                </div>
                                <div class="flex items-center justify-between text-sm border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">Samedi</span>
                                    <span class="text-white">08:00 - 23:00</span>
                                </div>
                                <div class="flex items-center justify-between text-sm border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">Dimanche</span>
                                    <span class="text-white">10:00 - 20:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Location -->
                <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden mb-6">
                    <div class="p-4 border-b border-gray-800 flex justify-between items-center">
                        <h3 class="font-semibold">Localisation</h3>
                        <a href="#" class="text-sm text-red-500 hover:text-red-400 flex items-center">
                            <i class="fas fa-external-link-alt mr-1"></i> Voir sur Google Maps
                        </a>
                    </div>
                    <div class="h-64 bg-gray-800 relative">
                        <img src="/api/placeholder/800/400" alt="Carte de localisation" class="w-full h-full object-cover">
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-4 border-b border-gray-800 flex justify-between items-center">
                        <h3 class="font-semibold">Réservations récentes</h3>
                        <a href="#" class="text-sm text-red-500 hover:text-red-400">Voir toutes</a>
                    </div>
                    <div class="p-4">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-xs text-gray-400 border-b border-gray-800">
                                        <th class="pb-3 font-medium">Date</th>
                                        <th class="pb-3 font-medium">Heure</th>
                                        <th class="pb-3 font-medium">Client</th>
                                        <th class="pb-3 font-medium">Statut</th>
                                        <th class="pb-3 font-medium">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-gray-800">
                                        <td class="py-3 text-sm">18/03/2025</td>
                                        <td class="py-3 text-sm">18:00 - 20:00</td>
                                        <td class="py-3 text-sm">Équipe FC Paris</td>
                                        <td class="py-3">
                                            <span class="bg-green-900 bg-opacity-30 text-green-400 px-2 py-1 rounded text-xs">
                                                Confirmé
                                            </span>
                                        </td>
                                        <td class="py-3 text-sm">90€</td>
                                    </tr>
                                    <tr class="border-b border-gray-800">
                                        <td class="py-3 text-sm">17/03/2025</td>
                                        <td class="py-3 text-sm">14:00 - 16:00</td>
                                        <td class="py-3 text-sm">Tournoi Junior</td>
                                        <td class="py-3">
                                            <span class="bg-blue-900 bg-opacity-30 text-blue-400 px-2 py-1 rounded text-xs">
                                                Terminé
                                            </span>
                                        </td>
                                        <td class="py-3 text-sm">90€</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 text-sm">16/03/2025</td>
                                        <td class="py-3 text-sm">10:00 - 12:00</td>
                                        <td class="py-3 text-sm">École de Football</td>
                                        <td class="py-3">
                                            <span class="bg-blue-900 bg-opacity-30 text-blue-400 px-2 py-1 rounded text-xs">
                                                Terminé
                                            </span>
                                        </td>
                                        <td class="py-3 text-sm">90€</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>