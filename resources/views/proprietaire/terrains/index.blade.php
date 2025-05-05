@extends('Layout.dashboard')
@section('title', 'Gestion des Terrains')
@section('content')

<div class="container mx-auto px-4 py-8 mt-[4rem] text-gray-200">
    <!-- En-tête avec titre et boutons d'action -->
   
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-200">Gestion des Terrains</h1>
        <a href="{{ route('proprietaire.terrain.create') }}" class="bg-[#580a21] hover:bg-[#580a21c6] text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Ajouter un terrain
        </a>
    </div>
    
    @if(session('success'))
        <div id="success-alert" class="bg-green-900 border border-green-700 text-green-100 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>

        <script>
            // Faire disparaître le message après 2 secondes
            setTimeout(function() {
                const alert = document.getElementById('success-alert');
                if(alert) {
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

    <!-- Message d'erreur général -->
    @if(session('error'))
        <div id="error-alert" class="bg-red-900 border border-red-700 text-red-100 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
            <button type="button" class="absolute top-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                <span class="sr-only">Fermer</span>
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

   

    <!-- Tableau des terrains -->
    <div class="bg-[#18191d] rounded-lg shadow-md overflow-hidden border border-gray-800">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-800">
                <thead class="bg-[#1c1d22]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-10 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
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
                <tbody class="bg-[#18191d] divide-y divide-gray-800">
                    @forelse($terrains as $terrain)
                    <tr class="hover:bg-[#212228] transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $terrain->id }}
                        </td>
                        <td class=" py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    
                                </div>
                                <div class="">
                                    <div class="text-sm font-medium text-gray-200">
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
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('proprietaire.terrain.show', $terrain->id) }}" class="text-gray-400 hover:text-red-500" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('proprietaire.terrain.edit', $terrain->id) }}" class="text-blue-400 hover:text-blue-300" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('proprietaire.terrain.destroy', $terrain->id) }}" method="POST" class="inline" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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