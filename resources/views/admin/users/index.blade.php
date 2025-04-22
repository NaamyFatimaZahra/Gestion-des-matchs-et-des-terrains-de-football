@extends('Layout.dashboard')
@section('title', 'Gestion des Utilisateurs')
@section('content')

<div class="container mx-auto px-4 py-8 mt-[4rem] text-gray-800">
    <!-- En-tête avec titre et boutons d'action -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestion des Utilisateurs</h1>
    </div>


    <!-- Tableau des utilisateurs -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#580a21]">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Utilisateur
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Ville
                    </th>
                    
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Rôle
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Statut
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Créé le
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-rose-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
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
                                <div class="text-sm font-medium text-gray-800">
                                    {{ $user->name }}
                                </div>
                                <div class="text-sm text-gray-600 truncate max-w-xs">
                                    {{ $user->bio ?? 'Aucune biographie' }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        {{ $user->city }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        {{ $user->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.users.detailsUser', $user->id) }}">
                                <button type="submit" class="text-[#580a21] hover:text-[#420718] transition-colors duration-150">
                                    <i class="fas fa-eye text-lg"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                        Aucun utilisateur trouvé.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Style pour les options du select en thème clair */
    select option {
        background-color: #fff1f2; /* bg-rose-50 */
        color: #1f2937; /* text-gray-800 */
    }
</style>

@endsection