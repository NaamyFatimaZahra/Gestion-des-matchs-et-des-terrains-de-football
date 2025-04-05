@extends('Layout.dashboard')
@section('title', 'Gestion des Utilisateurs')
@section('content')


    <div class="container mx-auto px-4 py-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Liste des utilisateurs</h1>
            <button class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Ajouter un utilisateur
            </button>
        </div>

        <!-- Filtres et recherche -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex flex-wrap justify-between gap-4">
                <div class="flex items-center">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher un utilisateur..." 
                               class="border border-gray-300 rounded-lg pl-10 pr-4 py-2 w-64">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div class="flex gap-3">
                    <!-- Filtre par Rôle -->
                    <select class="border border-gray-300 rounded-lg px-4 py-2">
                        <option value="">Tous les Rôles</option>
                        <option value="1">Administrateur</option>
                        <option value="2">Modérateur</option>
                        <option value="3">Utilisateur</option>
                    </select>

                    <!-- Filtre par Statut -->
                    <select class="border border-gray-300 rounded-lg px-4 py-2">
                        <option value="">Tous les Statuts</option>
                        <option value="active">Actif</option>
                        <option value="inactive">Inactif</option>
                        <option value="suspended">Suspendu</option>
                    </select>

                    <!-- Filtre par Ville -->
                    <select class="border border-gray-300 rounded-lg px-4 py-2">
                        <option value="">Toutes les Villes</option>
                        <option value="Paris">Paris</option>
                        <option value="Lyon">Lyon</option>
                        <option value="Marseille">Marseille</option>
                        <option value="Toulouse">Toulouse</option>
                        <option value="Nice">Nice</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tableau des utilisateurs -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Utilisateur <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Email <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Ville <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Rôle <i class="fas fa-sort ml-1"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Statut
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Utilisateur 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/40" alt="Utilisateur" class="h-10 w-10 rounded-full mr-3">
                                <div>
                                    <div class="font-medium text-gray-900">John Doe</div>
                                    <div class="text-sm text-gray-500">ID: #1234</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">john.doe@example.com</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Paris</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="border border-gray-300 rounded-lg px-2 py-1 text-sm">
                                <option selected>Administrateur</option>
                                <option>Modérateur</option>
                                <option>Utilisateur</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Actif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <button class="text-blue-600 hover:text-blue-900" title="Détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900" title="Désactiver">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Utilisateur 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/40" alt="Utilisateur" class="h-10 w-10 rounded-full mr-3">
                                <div>
                                    <div class="font-medium text-gray-900">Jane Smith</div>
                                    <div class="text-sm text-gray-500">ID: #5678</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">jane.smith@example.com</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Lyon</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="border border-gray-300 rounded-lg px-2 py-1 text-sm">
                                <option>Administrateur</option>
                                <option selected>Modérateur</option>
                                <option>Utilisateur</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Inactif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <button class="text-blue-600 hover:text-blue-900" title="Détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900" title="Activer">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Utilisateur 3 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/40" alt="Utilisateur" class="h-10 w-10 rounded-full mr-3">
                                <div>
                                    <div class="font-medium text-gray-900">Alice Martin</div>
                                    <div class="text-sm text-gray-500">ID: #9012</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">alice.martin@example.com</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Marseille</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="border border-gray-300 rounded-lg px-2 py-1 text-sm">
                                <option>Administrateur</option>
                                <option>Modérateur</option>
                                <option selected>Utilisateur</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Suspendu
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <button class="text-blue-600 hover:text-blue-900" title="Détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900" title="Réactiver">
                                    <i class="fas fa-user-check"></i>
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
                            Affichage de <span class="font-medium">1</span> à <span class="font-medium">3</span> sur <span class="font-medium">12</span> utilisateurs
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
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

       
    
    <!-- Modals pour les détails de l'utilisateur et actions supplémentaires -->
    
    <!-- Modal de détails de l'utilisateur -->
    <div id="user-details-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl relative">
            <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-900" onclick="closeModal()">
                <i class="fas fa-times text-2xl"></i>
            </button>
            
            <div class="flex items-center mb-6">
                <img src="/api/placeholder/120/120" alt="Utilisateur" class="w-32 h-32 rounded-full mr-6 border-4 border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">John Doe</h2>
                    <p class="text-gray-600">john.doe@example.com</p>
                    <div class="mt-2">
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Actif</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm ml-2">Utilisateur</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informations Personnelles</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nom Complet</label>
                            <p class="text-gray-900">John Doe</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date de Naissance</label>
                            <p class="text-gray-900">15 Janvier 1990</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <p class="text-gray-900">+33 6 12 34 56 78</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Activité du Compte</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Inscrit le</label>
                            <p class="text-gray-900">15 Mars 2024</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dernière Connexion</label>
                            <p class="text-gray-900">15 Mars 2025 à 14:30</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre de Connexions</label>
                            <p class="text-gray-900">42</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 border-t pt-4 flex justify-end space-x-3">
                <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Fermer
                </button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Éditer le Profil
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmation de Suspension -->
    <div id="suspend-user-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md text-center">
            <div class="mb-4">
                <i class="fas fa-exclamation-triangle text-5xl text-yellow-500"></i>
            </div>
            <h2 class="text-xl font-bold mb-4">Suspendre l'Utilisateur</h2>
            <p class="mb-6 text-gray-600">Êtes-vous sûr de vouloir suspendre le compte de John Doe ? Cette action peut être annulée ultérieurement.</p>
            
            <div class="flex justify-center space-x-4">
                <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Annuler
                </button>
                <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Confirmer la Suspension
                </button>
            </div>
        </div>
    </div>

    <!-- Script pour gérer les modals -->
    <script>
        function openUserDetailsModal(userId) {
            document.getElementById('user-details-modal').classList.remove('hidden');
        }

        function openSuspendUserModal(userId) {
            document.getElementById('suspend-user-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('user-details-modal').classList.add('hidden');
            document.getElementById('suspend-user-modal').classList.add('hidden');
        }
    </script>
</div>
@endsection