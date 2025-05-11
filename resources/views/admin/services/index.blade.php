@extends('Layout.dashboard')
@section('title', 'Gestion des Services')
@section('content')

<div class="container mx-auto px-2 py-4 mt-[4rem] text-gray-800 bg-rose-50">
    <!-- Header with title and action buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-0">Gestion des Services</h1>
        <button onclick="showForm()" class="bg-[#580a21] hover:bg-[#420718] text-white px-4 py-2 rounded-lg transition-colors duration-200 w-full sm:w-auto">
            <i class="fas fa-plus mr-2"></i>Ajouter un service
        </button>
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

    <!-- Mobile view (visible only on small screens) -->
    <div class="block md:hidden" id="mobile-services-container">
        <div class="space-y-4">
            @forelse($services as $service)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $service->name }}</h3>
                        <p class="text-sm text-gray-600">Créé le: {{ $service->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="showUpdateForm(this, '{{ $service->name }}')" class="text-[#580a21] hover:text-[#420718]" data-id="{{ $service->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="showDeleteModal(this)" class="text-rose-600 hover:text-rose-700" data-id="{{ $service->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="mt-2 pt-2 border-t border-gray-100 text-sm">
                    <p class="text-gray-500">ID: <span class="font-medium">{{ $service->id }}</span></p>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-md p-6 text-center text-gray-500">
                Aucun service trouvé.
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
                            Nom
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
                    @forelse($services as $service)
                    <tr class="hover:bg-rose-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $service->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $service->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $service->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button onclick="showUpdateForm(this, '{{ $service->name }}')" class="text-[#580a21] hover:text-[#420718]" data-id="{{ $service->id }}">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>
                                <button onclick="showDeleteModal(this)" class="text-rose-600 hover:text-rose-700" data-id="{{ $service->id }}">
                                    <i class="fas fa-trash text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                            Aucun service trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination (if necessary) -->
    @if($services instanceof \Illuminate\Pagination\LengthAwarePaginator && $services->hasPages())
    <div class="mt-6 px-2" id="pagination-container">
        <nav class="flex items-center justify-between bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-4">
            <div class="flex-1 flex justify-between sm:hidden">
                @if($services->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                    Précédent
                </span>
                @else
                <a href="{{ $services->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
                    Précédent
                </a>
                @endif

                @if($services->hasMorePages())
                <a href="{{ $services->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
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
                        Affichage de <span class="font-medium">{{ $services->firstItem() }}</span> à <span class="font-medium">{{ $services->lastItem() }}</span> sur <span class="font-medium">{{ $services->total() }}</span> services
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                        {{-- Previous page link --}}
                        @if($services->onFirstPage())
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md">
                            <span class="sr-only">Précédent</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        @else
                        <a href="{{ $services->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-l-md hover:bg-rose-50">
                            <span class="sr-only">Précédent</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @endif

                        {{-- Pagination links --}}
                        @foreach($services->getUrlRange(1, $services->lastPage()) as $page => $url)
                        @if($page == $services->currentPage())
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
                        @if($services->hasMorePages())
                        <a href="{{ $services->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-r-md hover:bg-rose-50">
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

<!-- Add Service Modal -->
<div id="addServiceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Ajouter un service</h2>
            <button onclick="hideForm()" class="text-gray-500 hover:text-gray-800">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="service" class="block text-sm font-medium text-gray-700 mb-2">Nom du service</label>
                <input type="text" id="service" name="service" required
                    class="w-full bg-rose-50 border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#580a21]">
            </div>

            <div class="flex justify-end mt-6">
                <button type="button" onclick="hideForm()" class="bg-rose-50 hover:bg-rose-100 text-gray-800 px-4 py-2 rounded-lg mr-2">
                    Annuler
                </button>
                <button type="submit" class="bg-[#580a21] hover:bg-[#420718] text-white px-4 py-2 rounded-lg">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteServiceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Confirmer la suppression</h2>
            <button onclick="hideDeleteModal()" class="text-gray-500 hover:text-gray-800">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="mb-6">
            <p class="text-gray-700">Êtes-vous sûr de vouloir supprimer ce service ?</p>
        </div>

        <div class="flex justify-end mt-6">
            <button type="button" onclick="hideDeleteModal()" class="bg-rose-50 hover:bg-rose-100 text-gray-800 px-4 py-2 rounded-lg mr-2">
                Annuler
            </button>
            <form id="deleteServiceForm" action="{{ route('admin.services.destroy','__SERVICE_ID__') }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white px-4 py-2 rounded-lg">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Update Service Modal -->
<div id="updateServiceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Modifier un service</h2>
            <button onclick="hideUpdateForm()" class="text-gray-500 hover:text-gray-800">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form id="updateServiceForm" action="{{ route('admin.services.update', '__SERVICE_ID__') }}" method="POST">
            @csrf
            @method('Patch')
            <div class="mb-4">
                <label for="service_name" class="block text-sm font-medium text-gray-700 mb-2">Nom du service</label>
                <input id="updateInput" type="text" value="" id="service_name" name="service" required
                    class="w-full bg-rose-50 border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#580a21]">
            </div>

            <div class="flex justify-end mt-6">
                <button type="button" onclick="hideUpdateForm()" class="bg-rose-50 hover:bg-rose-100 text-gray-800 px-4 py-2 rounded-lg mr-2">
                    Annuler
                </button>
                <button type="submit" class="bg-[#580a21] hover:bg-[#420718] text-white px-4 py-2 rounded-lg">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showForm() {
        document.getElementById('addServiceModal').classList.remove('hidden');
    }

    function hideForm() {
        document.getElementById('addServiceModal').classList.add('hidden');
    }

    function showDeleteModal(button) {
        const serviceId = button.getAttribute('data-id');
        const form = document.getElementById('deleteServiceForm');
        form.action = form.action.replace('__SERVICE_ID__', serviceId);
        document.getElementById('deleteServiceModal').classList.remove('hidden');
    }

    function hideDeleteModal() {
        document.getElementById('deleteServiceModal').classList.add('hidden');
    }

    function showUpdateForm(button, name) {
        const serviceId = button.getAttribute('data-id');
        const form = document.getElementById('updateServiceForm');
        const input = document.getElementById('updateInput');
        input.value = name;
        form.action = form.action.replace('__SERVICE_ID__', serviceId);
        document.getElementById('updateServiceModal').classList.remove('hidden');
    }

    function hideUpdateForm() {
        document.getElementById('updateServiceModal').classList.add('hidden');
    }
</script>

@endsection