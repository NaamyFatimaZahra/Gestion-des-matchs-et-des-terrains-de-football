@extends('Layout.dashboard')
@section('title', 'Gestion des Terrains')
@section('content')

<div class="container mx-auto px-4 py-8 mt-[4rem] text-gray-800 bg-rose-50">
    <!-- En-tête avec titre et boutons d'action -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestion des Terrains</h1>
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

   
    <!-- Tableau des terrains -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
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
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($terrains as $terrain)
                    <tr class="hover:bg-rose-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $terrain->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    
                                </div>
                                <div class="ml-4">
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
                        <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
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