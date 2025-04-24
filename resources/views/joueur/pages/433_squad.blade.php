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
           
                <div class="bg-[#580a21]/80 px-4 py-2 rounded-full mb-2">
                    <span class="font-semibold">{{ $players->count() }} Joueurs</span>
                     
                </div>
                 
              
                    <div class="flex items-center bg-[#4a0a1b]/90 px-4 py-2 rounded-lg">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium">{{ $squad->players()->where('acceptationUser', 'accepté')->count() }} acceptés</span>
                    </div>
                    <div class="flex items-center bg-[#580a21]/70 px-4 py-2 rounded-lg">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium">{{ $squad->players()->where('acceptationUser', 'en attente')->count() }} en attente</span>
                    </div>
              
                 <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <button class="bg-[#70182e] text-white px-5 py-3 rounded-lg hover:bg-[#580a21] transition-all duration-300 flex items-center justify-center" onclick="openContainerGroupePlayer(0, 'null')">
                        <i class="fa-solid fa-trash-alt mr-2"></i> Supprimer
                    </button>
                    
                   
                    <button class="bg-[#4c8c50] text-white px-5 py-3 rounded-lg hover:bg-[#3a6a3d] transition-all duration-300 flex items-center justify-center">
                        <i class="fa-solid fa-calendar-plus mr-2"></i> Réserver un terrain
                    </button>
                  
                </div>
               
           
        </div>
    </div>
</div>

 <!--  Formation 4-3-3 equipe 1-->
  <div id="list_main_players_433"
    class=" grid grid-cols-7 min-h-[100vh] py-16 md:py-32 relative grid-rows-5 md:bg-transparent bg-[#5f4a4a92] gap-x-[4%] md:w-[100%] w-[100%] bg-cover bg-no-repeat"
  >
       
        <!-- Gardien de but (GK) -->
    
           @php
  $gkPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'GK' &&
             $player->pivot->equipe === "1";
  });
    @endphp
  @if (!empty($gkPlayer))
   <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-5 row-span-1 justify-self-center self-start">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col ">
      @if ($gkPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
            <i class="fa-solid fa-trash"></i>
        </button>
        @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
           <i class="fa-solid fa-lock"></i>
        </button>
        @endif
      
    </div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($gkPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-clock text-white text-xs"></i>
    </div>
    @endif
      <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%] " onclick="">
                    <div class="flex items-center justify-center  text-black pt-6">
                      <img
                          src="{{ $gkPlayer->profile_picture ? asset('storage/' . $gkPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                          alt="Player image"
                          class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]"
                      />
                    </div>
                    
                    <div class="flex justify-center items-center ">
                      <p class="text-center text-black text-[12px] font-semibold">{{ $gkPlayer->name }}</p>
                    </div>
                    <div class="flex justify-center items-center pb-6">
                      <p class="text-center text-black text-[13px]">{{ $gkPlayer->city }}</p>
                    </div>
                  
      </div>
      <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
      >
        <p class="">{{ $gkPlayer->pivot->position }}</p>
      </div>
  </div>
  @else
   <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-5 row-span-1 justify-self-center self-start">
        <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
        <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1,'GK')">
            <i class="fa-solid fa-plus text-[1.6rem]"></i>
        </div>
        <div
            class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
        >
            <p>GK</p>
        </div>
        </div>
  @endif

        <!-- Défenseur central (CB) 1 -->
      @php
  $cb1Player = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'CB' &&
             $player->pivot->equipe === "1" &&
             $player->pivot->side === "R"; // Right CB
  });
@endphp
@if (!empty($cb1Player))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-5 col-span-1 row-start-4 row-span-1 justify-self-center self-end">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($cb1Player->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($cb1Player->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $cb1Player->profile_picture ? asset('storage/' . $cb1Player->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $cb1Player->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $cb1Player->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $cb1Player->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-5 col-span-1 row-start-4 row-span-1 justify-self-center self-end">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('CBR')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>CB</p>
    </div>
  </div>
@endif


        <!-- Défenseur central (CB) 2 -->
       @php
  $cb2Player = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'CB' &&
             $player->pivot->equipe === "1" &&
             $player->pivot->side === "L"; // Left CB
  });
