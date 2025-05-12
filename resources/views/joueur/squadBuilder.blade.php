@extends('Layout.guest')
@section('title', 'Créer un Squad')
@section('content')

<!-- Section principale - Mobile-first approach -->
<section class="w-full min-h-screen relative">
    <!-- Image de fond - Optimisée pour tous les écrans -->
    <div class="relative w-full h-full">
        <img
            src="../assets/img/stud-red.svg"
            class="fixed w-full h-screen object-cover z-[-3] brightness-[40%] md:brightness-[50%]"
            alt="Background" />
    </div>

    <!-- Conteneur principal centré -->
    <div class="flex justify-center items-center px-4 py-8 min-h-screen">
        <!-- Formulaire - Responsive avec marges adaptées -->
        <form action="{{ route('joueur.squadBuilder.store') }}" method="post"
            class="w-full max-w-md mx-auto bg-[#685f5fe8] p-5 sm:p-8 rounded-lg shadow-lg">
            @csrf
            <h2 class="text-xl sm:text-2xl font-bold text-white mb-4 sm:mb-6">Créer votre squad</h2>

            <!-- Affichage des erreurs générales -->
            @if($errors->any())
            <div class="mb-4 p-3 sm:p-4 bg-red-100 border border-red-400 text-red-700 rounded text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li id="error">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Nom du squad - Optimisé pour mobile -->
            <div class="mb-4">
                <label for="name_squad" class="block text-sm font-medium text-[#d8d9dd] mb-1">
                    Nom du squad <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name_squad"
                    id="name_squad"
                    class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]"
                    required />
            </div>

            <!-- Ville - Optimisé pour mobile -->
            <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-[#d8d9dd] mb-1">
                    Ville <span class="text-red-500">*</span>
                </label>
                <select
                    id="city"
                    name="city"
                    class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]"
                    required>
                    <option value="">Sélectionnez une ville</option>
                </select>
            </div>

            <!-- Formation - Optimisé avec boutons plus grands sur mobile -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-[#d8d9dd] mb-2">
                    Formation <span class="text-red-500">*</span>
                </label>
                <input type="text" id="formation" name="formation" class="hidden" />

                <div class="flex justify-center gap-2 sm:gap-4 mt-2 flex-wrap">
                    <button
                        type="button"
                        id="formation_121"
                        onclick="selectFormation(121)"
                        class="bg-transparent text-[#d8d9dd] font-semibold py-2 px-3 sm:px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21] transition-colors duration-200 text-sm sm:text-base">
                        1-2-1
                    </button>
                    <button
                        type="button"
                        id="formation_331"
                        onclick="selectFormation(331)"
                        class="bg-transparent text-[#d8d9dd] font-semibold py-2 px-3 sm:px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21] transition-colors duration-200 text-sm sm:text-base">
                        3-3-1
                    </button>
                    <button
                        type="button"
                        id="formation_433"
                        onclick="selectFormation(433)"
                        class="bg-transparent text-[#d8d9dd] font-semibold py-2 px-3 sm:px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21] transition-colors duration-200 text-sm sm:text-base">
                        4-3-3
                    </button>
                </div>

                <!-- Message d'erreur pour formation -->
                <div class="error">
                    <p id="selectError" class="text-red-500 mt-2 text-sm"></p>
                </div>
            </div>

            <!-- Position - Optimisé pour mobile -->
            <div class="mb-5">
                <label for="position" class="block text-sm font-medium text-[#d8d9dd] mb-1">
                    Position <span class="text-red-500">*</span>
                </label>
                <select
                    onclick="checkIfFormationSet()"
                    id="position"
                    name="position"
                    class="w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]"
                    required>
                    <option value="">Sélectionnez votre position</option>
                </select>
            </div>

            <!-- Bouton Submit - Plus grand et plus accessible sur mobile -->
            <button
                type="submit"
                class="w-full bg-[#d8d9dd] text-[#19222b] font-semibold py-3 px-4 border border-[#d8d9dd] rounded-md hover:bg-[#580a21] hover:text-white transition-colors duration-300 text-sm sm:text-base">
                Continuer
            </button>
        </form>
    </div>
</section>

<!-- Scripts -->
<script src="{{ asset('js/morrocaineCities.js') }}"></script>
<script>
    let inputFormation = document.getElementById("formation");
    const positionSelect = document.getElementById("position");

    const formationPositions = {
        '121': ['GK', 'CB', 'RM', 'LM', 'ST'],
        '331': ['GK', 'CBR', 'CBL', 'LM', 'RM', 'ST'],
        '433': ['GK', 'CBR', 'CBL', 'LB', 'RB', 'CDMR', 'CM', 'CDML', 'RW', 'ST', 'LW']
    };

    function selectFormation(formation) {
        inputFormation.value = formation;

        document.getElementById("selectError").style.display = "none";

        // Clear existing options
        positionSelect.innerHTML = '<option value="">Sélectionnez votre position</option>';

        // Add new options based on formation
        formationPositions[formation].forEach(position => {
            const option = document.createElement('option');
            if (position === 'CBR') {
                option.textContent = 'CB (Right)';
            } else if (position === 'CBL') {
                option.textContent = 'CB (Left)';
            } else if (position === 'CDMR') {
                option.textContent = 'CDM (Right)';
            } else if (position === 'CDML') {
                option.textContent = 'CDM (Left)';
            } else {
                option.textContent = position;
            }

            option.value = position;
            positionSelect.appendChild(option);
        });

        // Reset all formation buttons
        document.getElementById("formation_121").style.backgroundColor = "transparent";
        document.getElementById("formation_331").style.backgroundColor = "transparent";
        document.getElementById("formation_433").style.backgroundColor = "transparent";

        // Highlight selected formation button
        if (formation == 121) {
            document.getElementById("formation_121").style.backgroundColor = "#580a21";
        } else if (formation == 331) {
            document.getElementById("formation_331").style.backgroundColor = "#580a21";
        } else if (formation == 433) {
            document.getElementById("formation_433").style.backgroundColor = "#580a21";
        }
    }

    function checkIfFormationSet() {
        if (inputFormation.value === "") {
            document.getElementById("selectError").innerHTML = "Veuillez sélectionner une formation avant de choisir une position.";
            document.getElementById("selectError").style.display = "block";
        }
    }

    // Initialize Moroccan cities when the document loads
    document.addEventListener('DOMContentLoaded', function() {
        // Check if the function exists in morrocaineCities.js
        if (typeof initMoroccanCities === 'function') {
            initMoroccanCities('city');
        }
    });
</script>
@endsection