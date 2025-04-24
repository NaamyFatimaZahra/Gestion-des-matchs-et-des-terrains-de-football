@extends('Layout.guest')
@section('title', 'Liste des Terrains')
@section('content')

      <!-- principe squad Page -->
      <section class="w-[100%] flex justify-center min-h-[100vh] relative">
        <!-- image terain -->
        <div class="relative  md:w-[100%] w-[100%] h-full">
          <img
            src="{{ asset('assets/img/stud-red.svg') }}"
            class="fixed w-[100%] h-[100vh] object-cover z-[-3] md:brightness-[50%]"
            alt=""
          />

       <!-- Header Squad Info - NOUVELLE SECTION -->
<div class="w-full md:w-[80%] z-10 mb-8 mt-[8rem] m-auto">
    <div class="bg-gradient-to-r from-[#580a21]/90 to-[#400618]/95 p-6 rounded-lg shadow-xl backdrop-blur-sm text-white">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $squad->name_squad }}</h1>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <i class="fa-solid fa-location-dot mr-2"></i>
                        <span id="city">{{ $squad->city }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-users mr-2"></i>
                        <span>Formation: {{ $squad->formation }}</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center md:items-end">
                <div class="bg-[#580a21]/80 px-4 py-2 rounded-full mb-2">
                    <span class="font-semibold">{{ $squad->matches_played ?? 0 }} matches joués</span>
                </div>
                <div class="flex space-x-2">
                    <span class="bg-[#4a0a1b]/90 px-3 py-1 rounded-full text-sm">{{ $squad->wins ?? 0 }} V</span>
                    <span class="bg-[#580a21]/70 px-3 py-1 rounded-full text-sm">{{ $squad->draws ?? 0 }} N</span>
                    <span class="bg-[#6b0c28]/90 px-3 py-1 rounded-full text-sm">{{ $squad->losses ?? 0 }} D</span>
                </div>
            </div>
        </div>
    </div>
</div>
          

<!-- Formation 1-2-1 equipe 1 -->

<div
  id="list_main_players_121"
  class="grid grid-cols-5 min-h-[100vh] py-16 md:py-32 relative grid-rows-4 md:bg-transparent bg-[#5f4a4a92] gap-x-[4%] w-[100%] bg-cover bg-no-repeat"
>
  <!-- Gardien de but (GK) - Now at top -->
  <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-3 col-span-1 row-start-1 row-span-1 justify-self-center self-start">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1)">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>GK</p>
    </div>
  </div>

  <!-- Défenseur central (CB) -->
  <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-3 col-span-1 row-start-2 row-span-2 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1)">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>CB</p>
    </div>
  </div>

  <!-- Milieu droit (RM) - Now on the left side -->
  <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-2 col-span-1 row-start-2 row-span-2 justify-self-center self-end">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1)">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>RM</p>
    </div>
  </div>

  <!-- Milieu gauche (LM) - Now on the right side -->
  <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-4 col-span-1 row-start-2 row-span-2 justify-self-center self-end">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1)">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>LM</p>
    </div>
  </div>

  <!-- Attaquant (ST) - Moved to bottom -->
  <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-3 col-span-1 row-start-4 row-span-1 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1)">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>ST</p>
    </div>
  </div>