@endphp
@if (!empty($cb2Player))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-4 row-span-1 justify-self-center self-end">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($cb2Player->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($cb2Player->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $cb2Player->profile_picture ? asset('storage/' . $cb2Player->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $cb2Player->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $cb2Player->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $cb2Player->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-4 row-span-1 justify-self-center self-end">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('CBL')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>CB</p>
    </div>
  </div>
@endif


        <!-- Arrière latéral gauche (LB) -->
       @php
  $lbPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'LB' &&
             $player->pivot->equipe === "1";
  });
      @endphp
@if (!empty($lbPlayer))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-1 col-span-2 row-start-3 row-span-2 justify-self-center self-center">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($lbPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($lbPlayer->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $lbPlayer->profile_picture ? asset('storage/' . $lbPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $lbPlayer->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $lbPlayer->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $lbPlayer->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-1 col-span-2 row-start-3 row-span-2 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('LB')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>LB</p>
    </div>
  </div>
@endif


        <!-- Arrière latéral droit (RB) -->
        @php
  $rbPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'RB' &&
             $player->pivot->equipe === "1";
  });
@endphp
@if (!empty($rbPlayer))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-6 col-span-2 row-start-3 row-span-2 justify-self-center self-center">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($rbPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($rbPlayer->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $rbPlayer->profile_picture ? asset('storage/' . $rbPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $rbPlayer->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $rbPlayer->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $rbPlayer->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-6 col-span-2 row-start-3 row-span-2 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('RB')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>RB</p>
    </div>
  </div>
@endif


        <!-- Milieu défensif (CDM) 1 -->
       @php
  $cdm1Player = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'CDM' &&
             $player->pivot->equipe === "1" &&
             $player->pivot->side === "R"; // Right CDM
  });
@endphp
@if (!empty($cdm1Player))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-5 col-span-2 row-start-2 row-span-2 justify-self-center self-center">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($cdm1Player->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($cdm1Player->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $cdm1Player->profile_picture ? asset('storage/' . $cdm1Player->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $cdm1Player->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $cdm1Player->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $cdm1Player->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-5 col-span-2 row-start-2 row-span-2 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('CDM')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>CDM</p>
    </div>
  </div>
@endif


        <!-- Milieu central (CM) -->
        @php
  $cmPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'CM' &&
             $player->pivot->equipe === "1";
  });
@endphp
@if (!empty($cmPlayer))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-3 row-span-1 justify-self-center self-start">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($cmPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($cmPlayer->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $cmPlayer->profile_picture ? asset('storage/' . $cmPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $cmPlayer->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $cmPlayer->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $cmPlayer->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-3 row-span-1 justify-self-center self-start">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('CM')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>CM</p>
    </div>
  </div>
@endif


        <!-- Milieu défensif (CDM) 2 -->
       @php
  $cdm2Player = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'CDM' &&
             $player->pivot->equipe === "1" &&
             $player->pivot->side === "L"; // Left CDM
  });
@endphp
@if (!empty($cdm2Player))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-2 col-span-2 row-start-2 row-span-2 justify-self-center self-center">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($cdm2Player->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($cdm2Player->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $cdm2Player->profile_picture ? asset('storage/' . $cdm2Player->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $cdm2Player->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $cdm2Player->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $cdm2Player->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-2 col-span-2 row-start-2 row-span-2 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('CDM2')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>CDM</p>
    </div>
  </div>
@endif


        <!-- Ailier droit (RW) -->
       @php
  $rwPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'RW' &&
             $player->pivot->equipe === "1";
  });
@endphp
@if (!empty($rwPlayer))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-5 col-span-2 row-start-1 row-span-2 justify-self-center self-start">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($rwPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($rwPlayer->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $rwPlayer->profile_picture ? asset('storage/' . $rwPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $rwPlayer->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $rwPlayer->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $rwPlayer->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-5 col-span-2 row-start-1 row-span-2 justify-self-center self-start">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('RW')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>RW</p>
    </div>
  </div>
@endif


        <!-- Attaquant (ST) -->
       @php
  $stPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'ST' &&
             $player->pivot->equipe === "1";
  });
@endphp
@if (!empty($stPlayer))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-1 row-span-2 justify-self-center self-center">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($stPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($stPlayer->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $stPlayer->profile_picture ? asset('storage/' . $stPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $stPlayer->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $stPlayer->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $stPlayer->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-1 row-span-2 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('ST')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>ST</p>
    </div>
  </div>
@endif


        <!-- Ailier gauche (LW) -->
      @php
  $lwPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'LW' &&
             $player->pivot->equipe === "1";
  });
