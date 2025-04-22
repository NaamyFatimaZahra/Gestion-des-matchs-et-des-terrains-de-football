@extends('Layout.dashboard')
@section('title', 'Profil Utilisateur')
@section('content')

    <!-- Main Content -->
    <div class="container mx-auto p-4 mt-9">
        <!-- Messages de succès et d'erreur -->
        @if(session('success'))
            <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Succès!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg onclick="document.getElementById('success-alert').style.display = 'none'" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Fermer</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        @endif

        @if(session('error'))
            <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Erreur!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg onclick="document.getElementById('error-alert').style.display = 'none'" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Fermer</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        @endif
        <!-- En-tête du profil -->
        <div class="bg-white rounded-lg p-6 border border-gray-200 shadow-md mb-8">
            <div class="flex flex-col md:flex-row items-center md:items-start">
                <!-- Photo de profil -->
                <div class="relative mb-4 md:mb-0 md:mr-8">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-[#580a21]">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo de profil" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-rose-50 flex items-center justify-center">
                                <i class="fas fa-user text-4xl text-gray-500"></i>
                            </div>
                        @endif
                    </div>
                 <form id="profile-picture-form" action="{{ route('profile.update-picture') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <input type="file" name="profile_picture" id="profile-picture-input" onchange="this.form.submit()">
                </form>

                <a href="javascript:void(0)" onclick="document.getElementById('profile-picture-input').click();" class="absolute bottom-0 right-0 bg-[#580a21] w-8 h-8 rounded-full flex items-center justify-center hover:bg-[#420718] transition-all">
                    <i class="fas fa-camera text-white"></i>
                </a>
                </div>
                
                <!-- Informations de base -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-col md:flex-row md:items-center mb-2">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                        <span class="bg-{{ $user->status === 'active' ? 'green' : ($user->status === 'suspended' ? 'red' : 'yellow') }}-600/20 text-{{ $user->status === 'active' ? 'green' : ($user->status === 'suspended' ? 'red' : 'yellow') }}-500 text-xs px-2 py-1 rounded ml-0 md:ml-3 mt-2 md:mt-0 inline-block">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-md bg-rose-50 flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-[#580a21]"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Ville</p>
                                <p class="font-medium text-gray-800">{{ $user->city }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-md bg-rose-50 flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-[#580a21]"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Téléphone</p>
                                <p class="font-medium text-gray-800">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-2">
                        <a href="{{ route('profile.edit') }}" class="bg-[#580a21] text-white px-4 py-2 rounded-lg hover:bg-[#420718] transition-all flex items-center text-sm">
                            <i class="fas fa-edit mr-2"></i>
                            Modifier le profil
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Détails de l'utilisateur -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Informations personnelles -->
            <div class="bg-white rounded-lg p-6 border border-gray-200 shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-800">Informations personnelles</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="bg-rose-50 rounded-lg p-4">
                        <h4 class="text-sm text-gray-600 mb-2">Nom</h4>
                        <p class="font-medium text-gray-800">{{ $user->name }}</p>
                    </div>
                    
                    <div class="bg-rose-50 rounded-lg p-4">
                        <h4 class="text-sm text-gray-600 mb-2">Email</h4>
                        <p class="font-medium text-gray-800">{{ $user->email }}</p>
                    </div>
                    
                    <div class="bg-rose-50 rounded-lg p-4">
                        <h4 class="text-sm text-gray-600 mb-2">Ville</h4>
                        <p class="font-medium text-gray-800">{{ $user->city }}</p>
                    </div>
                    
                    <div class="bg-rose-50 rounded-lg p-4">
                        <h4 class="text-sm text-gray-600 mb-2">Téléphone</h4>
                        <p class="font-medium text-gray-800">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                    </div>
                    
                    <div class="bg-rose-50 rounded-lg p-4">
                        <h4 class="text-sm text-gray-600 mb-2">Statut</h4>
                        <p class="font-medium text-gray-800">
                            <span class="px-2 py-1 rounded-full text-xs 
                                {{ $user->status === 'active' ? 'bg-emerald-500 text-white' : 
                                  ($user->status === 'suspended' ? 'bg-rose-500 text-white' : 'bg-amber-500 text-white') }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Biographie et Compte -->
            <div class="bg-white rounded-lg p-6 border border-gray-200 shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-800">Profil</h3>
                </div>
                
                <div class="bg-rose-50 rounded-lg p-4 mb-4">
                    <h4 class="text-sm text-gray-600 mb-2">Biographie</h4>
                    <p class="font-medium text-gray-800">
                        {{ $user->bio ?? 'Aucune biographie renseignée. Ajoutez une biographie pour vous présenter.' }}
                    </p>
                </div>
                
                <div class="bg-rose-50 rounded-lg p-4 mb-4">
                    <h4 class="text-sm text-gray-600 mb-2">Rôle</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-[#580a21]/20 flex items-center justify-center mr-3">
                            <i class="fas fa-user-tag text-[#580a21]"></i>
                        </div>
                        <span class="text-gray-800">{{ $user->role->name ?? 'Utilisateur' }}</span>
                    </div>
                </div>
                
                <div class="bg-rose-50 rounded-lg p-4 mb-4">
                    <h4 class="text-sm text-gray-600 mb-2">Date d'inscription</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-blue-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-blue-600"></i>
                        </div>
                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</span>
                    </div>
                </div>
                
                <div class="bg-rose-50 rounded-lg p-4">
                    <h4 class="text-sm text-gray-600 mb-2">Dernière mise à jour</h4>
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-md bg-green-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-green-600"></i>
                        </div>
                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <a href="{{ route('profile.edit') }}" class="bg-[#580a21] text-white px-6 py-3 rounded-lg hover:bg-[#420718] transition-all flex items-center">
                <i class="fas fa-user-edit mr-2"></i>
                Modifier mon profil
            </a>
            <button onclick="reloadPage()" class="bg-rose-50 text-gray-800 px-6 py-3 rounded-lg hover:bg-rose-100 transition-all flex items-center">
                <i class="fas fa-sync-alt mr-2"></i>
                Actualiser les données
            </button>
        </div>
    </div>
    
    <script>  
    function reloadPage() {
        location.reload();
    }
    </script>
    
@endsection