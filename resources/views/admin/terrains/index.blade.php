@extends('Layout.dashboard')
@section('title', 'Gestion des Terrains')
@section('content')

<div class="container mx-auto px-2 py-4 mt-[4rem] text-gray-800 bg-rose-50">
    <!-- Header with title and filter controls -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-0">Gestion des Terrains</h1>

        <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
            <div class="relative w-full sm:w-[14rem]">
                <select id="city" onchange="cityFilter()" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-[#580a21] focus:ring focus:ring-[#580a21] focus:ring-opacity-20 bg-white">
                    <option value="">Toutes les villes</option>
                 
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>

            <div class="relative w-full sm:w-44">
                <select id="approval" onchange="approvalFilter()" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-[#580a21] focus:ring focus:ring-[#580a21] focus:ring-opacity-20 bg-white">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente">En attente</option>
                    <option value="approuve">Approuvé</option>
                    <option value="rejete">Rejeté</option>
                    <option value="suspended">Suspendu</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>

            <a onclick="clearFilter()" class="bg-[#580a21] cursor-pointer hover:bg-[#420718] text-white font-bold py-2 px-4 rounded-lg transition duration-300 w-full sm:w-auto text-center">
                <i class="fas fa-undo mr-1.5"></i> Reset
            </a>
        </div>
    </div>

    @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

    <script>
        // Make the message disappear after 2 seconds
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

    <!-- Mobile view (visible only on small screens) -->
    <div class="block md:hidden" id="mobile-terrains-container">
        <div class="space-y-4">
            @forelse($terrains as $terrain)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $terrain->name }}</h3>
                        <p class="text-sm text-gray-600 truncate">{{ \Illuminate\Support\Str::limit($terrain->description, 50) ?? 'Aucune description' }}</p>
                    </div>
                    <a href="{{ route('admin.terrain.show', $terrain->id) }}" class="text-[#580a21] hover:text-[#420718]">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-2 text-sm mt-3">
                    <div>
                        <p class="text-gray-500">Propriétaire:</p>
                        <p class="font-medium">{{ $terrain->proprietaire->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Ville:</p>
                        <p class="font-medium">{{ $terrain->city }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Prix:</p>
                        <p class="font-medium">{{ number_format($terrain->price, 2) }} MAD</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Statut:</p>
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded mt-1
                            {{ $terrain->status === 'disponible' ? 'bg-emerald-500 text-white' : 
                            ($terrain->status === 'occupé' ? 'bg-rose-500 text-white' : 
                            ($terrain->status === 'maintenance' ? 'bg-amber-500 text-white' : 
                            'bg-blue-500 text-white')) }}">
                            {{ $terrain->status === 'disponible' ? 'Disponible' : 
                            ($terrain->status === 'occupé' ? 'Occupé' : 
                            ($terrain->status === 'maintenance' ? 'Maintenance' : 'En attente')) }}
                        </span>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-gray-100">
                    <p class="text-gray-500 text-sm mb-2">Approbation:</p>
                    <form action="{{ route('admin.terrains.update-approval', $terrain->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="admin_approval" onchange="this.form.submit()" class="w-full text-xs font-semibold rounded border-0 px-2 py-2
                            {{ $terrain->admin_approval === 'approuve' ? 'bg-emerald-700 text-white' : 
                            ($terrain->admin_approval === 'rejete' ? 'bg-red-600 text-white' : 
                            ($terrain->admin_approval === 'suspended' ? 'bg-violet-600 text-white' : 
                            'bg-[#580a21] text-white')) }}">
                            @if ($terrain->admin_approval === 'en_attente')
                            <option value="en_attente" {{ $terrain->admin_approval === 'en_attente' ? 'selected' : '' }}>En attente</option>
                            @endif
                            <option value="approuve" {{ $terrain->admin_approval === 'approuve' ? 'selected' : '' }}>Approuvé</option>
                            <option value="rejete" {{ $terrain->admin_approval === 'rejete' ? 'selected' : '' }}>Rejeté</option>
                            <option value="suspended" {{ $terrain->admin_approval === 'suspended' ? 'selected' : '' }}>Suspendu</option>
                        </select>
                    </form>
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
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
                <tbody id="desktop-terrains-container" class="bg-white divide-y divide-gray-200">
                    @forelse($terrains as $terrain)
                    <tr class="hover:bg-rose-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $terrain->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-0">
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
                            <span class="px-2 py-1 text-xs font-semibold rounded
                                {{ $terrain->status === 'disponible' ? 'bg-emerald-500 text-white' : 
                                ($terrain->status === 'occupé' ? 'bg-rose-500 text-white' : 
                                ($terrain->status === 'maintenance' ? 'bg-amber-500 text-white' : 
                                'bg-blue-500 text-white')) }}">
                                {{ $terrain->status === 'disponible' ? 'Disponible' : 
                                ($terrain->status === 'occupé' ? 'Occupé' : 
                                ($terrain->status === 'maintenance' ? 'Maintenance' : 'En attente')) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.terrains.update-approval', $terrain->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="admin_approval" onchange="this.form.submit()" class="text-xs font-semibold rounded border-0 px-2 py-1
                                    {{ $terrain->admin_approval === 'approuve' ? 'bg-emerald-700 text-white' : 
                                    ($terrain->admin_approval === 'rejete' ? 'bg-red-600 text-white' : 
                                    ($terrain->admin_approval === 'suspended' ? 'bg-violet-600 text-white' : 
                                    'bg-[#580a21] text-white')) }}">
                                    @if ($terrain->admin_approval === 'en_attente')
                                    <option value="en_attente" {{ $terrain->admin_approval === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    @endif
                                    <option value="approuve" {{ $terrain->admin_approval === 'approuve' ? 'selected' : '' }}>Approuvé</option>
                                    <option value="rejete" {{ $terrain->admin_approval === 'rejete' ? 'selected' : '' }}>Rejeté</option>
                                    <option value="suspended" {{ $terrain->admin_approval === 'suspended' ? 'selected' : '' }}>Suspendu</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.terrain.show', $terrain->id) }}" class="text-[#580a21] hover:text-[#420718]">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                            Aucun terrain trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination (if necessary) -->
    @if($terrains instanceof \Illuminate\Pagination\LengthAwarePaginator && $terrains->hasPages())
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

<script>
    const selectCity = document.getElementById('city');
    const selectApproval = document.getElementById('approval');
    const mobileContainer = document.getElementById('mobile-terrains-container');
    const desktopContainer = document.getElementById('desktop-terrains-container');
    const paginationContainer = document.getElementById('pagination-container');

    function cityFilter() {
        selectApproval.value = '';
        let cityValue = selectCity.value;
        let typeFilter = 'city';
        fetchData(typeFilter, cityValue);
    }

    function approvalFilter() {
        selectCity.value = '';
        let approvalValue = selectApproval.value;
        let typeFilter = 'approval';
        fetchData(typeFilter, approvalValue);
    }

    function clearFilter() {
        selectCity.value = '';
        selectApproval.value = '';
        fetchData('clear', 'clear');
    }

    function fetchData(typeFilter, filterValue) {
        fetch(`/terrains/filter/${typeFilter}/${filterValue}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => {
                if (!response.ok) throw new Error('Erreur réseau');
                return response.json();
            })
            .then(data => {
                if (Array.isArray(data)) {
                    updateMobileContainer(data);
                    updateDesktopContainer(data);
                } else if (data.terrains) {
                    updateTerrainsContainers(data);
                } else {
                    showNoTerrainMessage();
                }
            })
            .catch(error => {
                console.error("Erreur:", error);
                showErrorMessage();
            });
    }

    function updateTerrainsContainers(data) {
        updateMobileContainer(data.terrains || []);
        updateDesktopContainer(data.terrains || []);

        if (data.pagination) {
            document.getElementById('pagination-container').innerHTML = data.pagination;
        } else if (document.getElementById('pagination-container')) {
            document.getElementById('pagination-container').innerHTML = '';
        }
    }

    function showNoTerrainMessage() {
        mobileContainer.innerHTML = `
        <div class="bg-white rounded-xl shadow-md p-6 text-center text-gray-500">
            Aucun terrain ne correspond à vos critères.
        </div>
    `;
        desktopContainer.innerHTML = `
        <tr>
            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                Aucun terrain ne correspond à vos critères.
            </td>
        </tr>
    `;
    }

    function showErrorMessage() {
        mobileContainer.innerHTML = `
        <div class="bg-red-100 rounded-xl shadow-md p-6 text-center text-red-500">
            Une erreur est survenue lors du filtrage. Veuillez réessayer.
        </div>
    `;
        desktopContainer.innerHTML = `
        <tr>
            <td colspan="8" class="px-6 py-4 text-center text-sm text-red-500">
                Une erreur est survenue lors du filtrage. Veuillez réessayer.
            </td>
        </tr>
    `;
    }

    function updateMobileContainer(terrains) {
        if (!terrains || !Array.isArray(terrains) || terrains.length === 0) {
            showNoTerrainMessage();
            return;
        }

        let html = '<div class="space-y-4">';

        terrains.forEach(terrain => {
            if (!terrain) return;

            let statusClass = 'bg-blue-500 text-white';
            let statusText = 'En attente';

            if (terrain.status === 'disponible') {
                statusClass = 'bg-emerald-500 text-white';
                statusText = 'Disponible';
            } else if (terrain.status === 'occupé') {
                statusClass = 'bg-rose-500 text-white';
                statusText = 'Occupé';
            } else if (terrain.status === 'maintenance') {
                statusClass = 'bg-amber-500 text-white';
                statusText = 'Maintenance';
            }

            let approvalClass = 'bg-[#580a21] text-white';
            if (terrain.admin_approval === 'approuve') {
                approvalClass = 'bg-emerald-700 text-white';
            } else if (terrain.admin_approval === 'rejete') {
                approvalClass = 'bg-red-600 text-white';
            } else if (terrain.admin_approval === 'suspended') {
                approvalClass = 'bg-violet-600 text-white';
            }

            html += `
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="font-semibold text-gray-800">${terrain.name}</h3>
                        <p class="text-sm text-gray-600 truncate">${terrain.description ? terrain.description.substring(0, 50) : 'Aucune description'}</p>
                    </div>
                    <a href="/admin/terrain/${terrain.id}" class="text-[#580a21] hover:text-[#420718]">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-2 gap-2 text-sm mt-3">
                    <div>
                        <p class="text-gray-500">Propriétaire:</p>
                        <p class="font-medium">${terrain.proprietaire ? terrain.proprietaire.name : 'N/A'}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Ville:</p>
                        <p class="font-medium">${terrain.city}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Prix:</p>
                        <p class="font-medium">${parseFloat(terrain.price).toLocaleString('fr-FR', {minimumFractionDigits: 2, maximumFractionDigits: 2})} MAD</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Statut:</p>
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded mt-1 ${statusClass}">
                            ${statusText}
                        </span>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-t border-gray-100">
                    <p class="text-gray-500 text-sm mb-2">Approbation:</p>
                    <form action="/admin/terrains/update-approval/${terrain.id}" method="POST">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="PATCH">
                        <select name="admin_approval" onchange="this.form.submit()" class="w-full text-xs font-semibold rounded border-0 px-2 py-2 ${approvalClass}">
                            ${terrain.admin_approval === 'en_attente' ? '<option value="en_attente" selected>En attente</option>' : ''}
                            <option value="approuve" ${terrain.admin_approval === 'approuve' ? 'selected' : ''}>Approuvé</option>
                            <option value="rejete" ${terrain.admin_approval === 'rejete' ? 'selected' : ''}>Rejeté</option>
                            <option value="suspended" ${terrain.admin_approval === 'suspended' ? 'selected' : ''}>Suspendu</option>
                        </select>
                    </form>
                </div>
            </div>
        `;
        });

        html += '</div>';
        mobileContainer.innerHTML = html;
    }

    function updateDesktopContainer(terrains) {
        if (!terrains || !Array.isArray(terrains) || terrains.length === 0) {
            showNoTerrainMessage();
            return;
        }

        let html = '';

        terrains.forEach(terrain => {
            if (!terrain) return;

            let statusClass = 'bg-blue-500 text-white';
            let statusText = 'En attente';

            if (terrain.status === 'disponible') {
                statusClass = 'bg-emerald-500 text-white';
                statusText = 'Disponible';
            } else if (terrain.status === 'occupé') {
                statusClass = 'bg-rose-500 text-white';
                statusText = 'Occupé';
            } else if (terrain.status === 'maintenance') {
                statusClass = 'bg-amber-500 text-white';
                statusText = 'Maintenance';
            }

            let approvalClass = 'bg-[#580a21] text-white';
            if (terrain.admin_approval === 'approuve') {
                approvalClass = 'bg-emerald-700 text-white';
            } else if (terrain.admin_approval === 'rejete') {
                approvalClass = 'bg-red-600 text-white';
            } else if (terrain.admin_approval === 'suspended') {
                approvalClass = 'bg-violet-600 text-white';
            }

            html += `
            <tr class="hover:bg-rose-50 transition-colors duration-200">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    ${terrain.id}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="ml-0">
                            <div class="text-sm font-medium text-gray-800">
                                ${terrain.name}
                            </div>
                            <div class="text-sm text-gray-600 truncate max-w-xs">
                                ${terrain.description ? terrain.description.substring(0, 50) : 'Aucune description'}
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    ${terrain.proprietaire ? terrain.proprietaire.name : 'N/A'}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    ${terrain.city}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    ${parseFloat(terrain.price).toLocaleString('fr-FR', {minimumFractionDigits: 2, maximumFractionDigits: 2})} MAD
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-semibold rounded ${statusClass}">
                        ${statusText}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="/admin/terrains/update-approval/${terrain.id}" method="POST">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="PATCH">
                        <select name="admin_approval" onchange="this.form.submit()" class="text-xs font-semibold rounded border-0 px-2 py-1 ${approvalClass}">
                            ${terrain.admin_approval === 'en_attente' ? '<option value="en_attente" selected>En attente</option>' : ''}
                            <option value="approuve" ${terrain.admin_approval === 'approuve' ? 'selected' : ''}>Approuvé</option>
                            <option value="rejete" ${terrain.admin_approval === 'rejete' ? 'selected' : ''}>Rejeté</option>
                            <option value="suspended" ${terrain.admin_approval === 'suspended' ? 'selected' : ''}>Suspendu</option>
                        </select>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <div class="flex justify-end space-x-2">
                        <a href="/admin/terrain/${terrain.id}" class="text-[#580a21] hover:text-[#420718]">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
        `;
        });

        desktopContainer.innerHTML = html;
    }
</script>

<script src="{{ asset('js/morrocaineCities.js') }}"></script>
@endsection