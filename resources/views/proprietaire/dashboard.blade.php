@extends('Layout.dashboard')
@section('title', 'Détails de l\'Utilisateur')
@section('content')


    <!-- Main Content -->
    <div class="container mx-auto p-4 mt-9">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Terrains -->
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-300">Terrains</h3>
                        <div class="w-10 h-10 rounded-full bg-red-600/20 flex items-center justify-center">
                            <i class="fas fa-futbol text-red-600"></i>
                        </div>
                    </div>
                    <div class="flex items-end">
                        <span class="text-3xl font-bold mr-2">{{ count($terrains) }}</span>
                    
                    </div>
                    <p class="text-gray-400 text-sm mt-2">Total des terrains dans votre compte</p>
                    <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                        <div class="bg-red-600 h-1 rounded-full" style="width:{{ (count($terrains )/ $totalTerrains) * 100 }}%"></div>

                    </div>
                </div>

            <!-- Terrains Existants -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Reservation</h3>
                    <div class="w-10 h-10 rounded-full bg-blue-600/20 flex items-center justify-center">
                        <i class="fas fa-futbol text-blue-600"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <span class="text-3xl font-bold mr-2">{{ $reservation }}</span>
                   
                </div>
                <p class="text-gray-400 text-sm mt-2">Total des reservation dans votre compte</p>
                <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                    <div class="bg-blue-600 h-1 rounded-full" style="width: {{ ($reservation / $totalReservations) * 100 }}%"></div>
                </div>
            </div>

            <!-- Nouveaux Terrains -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-red-600 transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Comments</h3>
                    <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center">
                        <i class="fas fa-plus-circle text-green-600"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <span class="text-3xl font-bold mr-2">{{ $comment }}</span>
                    
                </div>
                <p class="text-gray-400 text-sm mt-2">Total des commentaires dans votre compte</p>
                <div class="mt-4 bg-gray-700/50 h-1 rounded-full overflow-hidden">
                    <div class="bg-green-600 h-1 rounded-full" style="width: {{ ($comment / $totalComments) * 100 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Detailed Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
             <!-- Terrains par Taux de Réservation -->
            <div class="col-span-1 lg:col-span-2 bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-300">Terrains par Taux de Réservation</h3>
                    <div class="w-10 h-10 rounded-full bg-red-600/20 flex items-center justify-center">
                        <i class="fas fa-calendar-check text-red-600"></i>
                    </div>
                </div>
                
                <!-- Graphique à barres horizontales -->
               <div class="mt-4 space-y-4">
    <div>
        <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-300">Plus de 10 réservations</span>
            <span class="font-medium text-red-500">{{ $moreThanTenReservations }} terrains</span>
        </div>
        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full bg-red-600 rounded-full" style="width: {{ $percentageMoreThanTen }}%"></div>
        </div>
    </div>
    
    <div>
        <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-300">5 à 10 réservations</span>
            <span class="font-medium text-red-400">{{ $fiveToTenReservations }} terrains</span>
        </div>
        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full bg-red-500 rounded-full" style="width: {{ $percentageFiveToTen }}%"></div>
        </div>
    </div>
    
    <div>
        <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-300">1 à 4 réservations</span>
            <span class="font-medium text-red-300">{{ $oneToFourReservations }} terrains</span>
        </div>
        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full bg-red-400 rounded-full" style="width: {{ $percentageOneToFour }}%"></div>
        </div>
    </div>
    
    <div>
        <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-300">Aucune réservation</span>
            <span class="font-medium text-gray-400">{{ $noReservations }} terrains</span>
        </div>
        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full bg-gray-500 rounded-full" style="width: {{ $percentageNoReservations }}%"></div>
        </div>
    </div>
</div>
                
                <div class="mt-6 p-4 bg-gray-700/30 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-arrow-trend-up text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-white">{{  $fiveToTenReservations }} terrains dépassent 5 réservations</h4>
                        </div>
                    </div>
                </div>
                
             
            </div>
                       <!-- Liste des derniers terrains ajoutés -->
          <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium">Nouveaux Terrains</h3>
        <a class="text-xs text-red-600" href="{{ route('proprietaire.terrains.index') }}">Voir tout</a>
    </div>
    
    <div class="space-y-4">
        @forelse($terrains->take(4) as $terrain)
            <div class="bg-gray-700/30 rounded-lg p-3 hover:bg-gray-700/50 transition-all">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-md bg-green-600/20 flex items-center justify-center mr-3">
                            <i class="fas fa-futbol text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">{{ $terrain->name }}</h4>
                            <p class="text-xs text-gray-400">{{ $terrain->city}}, {{ $terrain->adress }}</p>
                        </div>
                    </div>
                    @if($terrain->created_at->diffInDays(now()) < 7)
                        <div class="text-xs bg-green-600/20 text-green-600 px-2 py-1 rounded">Nouveau</div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center text-gray-400 py-4">
                Aucun terrain disponible
            </div>
        @endforelse
        
        <div class="mt-4 flex justify-center">
            <a class="bg-red-600 text-white px-4 py-2 rounded-full text-sm font-bold flex items-center" href="{{ route('proprietaire.terrain.create') }}">
                <i class="fas fa-plus mr-2"></i> Ajouter un terrain
            </a>
        </div>
    </div>
</div>
        </div>
        
    
        
        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <button class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-all flex items-center">
                <i class="fas fa-file-export mr-2"></i>
                Exporter les statistiques
            </button>
            <button onclick="reloadPage()" class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all flex items-center">
                <i class="fas fa-sync-alt mr-2"></i>
                Actualiser les données
            </button>
            <button class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-all flex items-center">
                <i class="fas fa-cog mr-2"></i>
                Paramètres
            </button>
        </div>
    </div>
    <script>

    function reloadPage() {
          location.reload();
     };

    </script>
  
@endsection