@extends('Layout.dashboard')
@section('title', 'Détails de l\'Utilisateur')
@section('content')

<div class="container mx-auto px-4 py-8 text-gray-300">
    <!-- En-tête avec bouton de retour -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.users.index') }}" class="text-red-500 hover:text-red-400">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-white">Détails de l'Utilisateur</h1>
        </div>
        <div class="flex space-x-2">
           @if($user->status === 'pending')
            <form action="{{ route('admin.users.update-status', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="active">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i> activer
                </button>
            </form>
           @else
            @if($user->status !== 'suspended')
            <button onclick="openSuspendUserModal()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center">
                <i class="fas fa-ban mr-2"></i> Suspendre
            </button>
            @else
            <form action="{{ route('admin.users.update-status', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="active">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i> Réactiver
                </button>
            </form>
            @endif
           @endif
        </div>
    </div>

    <!-- Carte principale avec informations utilisateur -->
    <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden border border-gray-700">
        <!-- En-tête avec photo de profil et informations principales -->
        <div class="bg-gradient-to-r from-red-800 to-gray-900 p-6 text-white">
            <div class="flex flex-col md:flex-row items-center md:items-start">
                <div class="flex-shrink-0 mb-4 md:mb-0">
                    <img class="h-32 w-32 rounded-full  shadow-md object-cover"
                         src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('assets/img/Profile.png') }}" 
                         alt="Photo de profil de {{ $user->name }}">
                </div>
                <div class="md:ml-6 text-center md:text-left">
                    <h2 class="text-3xl font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-300 text-lg">{{ $user->email }}</p>
                    <div class="mt-3 flex flex-wrap justify-center md:justify-start gap-2">
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            {{ $user->status === 'active' ? 'bg-green-800 text-green-100' : 
                               ($user->status === 'pending' ? 'bg-yellow-800 text-yellow-100' : 'bg-red-800 text-red-100') }}">
                            {{ $user->status === 'active' ? 'Actif' : 
                               ($user->status === 'pending' ? 'En attente' : 'Suspendu') }}
                        </span>
                        <span class="px-3 py-1 bg-red-600 text-white rounded-full text-sm font-medium">
                            {{ $user->role->name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Informations personnelles -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                    <h3 class="text-xl font-semibold text-white mb-6 pb-2 border-b border-gray-700">
                        <i class="fas fa-user-circle mr-2 text-red-500"></i> Informations Personnelles
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Nom Complet</label>
                            <p class="text-white font-medium">{{ $user->name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Email</label>
                            <p class="text-white">{{ $user->email }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Téléphone</label>
                            <p class="text-white">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Ville</label>
                            <p class="text-white">{{ $user->city }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Biographie</label>
                            <p class="text-white">{{ $user->bio ?? 'Aucune biographie renseignée' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Informations du compte -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                    <h3 class="text-xl font-semibold text-white mb-6 pb-2 border-b border-gray-700">
                        <i class="fas fa-shield-alt mr-2 text-red-500"></i> Informations du Compte
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">ID Utilisateur</label>
                            <p class="text-white">#{{ $user->id }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Rôle</label>
                            <p class="text-white">{{ $user->role->name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Statut</label>
                            <p class="text-white">
                                <span class="px-2 py-1 rounded text-sm
                                    {{ $user->status === 'active' ? 'bg-green-900 text-green-100' : 
                                    ($user->status === 'pending' ? 'bg-yellow-900 text-yellow-100' : 'bg-red-900 text-red-100') }}">
                                    {{ $user->status === 'active' ? 'Actif' : 
                                    ($user->status === 'pending' ? 'En attente' : 'Suspendu') }}
                                </span>
                            </p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Compte créé le</label>
                            <p class="text-white">{{ $user->created_at->format('d/m/Y à H:i') }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Dernière mise à jour</label>
                            <p class="text-white">{{ $user->updated_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
           
        </div>
    </div>
</div>

<!-- Modal de Confirmation de Suspension -->
<div id="suspend-user-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
    <div class="bg-gray-900 rounded-lg p-6 w-full max-w-md text-center border border-gray-700">
        <div class="mb-4">
            <i class="fas fa-exclamation-triangle text-5xl text-yellow-500"></i>
        </div>
        <h2 class="text-xl font-bold mb-4 text-white">Suspendre l'Utilisateur</h2>
        <p class="mb-6 text-gray-300">Êtes-vous sûr de vouloir suspendre le compte de {{ $user->name }} ? Cette action peut être annulée ultérieurement.</p>
        
        <div class="flex justify-center space-x-4">
            <button onclick="closeSuspendModal()" class="px-4 py-2 bg-gray-700 text-gray-200 rounded-lg hover:bg-gray-600">
                Annuler
            </button>
            <form action="{{ route('admin.users.update-status', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="suspended">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Confirmer la Suspension
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Script pour gérer les modals -->
<script>
    function openSuspendUserModal() {
        document.getElementById('suspend-user-modal').classList.remove('hidden');
    }

    function closeSuspendModal() {
        document.getElementById('suspend-user-modal').classList.add('hidden');
    }
</script>
@endsection