@endphp
@if (!empty($lwPlayer))
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-2 col-span-2 row-start-1 row-span-2 justify-self-center self-start">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col">
      @if ($lwPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-trash"></i>
        </button>
      @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem]">
          <i class="fa-solid fa-lock"></i>
        </button>
      @endif
    </div>
    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
    @if($lwPlayer->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif
    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
      <div class="flex items-center justify-center text-black pt-6">
        <img src="{{ $lwPlayer->profile_picture ? asset('storage/' . $lwPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}" alt="Player image" class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $lwPlayer->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $lwPlayer->city }}</p>
      </div>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>{{ $lwPlayer->pivot->position }}</p>
    </div>
  </div>
@else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-2 col-span-2 row-start-1 row-span-2 justify-self-center self-start">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="checkCardEmpty('LW')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>LW</p>
    </div>
  </div>
@endif

  </div>


 <!-- Formation 1-2-1 equipe 2-->
<div
  id="list_main_players_121"
  class="grid grid-cols-5 min-h-[100vh] py-14  relative grid-rows-4 md:bg-transparent bg-[#5f4a4a92] gap-x-[4%] w-[100%] bg-cover bg-no-repeat"
>
<!-- Gardien de but (GK) -->
    @php
  $gkPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'GK' &&
             $player->pivot->equipe === "2";
  });
    @endphp
  @if (!empty($gkPlayer))
  <div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-4 row-span-1 justify-self-center self-start">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col ">
      @if ($gkPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
            <i class="fa-solid fa-trash"></i>
        </button>
        @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
           <i class="fa-solid fa-lock"></i>
        </button>
        @endif
      
    </div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($gkPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-clock text-white text-xs"></i>
    </div>
    @endif
      <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%] " onclick="">
                    <div class="flex items-center justify-center  text-black pt-6">
                      <img
                          src="{{ $gkPlayer->profile_picture ? asset('storage/' . $gkPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                          alt="Player image"
                          class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]"
                      />
                    </div>
                    
                    <div class="flex justify-center items-center ">
                      <p class="text-center text-black text-[12px] font-semibold">{{ $gkPlayer->name }}</p>
                    </div>
                    <div class="flex justify-center items-center pb-6">
                      <p class="text-center text-black text-[13px]">{{ $gkPlayer->city }}</p>
                    </div>
                  
      </div>
      <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
      >
        <p class="">{{ $gkPlayer->pivot->position }}</p>
      </div>
  </div>
  @else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-4 row-span-1 justify-self-center self-start">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'GK')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>GK</p>
    </div>
  </div>
  @endif

