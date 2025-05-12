@extends('Layout.dashboard')
@section('title', 'Gestion des Terrains')
@section('content')

<div class="container mx-auto px-2 py-4 mt-[4rem] text-gray-800 bg-rose-50">
    <!-- En-tête avec titre et boutons d'action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-0">Gestion des Terrains</h1>
        <a href="{{ route('proprietaire.terrain.create') }}" class="bg-[#580a21] hover:bg-[#420718] text-white px-4 py-2 rounded-lg transition-colors duration-200 w-full sm:w-auto flex items-center justify-center sm:justify-start">
            <i class="fas fa-plus mr-2"></i>Ajouter un terrain
        </a>
    </div>

    @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }
        }, 2000);
    </script>
    @endif

    <!-- Message d'erreur général -->
    @if(session('error'))
    <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
        <button type="button" class="absolute top-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
            <span class="sr-only">Fermer</span>
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Mobile view (visible only on small screens) -->
    <div class="block md:hidden" id="mobile-terrains-container">
        <div class="space-y-4">
            @forelse($terrains as $terrain)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $terrain->name }}</h3>
                        <p class="text-sm text-gray-600 truncate max-w-xs">{{ \Illuminate\Support\Str::limit($terrain->description, 50) ?? 'Aucune description' }}</p>
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Ville: {{ $terrain->city }}</p>
                            <p class="text-sm text-gray-600">Prix: {{ number_format($terrain->price, 2) }} MAD</p>
                            <p class="text-sm text-gray-600">Propriétaire: {{ $terrain->proprietaire->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-2 pt-2 border-t border-gray-100 flex flex-wrap justify-between items-center">
                    <div class="mb-2 w-full sm:w-auto">
                        <form action="{{ route('proprietaire.terrain.update-status', $terrain->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded border-0 px-2 py-1 mr-2
                                {{ $terrain->status === 'disponible' ? 'bg-emerald-500 text-white' : 
                                ($terrain->status === 'occupé' ? 'bg-red-600 text-white' : 
                                ($terrain->status === 'maintenance' ? 'bg-amber-500 text-white' : 
                                'bg-blue-500 text-white')) }}">
                                @if ($terrain->status === 'en_attente')
                                <option value="en_attente" {{ $terrain->status === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                @endif
                                <option value="disponible" {{ $terrain->status === 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="occupé" {{ $terrain->status === 'occupé' ? 'selected' : '' }}>Occupé</option>
                                <option value="maintenance" {{ $terrain->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </form>
                        <span class="px-2 py-1 text-xs font-semibold rounded
                            {{ $terrain->admin_approval === 'approuve' ? 'bg-emerald-500 text-white' : 
                            ($terrain->admin_approval === 'suspended' ? 'bg-violet-500 text-white' : 
                            ($terrain->admin_approval === 'rejete' ? 'bg-red-600 text-white' : 
                            'bg-gray-600 text-white')) }}">
                            {{ $terrain->admin_approval === 'rejete' ? 'Rejeté' : 
                            ($terrain->admin_approval === 'suspended' ? 'Suspendu' : 
                            ($terrain->admin_approval === 'approuve' ? 'Approuvé' : 'En attente')) }}
                        </span>
                    </div>
                    <div class="flex space-x-3 mt-2">
                        <a href="{{ route('proprietaire.terrain.show', $terrain->id) }}" class="text-[#580a21] hover:text-[#420718]" title="Voir détails">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('proprietaire.terrain.edit', $terrain->id) }}" class="text-[#580a21] hover:text-[#420718]" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('proprietaire.terrain.destroy', $terrain->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-700" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-md p-6 text-center text-gray-500">
                Aucun terrain trouvé.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Desktop view (visible only on large screens) -->
    <div class="hidden md:block bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#580a21]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-10 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Terrain
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Propriétaire
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Ville
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Prix
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Approbation
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($terrains as $terrain)
                    <tr class="hover:bg-rose-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $terrain->id }}
                        </td>
                        <td class="py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <!-- Image du terrain si disponible -->
                                </div>
                                <div class="">
                                    <div class="text-sm font-medium text-gray-800">
                                        {{ $terrain->name }}
                                    </div>
                                    <div class="text-sm text-gray-600 truncate max-w-xs">
                                        {{ \Illuminate\Support\Str::limit($terrain->description, 50) ?? 'Aucune description' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $terrain->proprietaire->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $terrain->city }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ number_format($terrain->price, 2) }} MAD
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('proprietaire.terrain.update-status', $terrain->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded border-0 px-2 py-1
                                    {{ $terrain->status === 'disponible' ? 'bg-emerald-500 text-white' : 
                                    ($terrain->status === 'occupé' ? 'bg-red-600 text-white' : 
                                    ($terrain->status === 'maintenance' ? 'bg-amber-500 text-white' : 
                                    'bg-blue-500 text-white')) }}">
                                    @if ($terrain->status === 'en_attente')
                                    <option value="en_attente" {{ $terrain->status === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    @endif
                                    <option value="disponible" {{ $terrain->status === 'disponible' ? 'selected' : '' }}>Disponible</option>
                                    <option value="occupé" {{ $terrain->status === 'occupé' ? 'selected' : '' }}>Occupé</option>
                                    <option value="maintenance" {{ $terrain->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded
                                {{ $terrain->admin_approval === 'approuve' ? 'bg-emerald-500 text-white' : 
                                ($terrain->admin_approval === 'suspended' ? 'bg-violet-500 text-white' : 
                                ($terrain->admin_approval === 'rejete' ? 'bg-red-600 text-white' : 
                                'bg-gray-600 text-white')) }}">
                                {{ $terrain->admin_approval === 'rejete' ? 'Rejeté' : 
                                ($terrain->admin_approval === 'suspended' ? 'Suspendu' : 
                                ($terrain->admin_approval === 'approuve' ? 'Approuvé' : 'En attente')) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('proprietaire.terrain.show', $terrain->id) }}" class="text-[#580a21] hover:text-[#420718]" title="Voir détails">
                                    <i class="fas fa-eye text-lg"></i>
                                </a>
                                <a href="{{ route('proprietaire.terrain.edit', $terrain->id) }}" class="text-[#580a21] hover:text-[#420718]" title="Modifier">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('proprietaire.terrain.destroy', $terrain->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-700" title="Supprimer">
                                        <i class="fas fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                            <div class="flex flex-col items-center py-6">
                                <svg class="w-12 h-12 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p>Aucun terrain trouvé.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination (si nécessaire) -->
    @if(isset($terrains) && $terrains instanceof \Illuminate\Pagination\LengthAwarePaginator && $terrains->hasPages())
    <div class="mt-6 px-2" id="pagination-container">
        <nav class="flex items-center justify-between bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-4">
            <div class="flex-1 flex justify-between sm:hidden">
                @if($terrains->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                    Précédent
                </span>
                @else
                <a href="{{ $terrains->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
                    Précédent
                </a>
                @endif

                @if($terrains->hasMorePages())
                <a href="{{ $terrains->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
                    Suivant
                </a>
                @else
                <span class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                    Suivant
                </span>
                @endif
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Affichage de <span class="font-medium">{{ $terrains->firstItem() }}</span> à <span class="font-medium">{{ $terrains->lastItem() }}</span> sur <span class="font-medium">{{ $terrains->total() }}</span> terrains
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                        {{-- Previous page link --}}
                        @if($terrains->onFirstPage())
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md">
                            <span class="sr-only">Précédent</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        @else
                        <a href="{{ $terrains->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-l-md hover:bg-rose-50">
                            <span class="sr-only">Précédent</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @endif

                        {{-- Pagination links --}}
                        @foreach($terrains->getUrlRange(1, $terrains->lastPage()) as $page => $url)
                        @if($page == $terrains->currentPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#580a21] border border-[#580a21]">
                            {{ $page }}
                        </span>
                        @else
                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-rose-50 hover:text-[#580a21]">
                            {{ $page }}
                        </a>
                        @endif
                        @endforeach

                        {{-- Next page link --}}
                        @if($terrains->hasMorePages())
                        <a href="{{ $terrains->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-r-md hover:bg-rose-50">
                            <span class="sr-only">Suivant</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @else
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-r-md">
                            <span class="sr-only">Suivant</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        @endif
                    </span>
                </div>
            </div>
        </nav>
    </div>
    @endif
</div>

@endsection