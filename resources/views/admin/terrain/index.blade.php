@extends('Layout.dashboard')
@section('title', 'Gestion des Terrains')
@section('content')

<div class="container mx-auto px-4 py-8 mt-[4rem] text-gray-300">
    <!-- En-tête avec titre et boutons d'action -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Gestion des Terrains</h1>
      
    </div>
   @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

    <script>
        // Faire disparaître le message après 2 secondes
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if(alert) {
                // Option 1: Suppression immédiate
                // alert.remove();
                
                // Option 2: Disparition en fondu (plus élégant)
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }
        }, 2000);
    </script>
@endif

    <!-- Filtres et recherche -->
    <div class="bg-gray-900 rounded-lg shadow-md p-4 mb-6 border border-gray-700">
        <div class="flex flex-wrap justify-between gap-4">
            <div class="flex items-center">
                <div class="relative">
                    <input type="text" placeholder="Rechercher un terrain..." 
                           class="bg-gray-800 border border-gray-700 rounded-lg pl-10 pr-4 py-2 w-64 text-white">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <!-- Filtre par Statut -->
                <select class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    <option value="">Tous les Statuts</option>
                    <option value="disponible">Disponible</option>
                    <option value="occupe">Occupé</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="en_attente">En Attente</option>
                </select>

                <!-- Filtre par Approbation -->
                <select class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    <option value="">Toutes les Approbations</option>
                    <option value="en_attente">En Attente</option>
                    <option value="approuve">Approuvé</option>
                    <option value="rejete">Rejeté</option>
                    <option value="suspended">suspendu</option>
                </select>

                <!-- Filtre par Ville -->
                <select class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    <option value="">Toutes les Villes</option>
                   
                </select>
            </div>
        </div>
    </div>

    <!-- Tableau des terrains -->
    <div class="bg-gray-900 rounded-lg shadow-md overflow-hidden border border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Terrain
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Propriétaire
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Ville
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Prix
                        </th>
                      
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Approbation
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-800">
                    @forelse($terrains  as $terrain)
                    <tr class="hover:bg-gray-800 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $terrain->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-white">
                                        {{ $terrain->name }}
                                    </div>
                                    <div class="text-sm text-gray-400 truncate max-w-xs">
                                        {{ \Illuminate\Support\Str::limit($terrain->description, 50) ?? 'Aucune description' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $terrain->proprietaire->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $terrain->city }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ number_format($terrain->price, 2) }} MAD
                        </td>
                       
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded
                                {{ $terrain->status === 'disponible' ? 'bg-green-900 text-green-100' : 
                                ($terrain->status === 'occupé' ? 'bg-blue-900 text-blue-100' : 
                                ($terrain->status === 'maintenance' ? 'bg-yellow-900 text-yellow-100' : 'bg-gray-700 text-gray-300')) }}">

                                {{ $terrain->status === 'disponible' ? 'Disponible' : 
                                ($terrain->status === 'occupé' ? 'Occupé' : 
                                ($terrain->status === 'maintenance' ? 'Maintenance' : 'En attente')) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.terrains.update-approval', $terrain->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="admin_approval" onchange="this.form.submit()" class="bg-transparent text-xs font-semibold rounded border-0
                                        {{ $terrain->admin_approval === 'approuve' ? 'bg-[green] text-green-100' : 
                                        ($terrain->admin_approval === 'rejete' || $terrain->admin_approval === 'suspended' ? 'bg-[#ff0000dc] text-red-100' : 'bg-yellow-300 text-yellow-900') }}
                                        px-2 py-1">
                                        @if ( $terrain->admin_approval === 'en_attente')
                                        <option value="en_attente" {{ $terrain->admin_approval === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                        @endif
                                        <option value="approuve" {{ $terrain->admin_approval === 'approuve' ? 'selected' : '' }}>Approuvé</option>
                                        <option value="rejete" {{ $terrain->admin_approval === 'rejete' ? 'selected' : '' }}>Rejeté</option>
                                        <option value="suspended" {{ $terrain->admin_approval === 'suspended' ? 'selected' : '' }}>suspended</option>
                                    </select>
                                </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.terrain.show', $terrain->id) }}" class="text-gray-300 hover:text-white">
                                    <i class="fas fa-eye"></i>
                                </a>
                               
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-400">
                            Aucun terrain trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

       
    </div>
</div>




@endsection