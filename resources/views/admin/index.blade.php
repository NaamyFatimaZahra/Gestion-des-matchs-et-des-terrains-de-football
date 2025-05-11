@extends('Layout.dashboard')
@section('title', 'Détails de l\'Utilisateur')
@section('content')


<!-- Main Content -->
<div class="container mx-auto p-4 mt-9">
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Terrains -->
        <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-[#580a21] transition-all duration-300 shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-800">Joueur</h3>
                <div class="w-10 h-10 rounded-full bg-[#580a21]/20 flex items-center justify-center">
                    <i class="fas fa-futbol text-[#580a21]"></i>
                </div>
            </div>
            <div class="flex items-end">
                <span class="text-3xl font-bold mr-2 text-gray-800">{{ $joueurs }}</span>

            </div>
            <p class="text-gray-600 text-sm mt-2">Total des joueurs dans l'application</p>
            <div class="mt-4 bg-rose-50 h-1 rounded-full overflow-hidden">
                <div class="bg-[#580a21] h-1 rounded-full" style="width:{{ ($joueurs/ ($proprietaires+$joueurs)) * 100 }}%"></div>

            </div>
        </div>

        <!-- Terrains Existants -->
        <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-[#580a21] transition-all duration-300 shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-800">Proprietaires</h3>
                <div class="w-10 h-10 rounded-full bg-blue-600/20 flex items-center justify-center">
                    <i class="fas fa-user text-blue-600"></i>
                </div>
            </div>
            <div class="flex items-end">
                <span class="text-3xl font-bold mr-2 text-gray-800">{{ $proprietaires }}</span>

            </div>
            <p class="text-gray-600 text-sm mt-2">Total des proprietaires dans l'application</p>
            <div class="mt-4 bg-rose-50 h-1 rounded-full overflow-hidden">
                <div class="bg-blue-600 h-1 rounded-full" style="width: {{ ($proprietaires/ ($proprietaires+$joueurs)) * 100 }}%"></div>
            </div>
        </div>

        <!-- Nouveaux Terrains -->
        <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-[#580a21] transition-all duration-300 shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-800">Terrains Active</h3>
                <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center">
                    <i class="fas fa-plus-circle text-green-600"></i>
                </div>
            </div>
            <div class="flex items-end">
                <span class="text-3xl font-bold mr-2 text-gray-800">{{ $ActiveTerrains }}</span>

            </div>
            <p class="text-gray-600 text-sm mt-2">Total des commentaires dans votre compte</p>
            <div class="mt-4 bg-rose-50 h-1 rounded-full overflow-hidden">
                <div class="bg-green-600 h-1 rounded-full" style="width: {{ ($ActiveTerrains / count($allTerrains)) * 100 }}%"></div>
            </div>
        </div>
    </div>

    <!-- Detailed Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Terrains par Taux de Réservation -->
        <div class="col-span-1 lg:col-span-2 bg-white rounded-lg p-6 border border-gray-200 shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-800">Terrains par Taux de Réservation</h3>
                <div class="w-10 h-10 rounded-full bg-[#580a21]/20 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-[#580a21]"></i>
                </div>
            </div>

            <!-- Graphique circulaire -->
            <div class="mt-6 flex h-[70%] justify-center">
                <canvas id="reservationChart" class="w-full max-w-xs h-[348px]"></canvas>
            </div>


            <div class="mt-6 p-4 bg-rose-50 rounded-lg">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center mr-3">
                        <i class="fas fa-arrow-trend-up text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">{{ $depassedFiveReservations }} terrains dépassent 5 réservations</h4>
                    </div>
                </div>
            </div>
        </div>



        <!-- Liste des derniers terrains ajoutés -->
        <div class="bg-white rounded-lg p-6 border border-gray-200 shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-800">Nouveaux Terrains</h3>
                <a class="text-xs text-[#580a21]" href="{{ route('admin.terrains.index') }}">Voir tout</a>
            </div>

            <div class="space-y-4">
                @forelse($allTerrains->take(4) as $terrain)
                <div class="bg-rose-50 rounded-lg p-3 hover:bg-rose-100 transition-all">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-md bg-green-600/20 flex items-center justify-center mr-3">
                                <i class="fas fa-futbol text-green-600"></i>
                            </div>
                            <div>
                                <a href="{{ route('admin.terrain.show',$terrain->id) }}" class="font-medium text-gray-800 ">{{ $terrain->name }}</a>
                                <p class="text-xs text-gray-600">{{ $terrain->city}}, {{ $terrain->adress }}</p>
                            </div>
                        </div>
                        @if($terrain->created_at->diffInDays(now()) < 7)
                            <div class="text-xs bg-green-600/20 text-green-600 px-2 py-1 rounded">Nouveau
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 py-4">
                Aucun terrain disponible
            </div>
            @endforelse


        </div>
    </div>
</div>



<!-- Action Buttons -->
<div class="flex flex-wrap justify-center gap-4 mt-8">

    <button onclick="reloadPage()" class="bg-rose-50 text-gray-800 px-6 py-3 rounded-lg hover:bg-rose-100 transition-all flex items-center">
        <i class="fas fa-sync-alt mr-2"></i>
        Actualiser les données
    </button>

</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function reloadPage() {
        location.reload();
    };
    const data = {
        noReservations: '{{ json_encode($noReservations ?? 0) }}',
        oneToFourReservations: '{{ json_encode($oneToFourReservations ?? 0) }}',
        fiveToTenReservations: '{{ json_encode($fiveToTenReservations ?? 0) }}',
        moreThanTenReservations: '{{ json_encode($moreThanTenReservations ?? 0) }}',
    };

    const ctx = document.getElementById('reservationChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'Plus de 10 réservations',
                '5 à 10 réservations',
                '1 à 4 réservations',
                'Aucune réservation'
            ],
            datasets: [{
                label: 'Terrains',
                data: [
                    data.moreThanTenReservations,
                    data.fiveToTenReservations,
                    data.oneToFourReservations,
                    data.noReservations
                ],
                backgroundColor: [
                    '#580a21',
                    '#580a21cc',
                    '#580a2199',
                    '#6b7280'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#374151',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>


@endsection