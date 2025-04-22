@extends('Layout.dashboard')
@section('title', 'Gestion des Services')
@section('content')

<div class=" mx-auto px-4 py-8 mt-[4rem] text-gray-800">
    <!-- En-tête avec titre et boutons d'action -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestion des Services</h1>
        <button onclick="showForm()" class="bg-[#580a21] hover:bg-[#420718] text-white px-4 py-2 rounded-lg transition-colors duration-200">
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
                if(alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }
            }, 2000);
        </script>
    @endif
   

    <!-- Tableau des services -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
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
                           
                            <button onclick="showUpdateForm(this, '{{ $service->name }}' )" class="text-[#580a21] hover:text-[#420718] transition-colors duration-150" data-id="{{ $service->id }}">
                                <i class="fas fa-edit text-lg"></i>
                            </button>
                           <button onclick="showDeleteModal(this)" type="button" class="text-rose-600 hover:text-rose-700" data-id="{{ $service->id }}">
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

<style>
    /* Style pour les options du select en thème clair */
    select option {
        background-color: #fff1f2; /* bg-rose-50 */
        color: #1f2937; /* text-gray-800 */
    }
</style>


<!-- Modal d'ajout de service -->
<div id="addServiceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
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

<!-- Modal de confirmation de suppression -->
<div id="deleteServiceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
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

<!-- Modal de mise à jour de service -->
<div id="updateServiceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
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

     function showDeleteModal(button){
  
        const serviceId = button.getAttribute('data-id');
        
                const form = document.getElementById('deleteServiceForm');
                form.action = form.action.replace('__SERVICE_ID__', serviceId);
                
        document.getElementById('deleteServiceModal').classList.remove('hidden');
    }
    function hideDeleteModal(){
      document.getElementById('deleteServiceModal').classList.add('hidden');
    }


 function showUpdateForm(button, name) {
          const serviceId = button.getAttribute('data-id');
        
                const form = document.getElementById('updateServiceForm');
                const input = document.getElementById('updateInput');
                input.value = name;
                form.action = form.action.replace('__SERVICE_ID__', serviceId);
        
        // Afficher le modal
        document.getElementById('updateServiceModal').classList.remove('hidden');
    }
    
    function hideUpdateForm() {
        document.getElementById('updateServiceModal').classList.add('hidden');
    }
</script>



@endsection