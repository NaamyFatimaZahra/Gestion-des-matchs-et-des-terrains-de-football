@extends('Layout.guest')
@section('title', 'Liste des Terrains')
@section('content')

      <!-- principe squad Page -->
      <section class="w-[100%] flex justify-center  min-h-[100vh] relative">
        <!-- image terain -->
        <div class="relative md:w-[100%] w-[100%] h-full">
          <img
            src="../assets/img/stud-red.svg"
            class="fixed w-[100%] h-[100vh] object-cover z-[-3] md:brightness-[50%]"
            alt=""
          />


      <div class="flex justify-center items-center min-h-[100vh]">
  <form action="{{ route('joueur.squadBuilder.store') }}" method="post" class="w-[100%] max-w-md mx-auto my-auto bg-[#685f5fe8] p-8 rounded-md">
    @csrf
    <h2 class="text-2xl font-bold text-white mb-6">Créer votre squad</h2>
      <!-- Affichage des erreurs générales -->
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li id="error">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    <div class="mb-4">
        <label for="name_squad" class="block text-sm font-medium text-[#d8d9dd]">Nom du squad : <span class="text-red-500">*</span></label>
        <input
            type="text"
            name="name_squad"
            id="name_squad"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]"
            required
        />
    </div>
    
    
    <div class="mb-4">
        <label for="city" class="block text-sm font-medium text-[#d8d9dd]">Ville : <span class="text-red-500">*</span></label>
        <select id="city" name="city" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
            <option value="">Sélectionnez une ville</option>
        </select>
    </div>
    
    <div class="mb-6">
        <label class="block text-sm font-medium text-[#d8d9dd]">Formation : <span class="text-red-500">*</span></label>
        <input type="text" id="formation" name="formation" class="hidden" />
        <div class="flex justify-center gap-4 mt-2 flex-wrap">
            <p
            id="formation_121"
                onclick="selectFormation(121)"
                class="bg-transparent text-[#d8d9dd] font-semibold py-2 px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21]"
            >
                1-2-1
            </p>
            <p
            id="formation_331"
                onclick="selectFormation(331)"
                class="bg-transparent text-[#d8d9dd] font-semibold py-2 px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21]"
            >
                3-3-1
            </p>
            <p
            id="formation_433"
                onclick="selectFormation(433)"
                class="bg-transparent text-[#d8d9dd] font-semibold py-2 px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21]"
            >
                4-3-3
            </p>
           
        </div>
         <div class="error">
            <p id="selectError" class="text-red-500 mt-2"></p>
        </div>
       
    </div>
    <!-- position -->
     
     <div class="mb-4">
        <label for="position" class="block text-sm font-medium text-[#d8d9dd]">Position : <span class="text-red-500">*</span></label>
        <select onclick="checkIfFormationSet()" id="position" name="position" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#580a21]" required>
            <option value="">Sélectionnez votre position</option>
        </select>
       
       
    </div>
    <input
         
        class="w-full bg-[#d8d9dd] text-[#19222b] font-semibold py-2 px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21] hover:text-white"
        type="submit"
        value="Continuer"
       
    />
</form>
      </div>
 
       

      </section>

   
    
    <script src="{{ asset('js/morrocaineCities.js') }}"></script>
     <script>
        let inputFormation =  document.getElementById("formation");
        const formationPositions = {
    '121': ['GK', 'CB', 'RM', 'LM', 'ST'],
    '331': ['GK', 'CB', 'RB', 'LB', 'CM', 'RM', 'LM', 'ST'],
    '433': ['GK', 'CBR', 'CBL', 'LB', 'RB', 'CDMR', 'CM','CDML' ,'RW', 'ST', 'LW']
};
    function selectFormation(formation){
       
     
        const positionSelect = document.getElementById("position");
        inputFormation.value = formation;
          document.getElementById("selectError").style.display = "none"; 
    
    // Clear existing options
    positionSelect.innerHTML = '<option value="">Sélectionnez votre position</option>';
    
    // Add new options based on formation
    formationPositions[formation].forEach(position => {
        const option = document.createElement('option');
        option.value = position;
        option.textContent = position;
        positionSelect.appendChild(option);
    });

       
        if(formation == 121){
            document.getElementById("formation_121").style.backgroundColor =  "#580a21";
            document.getElementById("formation_433").style.backgroundColor = "#685f5fe8";
            document.getElementById("formation_331").style.backgroundColor = "#685f5fe8";
        }else if(formation == 331){
            document.getElementById("formation_331").style.backgroundColor = "#580a21";
            document.getElementById("formation_121").style.backgroundColor = "#685f5fe8";
            document.getElementById("formation_433").style.backgroundColor = "#685f5fe8";
        }else if(formation == 433){
         document.getElementById("formation_433").style.backgroundColor = "#580a21";
        document.getElementById("formation_121").style.backgroundColor = "#685f5fe8";
        document.getElementById("formation_331").style.backgroundColor = "#685f5fe8";
        }
      
    }


    function checkIfFormationSet() {
        
        if (inputFormation.value ==="") {
           document.getElementById("selectError").innerHTML = "Veuillez sélectionner une formation avant de choisir une position.";
             
        }
        
        }
     </script>
   



 
@endsection