</div>
 
 <!-- Formation 3-3-1 -->
    <div
    id="list_main_players_331"
    class="hidden grid grid-cols-7 min-h-[100vh] py-16 md:py-32 relative grid-rows-5 md:bg-transparent bg-[#5f4a4a92] gap-x-[4%] md:w-[80%] w-[100%] bg-cover bg-no-repeat"
    >
    <!-- Gardien de but (GK) -->
    <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-4 col-span-1 row-start-5 row-span-1 justify-self-center self-start">
        <img src="../assets/img/card.png" class="" alt="" />
        <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('GK_331')">
        <i class="fa-solid fa-plus text-[1.6rem]"></i>
        </div>
        <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
        >
        <p>GK</p>
        </div>
    </div>

    <!-- Défenseur central (CB) -->
    <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-4 col-span-1 row-start-4 row-span-1 justify-self-center self-end">
        <img src="../assets/img/card.png" class="" alt="" />
        <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('CB_331')">
        <i class="fa-solid fa-plus text-[1.6rem]"></i>
        </div>
        <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
        >
        <p>CB</p>
        </div>
    </div>

    <!-- Défenseur droit (RB) -->
    <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-6 col-span-1 row-start-4 row-span-2 justify-self- self-start">
        <img src="../assets/img/card.png" class="" alt="" />
        <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('RB_331')">
        <i class="fa-solid fa-plus text-[1.6rem]"></i>
        </div>
        <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
        >
        <p>RB</p>
        </div>
    </div>

    <!-- Défenseur gauche (LB) -->
    <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-2 col-span-1 row-start-4 row-span-1 justify-self-center self-end">
        <img src="../assets/img/card.png" class="" alt="" />
        <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('LB_331')">
        <i class="fa-solid fa-plus text-[1.6rem]"></i>
        </div>
        <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
        >
        <p>LB</p>
        </div>
    </div>

    <!-- Milieu central (CM) -->
    <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-4 col-span-1 row-start-3 row-span-1 justify-self-center self-center">
        <img src="../assets/img/card.png" class="" alt="" />
        <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('CM_331')">
        <i class="fa-solid fa-plus text-[1.6rem]"></i>
        </div>
        <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
        >
        <p>CM</p>
        </div>
    </div>

    <!-- Milieu droit (RM) -->
    <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-6 col-span-1 row-start-2 row-span-1 justify-self-center self-end">
        <img src="../assets/img/card.png" class="" alt="" />
        <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('RM_331')">
        <i class="fa-solid fa-plus text-[1.6rem]"></i>
        </div>
        <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
        >
        <p>RM</p>
        </div>
    </div>

    <!-- Milieu gauche (LM) -->
    <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-2 col-span-1 row-start-2 row-span-1 justify-self-center self-center">
        <img src="../assets/img/card.png" class="" alt="" />
        <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('LM_331')">
        <i class="fa-solid fa-plus text-[1.6rem]"></i>
        </div>
        <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
        >
        <p>LM</p>
        </div>
    </div>

    <!-- Attaquant (ST) -->
    <div class="relative w-[5rem] md:w-[7rem] h-fit col-start-4 col-span-1 row-start-1 row-span-2 justify-self-center self-center">
        <img src="../assets/img/card.png" class="" alt="" />
        <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('ST_331')">
        <i class="fa-solid fa-plus text-[1.6rem]"></i>
        </div>
        <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
        >
        <p>ST</p>
        </div>
    </div>
    </div>


  <!-- POP UP-->
      <div
        id="container_groupe_player"
        class="bg-[#e8e8ff4c] w-full h-[100vh] hidden  fixed top-0"
      >
        <div
          class="relative w-[80%] md:w-[30%] m-auto md:h-[50%] h-[40%] bg-[#000000b5] rounded-xl overflow-hidden"
        >
          <img
            src="{{ asset('assets/img/pop_up.jpg') }}"
            alt=""
            class="absolute w-full z-[-5]"
          />
          <button
            onclick="closeContainerGroupePlayer()"
            class="pt-[1rem] pr-[1rem] text-[1.4rem] h-[20%] w-[97%] text-end text-white"
          >
            <i class="fa-solid fa-xmark"></i>
          </button>
          <div
            id="content_pop_up"
            class="flex flex-col flex-wrap h-[80%] px-7 justify-center items-center gap-8 text-white overflow-scroll no-scrollbar"
          >
          
        </div>
        </div>
      </div>
  

      <script>
        const containerGroupePlayer = document.getElementById('container_groupe_player');
       


function openContainerGroupePlayer(equipe) {
  const city = document.getElementById('city').innerText;

  const contentPopUp = document.getElementById('content_pop_up');
    
   
   

    
    const containerGroupePlayer = document.getElementById('container_groupe_player');
    containerGroupePlayer.classList.add('flex');
    containerGroupePlayer.classList.remove('hidden');
      fetch("{{ route('joueur.squad.players') }}", {
        method: "GET",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
    })
    .then(response => {
        if (!response.ok) throw new Error('Erreur réseau');
        return response.json();
    })
    .then(data => console.log(data))
    .catch(error => console.error("Erreur :", error));
}




        function closeContainerGroupePlayer(){
          containerGroupePlayer.classList.remove('flex');
          containerGroupePlayer.classList.add('hidden');
        }
      </script>


<!-- <div class="relative group w-fit h-fit bg-no-repeat overfow-hidden">
   <div class="absolute top-0   h-[100%] w-[100%] right-0 z-10 hidden group-hover:flex justify-center items-center">
         <button
         onclick="addNewPlayer(${id},${place},'${position}')"
         class="bg-[#70182ee6] capitalize rounded-md px-6 py-2">add</button>
         </div>
          <img src="../assets/img/bg-card.png" class="group-hover:brightness-[35%]" alt="" />
          <div
            class="text-white group-hover:brightness-[20%] w-[67%] md:h-[15rem] absolute top-[50%] left-[43%] md:left-[50%] translate-x-[-50%] translate-y-[-50%]"
          >
            <div
              class="flex items-center text-[black] justify-center pt-6 pl-[1.3rem]"
            >
              <div class="">
                <p class="">${position}</p>
                 <p>${rating}</p>
              </div>
              <img
                src="${img}"
                alt=""
              />
            </div>
            
            <div class="flex justify-center items-center">
              <p class="text-center text-black text-[10px]">${name}</p>
              <img class="w-4 h-4" src="${flag}" alt="" />
            </div>
            <div
              class="flex flex-wrap justify-center pt-[14px] w-[6rem] m-auto gap-x-3 text-[0.6rem]"
            >
              <div class="text-[#513608a0] flex gap-1 font-semibold">
                <p class="uppercase">pac:</p>
                <p>${pace}</p>
              </div>
              <div class="text-[#513608a0] flex gap-1 font-semibold">
                <p class="uppercase">sho:</p>
                <p>${shooting}</p>
              </div>
              <div class="text-[#513608a0] flex gap-1 font-semibold">
                <p class="uppercase">pas:</p>
                <p>${passing}</p>
              </div>

              <div class="text-[#513608a0] flex gap-1 font-semibold">
                <p class="uppercase">dri:</p>
                <p>${dribbling}</p>
              </div>
              <div class="text-[#513608a0] flex gap-1 font-semibold">
                <p class="uppercase">def:</p>
                <p>${defending}</p>
              </div>
              <div class="text-[#513608a0] flex gap-1 font-semibold">
                <p class="uppercase">phy:</p>
                <p>${physical}</p>
              </div>
               <img class="w-6 " src="${logo}" alt="" />
            </div>
          </div>
</div> -->
       




        
      </section>
      
 
@endsection


