@extends('Layout.dashboard')
@section('title', 'Détails de l\'Utilisateur')
@section('content')

<div class="container mx-auto px-4 py-8 text-gray-800">
    <!-- En-tête avec bouton de retour -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-2">
          
             <a href="{{ route('admin.users.index') }}" class="bg-[#580a21] hover:bg-[#420718] rounded-full w-8 h-8 flex items-center justify-center">
                <i class="fas fa-arrow-left text-white"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Détails de l'Utilisateur</h1>
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
            <button onclick="openSuspendUserModal()" class="px-4 py-2 bg-[#580a21] text-white rounded-lg hover:bg-[#420718] flex items-center">
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
    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
        <!-- En-tête avec photo de profil et informations principales -->
        <div class="bg-gradient-to-r from-[#580a21] to-[#420718] p-6 text-white">
            <div class="flex flex-col md:flex-row items-center md:items-start">
                <div class="flex-shrink-0 mb-4 md:mb-0">
                    <img class="h-32 w-32 rounded-full shadow-md object-cover"
                         src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('assets/img/Profile.png') }}" 
                         alt="Photo de profil de {{ $user->name }}">
                </div>
                <div class="md:ml-6 text-center md:text-left">
                    <h2 class="text-3xl font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-100 text-lg">{{ $user->email }}</p>
                    <div class="mt-3 flex flex-wrap justify-center md:justify-start gap-2">
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            {{ $user->status === 'active' ? 'bg-emerald-500 text-white' : 
                               ($user->status === 'pending' ? 'bg-amber-500 text-white' : 'bg-rose-500 text-white') }}">
                            {{ $user->status === 'active' ? 'Actif' : 
                               ($user->status === 'pending' ? 'En attente' : 'Suspendu') }}
                        </span>
                        <span class="px-3 py-1 bg-[#380716] text-white rounded-full text-sm font-medium">
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
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-200">
                        <i class="fas fa-user-circle mr-2 text-[#580a21]"></i> Informations Personnelles
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Nom Complet</label>
                            <p class="text-gray-800 font-medium">{{ $user->name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                            <p class="text-gray-800">{{ $user->email }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Téléphone</label>
                            <p class="text-gray-800">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Ville</label>
                            <p class="text-gray-800">{{ $user->city }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Biographie</label>
                            <p class="text-gray-800">{{ $user->bio ?? 'Aucune biographie renseignée' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Informations du compte -->
                <div class="bg-rose-50 p-6 rounded-lg shadow-md border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-200">
                        <i class="fas fa-shield-alt mr-2 text-[#580a21]"></i> Informations du Compte
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">ID Utilisateur</label>
                            <p class="text-gray-800">#{{ $user->id }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Rôle</label>
                            <p class="text-gray-800">{{ $user->role->name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Statut</label>
                            <p class="text-gray-800">
                                <span class="px-2 py-1 rounded text-sm
                                    {{ $user->status === 'active' ? 'bg-emerald-500 text-white' : 
                                    ($user->status === 'pending' ? 'bg-amber-500 text-white' : 'bg-rose-500 text-white') }}">
                                    {{ $user->status === 'active' ? 'Actif' : 
                                    ($user->status === 'pending' ? 'En attente' : 'Suspendu') }}
                                </span>
                            </p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Compte créé le</label>
                            <p class="text-gray-800">{{ $user->created_at->format('d/m/Y à H:i') }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Dernière mise à jour</label>
                            <p class="text-gray-800">{{ $user->updated_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmation de Suspension -->
<div id="suspend-user-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md text-center border border-gray-200">
        <div class="mb-4">
            <i class="fas fa-exclamation-triangle text-5xl text-amber-500"></i>
        </div>
        <h2 class="text-xl font-bold mb-4 text-gray-800">Suspendre l'Utilisateur</h2>
        <p class="mb-6 text-gray-600">Êtes-vous sûr de vouloir suspendre le compte de {{ $user->name }} ? Cette action peut être annulée ultérieurement.</p>
        
        <div class="flex justify-center space-x-4">
            <button onclick="closeSuspendModal()" class="px-4 py-2 bg-rose-50 text-gray-800 rounded-lg hover:bg-rose-100">
                Annuler
            </button>
            <form action="{{ route('admin.users.update-status', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="suspended">
                <button type="submit" class="px-4 py-2 bg-[#580a21] text-white rounded-lg hover:bg-[#420718]">
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