<!-- Défenseur central (CB) -->
    @php
  $cbPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'CB' &&
             $player->pivot->equipe === "2";
  });
    @endphp
  @if (!empty($cbPlayer))
    <div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-2 row-span-2 justify-self-center self-center">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col ">
      @if ($cbPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
            <i class="fa-solid fa-trash"></i>
        </button>
        @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
           <i class="fa-solid fa-lock"></i>
        </button>
        @endif
      
    </div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
      @if($cbPlayer->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
      @else
      <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
      @endif
      <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%] " onclick="">
                    <div class="flex items-center justify-center  text-black pt-6">
                      <img
                          src="{{ $cbPlayer->profile_picture ? asset('storage/' . $cbPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                          alt="Player image"
                          class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]"
                      />
                    </div>
                    
                    <div class="flex justify-center items-center ">
                      <p class="text-center text-black text-[12px] font-semibold">{{ $cbPlayer->name }}</p>
                    </div>
                    <div class="flex justify-center items-center pb-6">
                      <p class="text-center text-black text-[13px]">{{ $cbPlayer->city }}</p>
                    </div>
                  
      </div>
      <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
      >
        <p class="">{{ $cbPlayer->pivot->position }}</p>
      </div>
  </div>
  @else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-2 row-span-2 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'CB')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>CB</p>
    </div>
  </div>
  @endif



  <!-- Milieu droit (RM) -->
    @php
  $rmPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'RM' &&
             $player->pivot->equipe === "2";
  });
    @endphp
  @if (!empty($rmPlayer))
  {{-- Player card --}}
  <div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-2 row-span-1 justify-self-center self-center">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col ">
       @if ($rmPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
            <i class="fa-solid fa-trash"></i>
        </button>
        @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
           <i class="fa-solid fa-lock"></i>
        </button>
        @endif
      
    </div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($rmPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-clock text-white text-xs"></i>
    </div>
    @endif
      <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%] " onclick="">
                    <div class="flex items-center justify-center  text-black pt-6">
                      <img
                          src="{{ $rmPlayer->profile_picture ? asset('storage/' . $rmPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                          alt="Player image"
                          class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]"
                      />
                    </div>
                    
                    <div class="flex justify-center items-center ">
                      <p class="text-center text-black text-[12px] font-semibold">{{ $rmPlayer->name }}</p>
                    </div>
                    <div class="flex justify-center items-center pb-6">
                      <p class="text-center text-black text-[13px]">{{ $rmPlayer->city }}</p>
                    </div>
                  
      </div>
      <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
      >
        <p class="">{{ $rmPlayer->pivot->position }}</p>
      </div>
  </div>
  @else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-2 row-span-1 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'RM')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>RM</p>
    </div>
  </div>
  @endif


  <!-- Milieu gauche (LM) -->
    @php
  $lmPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'LM' &&
             $player->pivot->equipe === "2";
  });
    @endphp
  @if (!empty($lmPlayer))
  <div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-2 col-span-1 row-start-2 row-span-1 justify-self-center self-center">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col ">
       @if ($lmPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
            <i class="fa-solid fa-trash"></i>
        </button>
        @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
           <i class="fa-solid fa-lock"></i>
        </button>
        @endif
      
    </div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($lmPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-clock text-white text-xs"></i>
    </div>
    @endif
      <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%] " onclick="">
                    <div class="flex items-center justify-center  text-black pt-6">
                      <img
                          src="{{ $lmPlayer->profile_picture ? asset('storage/' . $lmPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                          alt="Player image"
                          class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]"
                      />
                    </div>
                    
                    <div class="flex justify-center items-center ">
                      <p class="text-center text-black text-[12px] font-semibold">{{ $lmPlayer->name }}</p>
                    </div>
                    <div class="flex justify-center items-center pb-6">
                      <p class="text-center text-black text-[13px]">{{ $lmPlayer->city }}</p>
                    </div>
                  
      </div>
      <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
      >
        <p class="">{{ $lmPlayer->pivot->position }}</p>
      </div>
  </div>
  @else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-2 col-span-1 row-start-2 row-span-1 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'LM')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>LM</p>
    </div>
  </div>
  @endif



  <!-- Attaquant (ST) -->
    @php
  $stPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'ST' &&
             $player->pivot->equipe === "2";
  });
    @endphp
  @if (!empty($stPlayer))
  
  <div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-1 row-span-1 justify-self-center self-center">
    <div class="absolute top-1 h-[100%] w-[100%] left-[77%] z-20 hidden group-hover:flex flex-col ">
       @if ($stPlayer->pivot->admin !== 1)
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
            <i class="fa-solid fa-trash"></i>
        </button>
        @else
        <button onclick="deletePlayer()" class="text-[white] bg-[#70182ee6] rounded-[50%] w-[2rem] h-[2rem] ">
           <i class="fa-solid fa-lock"></i>
        </button>
        @endif
      
    </div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($stPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 right-1 group-hover:hidden w-7 h-7
 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-clock text-white text-xs"></i>
    </div>
    @endif
      <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%] " onclick="">
                    <div class="flex items-center justify-center  text-black pt-6">
                      <img
                          src="{{ $stPlayer->profile_picture ? asset('storage/' . $stPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                          alt="Player image"
                          class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]"
                      />
                    </div>
                    
                    <div class="flex justify-center items-center ">
                      <p class="text-center text-black text-[12px] font-semibold">{{ $stPlayer->name }}</p>
                    </div>
                    <div class="flex justify-center items-center pb-6">
                      <p class="text-center text-black text-[13px]">{{ $stPlayer->city }}</p>
                    </div>
                  
      </div>
      <div
        class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
      >
        <p class="">{{ $stPlayer->pivot->position }}</p>
      </div>
  </div>
  @else
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-1 row-span-1 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" class="" alt="" />
    <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'ST')">
      <i class="fa-solid fa-plus text-[1.6rem]"></i>
    </div>
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>ST</p>
    </div>
  </div>
  @endif
 
