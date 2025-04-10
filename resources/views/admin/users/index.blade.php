@extends('Layout.dashboard')
@section('title', 'Gestion des Utilisateurs')
@section('content')

<div class="container mx-auto px-4 py-8 mt-[4rem] text-gray-300">
    <!-- En-tête avec titre et boutons d'action -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Gestion des Utilisateurs</h1>
    </div>

    <!-- Filtres et recherche -->
    <div class="bg-gray-900 rounded-lg shadow-md p-4 mb-6 border border-gray-700">
        <div class="flex flex-wrap justify-between gap-4">
            <div class="flex items-center">
                <div class="relative">
                    <input type="text" placeholder="Rechercher un utilisateur..." 
                           class="bg-gray-800 border border-gray-700 rounded-lg pl-10 pr-4 py-2 w-64 text-white">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <!-- Filtre par Rôle -->
                <select class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    <option value="">Tous les Rôles</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Modérateur</option>
                    <option value="3">Utilisateur</option>
                </select>

                <!-- Filtre par Statut -->
                <select class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    <option value="">Tous les Statuts</option>
                    <option value="active">Actif</option>
                    <option value="pending">En attente</option>
                    <option value="suspended">Suspendu</option>
                </select>

                <!-- Filtre par Ville -->
                <select class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
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
    <div class="bg-gray-900 rounded-lg shadow-md overflow-hidden border border-gray-700">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Utilisateur
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Ville
                    </th>
                    
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Rôle
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Statut
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Créé le
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-gray-900 divide-y divide-gray-800">
                @forelse($users as $user)
                <tr class="hover:bg-gray-800 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $user->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full object-cover"
                                src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('assets/img/Profile.png') }}" 
                                alt="Photo de profil">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-white">
                                    {{ $user->name }}
                                </div>
                                <div class="text-sm text-gray-400 truncate max-w-xs">
                                    {{ $user->bio ?? 'Aucune biographie' }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $user->city }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $user->role->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('admin.users.update-status', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded border-0 px-2 py-1
                                {{ $user->status === 'active' ? 'bg-emerald-600 text-white' : 
                                ($user->status === 'pending' ? 'bg-amber-500 text-white' : 
                                'bg-rose-600 text-white') }}">
                                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Actif</option>
                                @if ($user->status === 'pending')
                                    <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                @endif
                                <option value="suspended" {{ $user->status === 'suspended' ? 'selected' : '' }}>Suspendu</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $user->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.users.detailsUser', $user->id) }}">
                                <button type="submit" class="text-blue-400 hover:text-blue-300 transition-colors duration-150">
                                    <i class="fas fa-eye text-lg"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-400">
                        Aucun utilisateur trouvé.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Style pour les options du select en thème sombre */
    select option {
        background-color: #1f2937; /* bg-gray-800 */
        color: white;
    }
</style>

@endsection