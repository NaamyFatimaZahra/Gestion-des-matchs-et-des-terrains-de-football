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
    <h2 class="text-2xl font-bold text-white mb-6">Créer votre terrain</h2>
      <!-- Affichage des erreurs générales -->
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    <div class="mb-4">
        <label for="name_sqaud" class="block text-sm font-medium text-[#d8d9dd]">Nom du terrain : <span class="text-red-500">*</span></label>
        <input
            type="text"
            name="name_sqaud"
            id="name_sqaud"
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
            <button
            id="formation_121"
                onclick="selectFormation(121)"
                class="bg-transparent text-[#d8d9dd] font-semibold py-2 px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21]"
            >
                1-2-1
            </button>
            <button
            id="formation_331"
                onclick="selectFormation(331)"
                class="bg-transparent text-[#d8d9dd] font-semibold py-2 px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21]"
            >
                3-3-1
            </button>
            <button
            id="formation_433"
                onclick="selectFormation(433)"
                class="bg-transparent text-[#d8d9dd] font-semibold py-2 px-4 border border-[#d8d9dd] rounded hover:bg-[#580a21]"
            >
                4-3-3
            </button>
           
        </div>
       
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
    function selectFormation(formation){
        document.getElementById("formation").value = formation;
       
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
     </script>
   



 
@endsection