</div>

  <!-- POP UP-->
      <div
        id="container_groupe_player"
        class="bg-[#e8e8ff4c] w-full h-[100vh] hidden  fixed top-0 z-30"
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
       const contentPopUp = document.getElementById('content_pop_up'); 

       let squadId = {{ $squad->id }};
       

   function openContainerGroupePlayer(equipe,position) {
    const contentPopUp = document.getElementById('content_pop_up');
    const containerGroupePlayer = document.getElementById('container_groupe_player');
    containerGroupePlayer.classList.add('flex');
    containerGroupePlayer.classList.remove('hidden');
    contentPopUp.innerHTML ="loading...";
   
      fetch("{{ route('joueur.squad.players',[$squad->city,$squad->id]) }}", {
        method: "GET",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
    })
    .then(response => {
        if (!response.ok) throw new Error('Erreur réseau');
        return response.json();
    })
    .then(data =>{
      
       showAllPlayers(data.players,equipe,position,data.playersExist);
       
       
    })
    .catch(error => console.error("Erreur :", error));
    }

   function showAllPlayers(players,equipe,position,playersExist) {
   contentPopUp.innerHTML = "";
   
   if (players.length === 0) {
        contentPopUp.innerHTML = "<p class='text-white'>Aucun joueur trouvé.</p>";
        return;
   } else {
         players.forEach(player => {
          let exist=false;
          if(playersExist){
            
            playersExist.forEach(playerExist => {
              if(player.id === playerExist.id){
                exist=true;
              }
            });
          }
            const profilePicture = player.profile_picture ? `http://127.0.0.1:8000/storage/${player.profile_picture}` : 'http://127.0.0.1:8000/storage/profile-pictures/blank-profile.webp';
          
            contentPopUp.innerHTML += `
            <div class="relative group w-fit h-fit bg-no-repeat overflow-hidden">
               <div class="absolute top-0 h-[100%] w-[100%] right-0 z-10 hidden group-hover:flex justify-center items-center">
               ${exist ?
                `<button
                  onclick=""
                  class="bg-[#70182ee6] capitalize rounded-md px-6 py-2 hover:bg-[#580a21]">Exist</button>` :
                 ` <button
                  onclick="addToSquad(${player.id},${equipe},'${position}')"
                  class="bg-[#70182ee6] capitalize rounded-md px-6 py-2 hover:bg-[#580a21]">Inviter</button>`}
                
               </div>
               <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%] h-[100%]" alt="" />
               <div class="text-white group-hover:brightness-[20%] w-[67%] md:h-[15rem] absolute top-[50%] left-[43%] md:left-[50%] translate-x-[-50%] translate-y-[-50%]">
                  <div class="flex items-center justify-center text-black pt-6">
                     <img
                        src="${profilePicture}"
                        alt="Player image"
                        class="w-[80%] h-[70%] object-contain rounded-md"
                     />
                  </div>
                  
                  <div class="flex justify-center items-center mt-4">
                     <p class="text-center text-black text-[18px] font-semibold">${player.name}</p>
                  </div>
                  <div class="flex justify-center items-center ">
                     <p class="text-center text-black text-[15px]">${player.city}</p>
                  </div>
                  <div class="flex justify-center items-center  ">
                     <p class="text-center text-black text-[15px] bg-[#70182ee6] text-[#fff] px-4 py-2 rounded-full ">${position}</p>
                  </div>
               </div>
            </div>
            `;
         });
       }  
     }
   
   function addToSquad(playerId,equipe,position) { 

           // Préparation des données à envoyer
    const formData = new URLSearchParams();
    formData.append('player_id', playerId);
    formData.append('equipe', equipe);
    formData.append('position', position);
    formData.append('squad_id', squadId); 
     formData.append('_token', '{{ csrf_token() }}'); 
    fetch("{{ route('joueur.squad.add') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: formData 
    })
    .then(response => {
        if (!response.ok) throw new Error('Erreur réseau');
        return response.json();
    })
    .then(data => {
     if(data){
 closeContainerGroupePlayer();
      window.location.reload();
     }
       
    })
    .catch(error => {
        console.error("Erreur :", error);
        contentPopUp.innerHTML = "<p class='text-center text-red-500'>Une erreur s'est produite lors de l'ajout du joueur</p>";
    });
      }

        function closeContainerGroupePlayer(){
          containerGroupePlayer.classList.remove('flex');
          containerGroupePlayer.classList.add('hidden');
        }
      </script>



       




        
      </section>
      
 
@endsection


