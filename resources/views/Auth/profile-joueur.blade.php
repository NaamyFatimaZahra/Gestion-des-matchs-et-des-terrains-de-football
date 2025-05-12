@extends('Layout.guest')
@section('title', 'Profil Utilisateur')
@section('content')

<!-- Main Content -->
<div class="container mx-auto px-4 py-6 pt-20 max-w-screen-xl">
    <!-- Messages de succès et d'erreur -->
    @if(session('success'))
    <div id="success-alert" class="bg-rose-50 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Succès!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button onclick="document.getElementById('success-alert').style.display = 'none'" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Fermer">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Fermer</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div id="error-alert" class="bg-rose-50 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Erreur!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <button onclick="document.getElementById('error-alert').style.display = 'none'" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Fermer">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Fermer</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </button>
    </div>
    @endif

    <!-- En-tête du profil -->
    <div class="bg-rose-50 rounded-lg p-4 sm:p-6 border shadow-md mb-6">
        <div class="flex flex-col items-center sm:flex-row sm:items-start">
            <!-- Photo de profil -->
            <div class="relative mx-auto sm:mx-0 mb-6 sm:mb-0 sm:mr-6">
                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full overflow-hidden border-4 border-[#420718e2]">
                    @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo de profil" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-rose-100 flex items-center justify-center">
                        <i class="fas fa-user text-3xl sm:text-4xl text-gray-500"></i>
                    </div>
                    @endif
                </div>

                <!-- Formulaire caché pour l'upload -->
                <form id="profile-picture-form" action="{{ route('profile.update-picture') }}" method="POST" enctype="multipart/form-data" class="hidden">
                    @csrf
                    <input type="file" name="profile_picture" id="profile-picture-input" onchange="this.form.submit()">
                </form>

                <!-- Bouton d'édition de photo -->
                <button onclick="document.getElementById('profile-picture-input').click();"
                    class="absolute bottom-0 right-0 bg-[#420718e2] w-8 h-8 rounded-full flex items-center justify-center hover:bg-[#2d050fe2] transition-all"
                    aria-label="Changer la photo de profil">
                    <i class="fas fa-camera text-white"></i>
                </button>
            </div>

            <!-- Informations de base -->
            <div class="flex-1 text-center sm:text-left">
                <div class="flex flex-col sm:flex-row sm:items-center mb-2">
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                    <span class="bg-rose-50 text-{{ $user->status === 'active' ? 'green' : ($user->status === 'suspended' ? 'red' : 'yellow') }}-500 text-xs px-2 py-1 rounded mx-auto sm:mx-0 sm:ml-3 mt-2 sm:mt-0 inline-block">
                        {{ ucfirst($user->status) }}
                    </span>
                </div>

                <p class="text-gray-600 mb-4">{{ $user->email }}</p>

                <!-- Informations de contact -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center justify-center sm:justify-start">
                        <div class="w-10 h-10 rounded-md bg-rose-100 flex items-center justify-center mr-3">
                            <i class="fas fa-map-marker-alt text-[#420718e2]"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Ville</p>
                            <p class="font-medium text-gray-800">{{ $user->city }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center sm:justify-start">
                        <div class="w-10 h-10 rounded-md bg-rose-100 flex items-center justify-center mr-3">
                            <i class="fas fa-phone text-[#420718e2]"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Téléphone</p>
                            <p class="font-medium text-gray-800">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Bouton d'édition -->
                <div class="flex justify-center sm:justify-start">
                    <a href="{{ route('profile.joueur.edit') }}" class="bg-[#420718e2] text-white px-4 py-2 rounded-lg hover:bg-[#2d050fe2] transition-all flex items-center text-sm">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier le profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Détails de l'utilisateur -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">
        <!-- Informations personnelles -->
        <div class="bg-rose-50 rounded-lg p-4 sm:p-6 border border-gray-200 shadow-md">
            <div class="flex justify-between items-center mb-4 sm:mb-6">
                <h3 class="text-base sm:text-lg font-medium text-gray-800">Informations personnelles</h3>
            </div>

            <div class="space-y-3 sm:space-y-4">
                <div class="bg-rose-100 rounded-lg p-3 sm:p-4">
                    <h4 class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Nom</h4>
                    <p class="font-medium text-gray-800">{{ $user->name }}</p>
                </div>

                <div class="bg-rose-100 rounded-lg p-3 sm:p-4">
                    <h4 class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Email</h4>
                    <p class="font-medium text-gray-800 break-all">{{ $user->email }}</p>
                </div>

                <div class="bg-rose-100 rounded-lg p-3 sm:p-4">
                    <h4 class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Ville</h4>
                    <p class="font-medium text-gray-800">{{ $user->city }}</p>
                </div>

                <div class="bg-rose-100 rounded-lg p-3 sm:p-4">
                    <h4 class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Téléphone</h4>
                    <p class="font-medium text-gray-800">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                </div>

                <div class="bg-rose-100 rounded-lg p-3 sm:p-4">
                    <h4 class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Statut</h4>
                    <p class="font-medium text-gray-800">
                        <span class="px-2 py-1 rounded-full text-xs 
                                {{ $user->status === 'active' ? 'bg-green-100 text-green-700' : 
                                  ($user->status === 'suspended' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Profil et Historique -->
        <div class="bg-rose-50 rounded-lg p-4 sm:p-6 border border-gray-200 shadow-md">
            <div class="flex justify-between items-center mb-4 sm:mb-6">
                <h3 class="text-base sm:text-lg font-medium text-gray-800">Profil</h3>
            </div>

            <div class="space-y-3 sm:space-y-4">
                <div class="bg-rose-100 rounded-lg p-3 sm:p-4">
                    <h4 class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Biographie</h4>
                    <p class="font-medium text-gray-800">
                        {{ $user->bio ?? 'Aucune biographie renseignée. Ajoutez une biographie pour vous présenter.' }}
                    </p>
                </div>

                <div class="bg-rose-100 rounded-lg p-3 sm:p-4">
                    <h4 class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Rôle</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-rose-200 flex items-center justify-center mr-3">
                            <i class="fas fa-user-tag text-[#420718e2]"></i>
                        </div>
                        <span class="text-gray-800">{{ $user->role->name ?? 'Utilisateur' }}</span>
                    </div>
                </div>

                <div class="bg-rose-100 rounded-lg p-3 sm:p-4">
                    <h4 class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Date d'inscription</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-rose-200 flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-[#420718e2]"></i>
                        </div>
                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</span>
                    </div>
                </div>

                <div class="bg-rose-100 rounded-lg p-3 sm:p-4">
                    <h4 class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Dernière mise à jour</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-rose-200 flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-[#420718e2]"></i>
                        </div>
                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Boutons d'action -->
    <div class="flex flex-col sm:flex-row justify-center items-center gap-3 sm:gap-4 mt-6 sm:mt-8">
        <a href="{{ route('profile.joueur.edit') }}" class="w-full sm:w-auto bg-[#420718e2] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-[#2d050fe2] transition-all flex items-center justify-center">
            <i class="fas fa-user-edit mr-2"></i>
            <span>Modifier mon profil</span>
        </a>
        <button onclick="reloadPage()" class="w-full sm:w-auto bg-rose-200 text-[#420718e2] px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-rose-300 transition-all flex items-center justify-center">
            <i class="fas fa-sync-alt mr-2"></i>
            <span>Actualiser les données</span>
        </button>
    </div>
</div>

<script>
    function reloadPage() {
        location.reload();
    }

    // Script pour la fermeture automatique des alertes
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner toutes les alertes
        const alerts = document.querySelectorAll('[role="alert"]');

        // Pour chaque alerte, ajouter un timer pour la fermer automatiquement après 5 secondes
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';

                // Après la transition d'opacité, masquer complètement l'élément
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 500);
            }, 5000);
        });
    });
</script>

@endsection