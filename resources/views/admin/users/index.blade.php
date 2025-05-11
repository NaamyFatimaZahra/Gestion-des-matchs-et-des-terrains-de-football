@extends('Layout.dashboard')
@section('title', 'Gestion des Utilisateurs')
@section('content')

<div class="container mx-auto px-2 py-4 mt-[4rem] text-gray-800 bg-rose-50">


    <!-- En-tête avec titre et boutons d'action -->
    <div class="flex flex-col sm:flex-row justify-between items-center md:items-start sm:items-center mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-0">Gestion des Utilisateurs</h1>

        <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
            <div class="relative w-full sm:w-44">
                <select id="role" onchange="roleFilter()" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-[#580a21] focus:ring focus:ring-[#580a21] focus:ring-opacity-20 bg-white">
                    <option value="">Tous les rôles</option>
                    <option value="3">Joueur</option>
                    <option value="2">Proprietaire</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>

            <div class="relative w-full sm:w-44">
                <select id="status" onchange="statusFilter()" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-[#580a21] focus:ring focus:ring-[#580a21] focus:ring-opacity-20 bg-white">
                    <option value="">Tous les statuts</option>
                    <option value="active">Actif</option>
                    <option value="pending">En attente</option>
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


    <!-- Mobile view (visible only on small screens) -->
    <div class="block md:hidden" id="mobile-users-container">
        <div class="space-y-4">
            @forelse($users as $user)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-4">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full object-cover"
                                src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('assets/img/Profile.png') }}"
                                alt="Photo de profil">
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $user->role->name }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.detailsUser', $user->id) }}" class="text-[#580a21] hover:text-[#420718]">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-2 text-sm mt-3">
                    <div>
                        <p class="text-gray-500">Email:</p>
                        <p class="font-medium truncate">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Ville:</p>
                        <p class="font-medium">{{ $user->city }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Inscrit le:</p>
                        <p class="font-medium">{{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Statut:</p>
                        <form action="{{ route('admin.users.update-status', $user->id) }}" method="POST" class="mt-1">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="w-full text-xs font-semibold rounded border-0 px-2 py-1
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
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-md p-6 text-center text-gray-500">
                Aucun utilisateur trouvé.
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
                <tbody id="desktop-users-container" class="bg-white divide-y divide-gray-200">
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

    <!-- Pagination (if necessary) -->
    @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->hasPages())
    <div class="mt-6 px-2" id="pagination-container">
        <nav class="flex items-center justify-between bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-4">
            <div class="flex-1 flex justify-between sm:hidden">
                @if($users->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                    Précédent
                </span>
                @else
                <a href="{{ $users->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
                    Précédent
                </a>
                @endif

                @if($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
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
                        Affichage de <span class="font-medium">{{ $users->firstItem() }}</span> à <span class="font-medium">{{ $users->lastItem() }}</span> sur <span class="font-medium">{{ $users->total() }}</span> utilisateurs
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                        {{-- Previous page link --}}
                        @if($users->onFirstPage())
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md">
                            <span class="sr-only">Précédent</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        @else
                        <a href="{{ $users->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-l-md hover:bg-rose-50">
                            <span class="sr-only">Précédent</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @endif

                        {{-- Pagination links --}}
                        @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if($page == $users->currentPage())
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
                        @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-r-md hover:bg-rose-50">
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

<style>
    /* Style for select options in light theme */
    select option {
        background-color: #fff1f2;
        /* bg-rose-50 */
        color: #1f2937;
        /* text-gray-800 */
    }
</style>

<script>
    const selectRole = document.getElementById('role');
    const selectStatus = document.getElementById('status');
    const mobileContainer = document.getElementById('mobile-users-container');
    const desktopContainer = document.getElementById('desktop-users-container');
    const paginationContainer = document.getElementById('pagination-container');

    function roleFilter() {
        selectStatus.value = '';
        let roleValue = selectRole.value;
        let typeFilter = 'role';
        fetchData(typeFilter, roleValue);
    }

    function statusFilter() {
        selectRole.value = '';
        let statusValue = selectStatus.value;
        let typeFilter = 'status';
        fetchData(typeFilter, statusValue);
    }

    function clearFilter() {
        selectRole.value = '';
        selectStatus.value = '';
        fetchData('clear', 'clear');
    }

    function fetchData(typeFilter, filterValue) {
        fetch(`/admin/users/filter/${typeFilter}/${filterValue}`, {
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
                // Check which structure is received and adapt accordingly
                if (Array.isArray(data)) {
                    // If it's an array directly
                    updateMobileContainer(data);
                    updateDesktopContainer(data);
                } else if (data.users) {
                    // If it's an object with a 'users' property
                    updateUsersContainers(data);
                } else {
                    // If no structure is recognized, show an error message
                    showNoUsersMessage();
                }
            })
            .catch(error => {
                console.error("Erreur:", error);
                showErrorMessage();
            });
    }

    function updateUsersContainers(data) {
        // Update mobile view
        updateMobileContainer(data.users || []);

        // Update desktop view
        updateDesktopContainer(data.users || []);

        // Update pagination if necessary
        if (data.pagination) {
            document.getElementById('pagination-container').innerHTML = data.pagination;
        } else if (document.getElementById('pagination-container')) {
            document.getElementById('pagination-container').innerHTML = '';
        }
    }

    function showNoUsersMessage() {
        mobileContainer.innerHTML = `
            <div class="bg-white rounded-xl shadow-md p-6 text-center text-gray-500">
                Aucun utilisateur ne correspond à vos critères.
            </div>
        `;
        desktopContainer.innerHTML = `
            <tr>
                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                    Aucun utilisateur ne correspond à vos critères.
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

    function updateMobileContainer(users) {
        // Add a check to ensure users is an array
        if (!users || !Array.isArray(users) || users.length === 0) {
            showNoUsersMessage();
            return;
        }

        let html = '<div class="space-y-4">';

        users.forEach(user => {
            // Check that user is indeed an object
            if (!user) return;

            let statusClass = 'bg-rose-600 text-white';
            let statusText = 'Suspendu';

            if (user.status === 'active') {
                statusClass = 'bg-emerald-600 text-white';
                statusText = 'Actif';
            } else if (user.status === 'pending') {
                statusClass = 'bg-amber-500 text-white';
                statusText = 'En attente';
            }

            html += `
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="${user.profile_picture ? user.profile_picture : '/assets/img/Profile.png'}" 
                                    alt="Photo de profil">
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-800">${user.name}</h3>
                                <p class="text-sm text-gray-600">${user.role ? user.role.name : ''}</p>
                            </div>
                        </div>
                        <a href="/admin/users/${user.id}" class="text-[#580a21] hover:text-[#420718]">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 text-sm mt-3">
                        <div>
                            <p class="text-gray-500">Email:</p>
                            <p class="font-medium truncate">${user.email}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Ville:</p>
                            <p class="font-medium">${user.city}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Inscrit le:</p>
                            <p class="font-medium">${new Date(user.created_at).toLocaleDateString('fr-FR')}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Statut:</p>
                            <form action="/admin/users/update-status/${user.id}" method="POST" class="mt-1">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <input type="hidden" name="_method" value="PATCH">
                                <select name="status" onchange="this.form.submit()" class="w-full text-xs font-semibold rounded border-0 px-2 py-1 ${statusClass}">
                                    <option value="active" ${user.status === 'active' ? 'selected' : ''}>Actif</option>
                                    ${user.status === 'pending' ? `<option value="pending" ${user.status === 'pending' ? 'selected' : ''}>En attente</option>` : ''}
                                    <option value="suspended" ${user.status === 'suspended' ? 'selected' : ''}>Suspendu</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            `;
        });

        html += '</div>';
        mobileContainer.innerHTML = html;
    }

    function updateDesktopContainer(users) {
        // Add a check to ensure users is an array
        if (!users || !Array.isArray(users) || users.length === 0) {
            showNoUsersMessage();
            return;
        }

        let html = '';

        users.forEach(user => {
            // Check that user is indeed an object
            if (!user) return;

            let statusClass = 'bg-rose-600 text-white';
            let statusText = 'Suspendu';

            if (user.status === 'active') {
                statusClass = 'bg-emerald-600 text-white';
                statusText = 'Actif';
            } else if (user.status === 'pending') {
                statusClass = 'bg-amber-500 text-white';
                statusText = 'En attente';
            }

            html += `
                <tr class="hover:bg-rose-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        ${user.id}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="${user.profile_picture ? user.profile_picture : '/assets/img/Profile.png'}" 
                                    alt="Photo de profil">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-800">
                                    ${user.name}
                                </div>
                                <div class="text-sm text-gray-600 truncate max-w-xs">
                                    ${user.bio ? user.bio : 'Aucune biographie'}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        ${user.email}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        ${user.city}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        ${user.role ? user.role.name : ''}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="/admin/users/update-status/${user.id}" method="POST">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                            <input type="hidden" name="_method" value="PATCH">
                            <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded border-0 px-2 py-1 ${statusClass}">
                                <option value="active" ${user.status === 'active' ? 'selected' : ''}>Actif</option>
                                ${user.status === 'pending' ? `<option value="pending" ${user.status === 'pending' ? 'selected' : ''}>En attente</option>` : ''}
                                <option value="suspended" ${user.status === 'suspended' ? 'selected' : ''}>Suspendu</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        ${new Date(user.created_at).toLocaleDateString('fr-FR')}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <a href="/admin/users/${user.id}">
                                <button type="submit" class="text-[#580a21] hover:text-[#420718] transition-colors duration-150">
                                    <i class="fas fa-eye text-lg"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
            `;
        });

        desktopContainer.innerHTML = html;
    }
</script>

@endsection