@extends('Layout.guest')
@section('title', 'Liste des Terrains')
@section('content')

      <!-- principe squad Page -->
      <section class="w-[100%] flex justify-center flex-col min-h-[100vh] relative">
        <!-- image terain -->
        <div class="relative  md:w-[100%] w-[100%] h-full">
          <img
            src="{{ asset('assets/img/stud-red.svg') }}"
            class="fixed w-[100%] h-[100vh] object-cover z-[-3] md:brightness-[50%]"
            alt=""
          />

       <!-- Header Squad Info - NOUVELLE SECTION -->
<div class="w-full md:w-[80%] z-10 mb-8 mt-[8rem] m-auto">
  <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-100 w-[50%] m-auto border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-md relative" role="alert">
                        <div class="flex items-center">
                            <div class="py-1">
                                <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" class="absolute top-[50%] translate-y-[-50%] right-0 mr-2 text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                    <div class="bg-red-100 w-[50%] m-auto border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-md relative" role="alert">
                        <div class="flex items-center">
                            <div class="py-1">
                                <svg class="h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button type="button" class="absolute top-[50%] translate-y-[-50%] right-0 mr-2 text-red-700 hover:text-red-900" onclick="this.parentElement.style.display='none'">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif
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
           
                <div class="flex pb-6 md:pb-0">
                  <div class="flex items-center bg-[#4a0a1b]/90 px-4 py-2 rounded-lg">
                        <div class="w-3 h-3 bg-[#555353] rounded-full mr-2"></div>
                        <span class="text-sm font-medium">{{ 10- $squad->players()->count() }} empty</span>
                    </div>
                    <div class="flex items-center bg-[#4a0a1b]/90 px-4 py-2 rounded-lg">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium">{{ $squad->players()->where('acceptationUser', 'accepté')->count() }} acceptés</span>
                    </div>
                    <div class="flex items-center bg-[#580a21]/70 px-4 py-2 rounded-lg">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-sm font-medium">{{ $squad->players()->where('acceptationUser', 'en attente')->count() }} en attente</span>
                    </div>
                </div>
              
              @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
          <div class="flex  space-x-4">
        <form  action="{{ route('squads.destroy', $squad->id) }}" method="POST" >
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-[#70182e]  text-white px-5 py-3 rounded-lg hover:bg-[#580a21] transition-all duration-300 flex items-center justify-center">
                Supprimer
            </button>
        </form>
        
        <button onclick="showTerrains('{{ $squad->city }}')" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Réserver un terrain
        </button>
        <button class="flex items-center bg-[#4a0a1b]/90 px-4 py-2 rounded-lg cursor-pointer" onclick="showSquadReservations('{{ $squad->id }}')">
    <i class="fa-solid fa-calendar-check mr-2 text-lg text-white"></i>
    <span class="text-sm font-medium">Voir réservations</span>
</button>
    </div>
@endif
               
           
        </div>
    </div>
</div>

<!-- Formation 1-2-1 equipe 1 -->

<div
  id="list_main_players_121"
  class="grid grid-cols-5 min-h-[100vh]  relative grid-rows-4 md:bg-transparent bg-[#5f4a4a92] gap-x-[4%] w-[100%] bg-cover bg-no-repeat"
>



<!-- GK -->
   @php
  $gkPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'GK' &&
             $player->pivot->equipe === "1";
  });
   @endphp
 @if(!empty($gkPlayer))
<div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-1 row-span-1 justify-self-center self-start ">
   <div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
   @if ($gkPlayer->pivot->admin!==1)
      @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$gkPlayer->pivot->user_id)
        <form action="{{ route('joueur.squad.delete', [$gkPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      @else
        <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-lock"></i>
        </a>
      @endif
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
</div>

    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />

    @if($gkPlayer->pivot->acceptationUser === 'accepté')
    <div class="absolute  top-2 left-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
    </div>
    @endif

    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%] " onclick="">
        <div class="flex items-center justify-center  text-black pt-6">
            <img src="{{ $gkPlayer->profile_picture ? asset('storage/' . $gkPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                 alt="Player image"
                 class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
        </div>

        <div class="flex justify-center items-center ">
            <p class="text-center text-black text-[12px] font-semibold">{{ $gkPlayer->name }}</p>
        </div>
        <div class="flex justify-center items-center pb-6">
            <p class="text-center text-black text-[13px]">{{ $gkPlayer->city }}</p>
        </div>
    </div>

    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
        <p class="">{{ $gkPlayer->pivot->position }}</p>
    </div>
</div>
@else
<div class="relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-1 row-span-1 justify-self-center self-start">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
   @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1,'GK', null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="1" class="hidden">
                <input type="text" name="position" value="GK" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
        <p>GK</p>
    </div>
</div>
@endif

<!-- Défenseur central (CB) -->
  @php
  $cbPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'CB' &&
             $player->pivot->equipe === "1";
  });
@endphp

@if(!empty($cbPlayer))
  <div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-2 row-span-2 justify-self-center self-center">
<div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
   @if ($cbPlayer->pivot->admin!==1)
      @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$cbPlayer->pivot->user_id)
        <form action="{{ route('joueur.squad.delete', [$cbPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      @else
        <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-lock"></i>
        </a>
      @endif
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
</div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($cbPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-clock text-white text-xs"></i>
    </div>
    @endif
      <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%] " onclick="">
                    <div class="flex items-center justify-center  text-black pt-6">
                      <img
                          src="{{$cbPlayer->profile_picture ? asset('storage/' . $cbPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
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
      @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1,'CB',null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="1" class="hidden">
                <input type="text" name="position" value="CB" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
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
             $player->pivot->equipe === "1";
  });
@endphp

@if(!empty($rmPlayer))
  {{-- Player card --}}
  <div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-2 col-span-1 row-start-2 row-span-2 justify-self-center self-end">
    <div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
    @if ($rmPlayer->pivot->admin!==1)
      @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$rmPlayer->pivot->user_id)
        <form action="{{ route('joueur.squad.delete', [$rmPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      @else
        <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-lock"></i>
        </a>
      @endif
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
</div>

    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />

    @if($rmPlayer->pivot->acceptationUser === 'accepté')
      <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
    @else
      <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
      </div>
    @endif

    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]">
      <div class="flex items-center justify-center text-black pt-6">
        <img
          src="{{ $rmPlayer->profile_picture ? asset('storage/' . $rmPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
          alt="Player image"
          class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]"
        />
      </div>
      <div class="flex justify-center items-center">
        <p class="text-center text-black text-[12px] font-semibold">{{ $rmPlayer->name }}</p>
      </div>
      <div class="flex justify-center items-center pb-6">
        <p class="text-center text-black text-[13px]">{{ $rmPlayer->city }}</p>
      </div>
    </div>

    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p class="">{{ $rmPlayer->pivot->position }}</p>
    </div>
  </div>

@else
  {{-- Empty slot (Add Player Button) --}}
  <div class="relative w-[5rem] md:w-[9rem] h-fit col-start-2 col-span-1 row-start-2 row-span-2 justify-self-center self-end">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
     @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer('1','RM',null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="1" class="hidden">
                <input type="text" name="position" value="RM" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
      <p>RM</p>
    </div>
  </div>
@endif


  <!-- Milieu gauche (LM) -->
   @php
  $lmPlayer = $players->first(function($player) {
      return isset($player->pivot->position, $player->pivot->equipe) &&
             $player->pivot->position === 'LM' &&
             $player->pivot->equipe === "1";
  });
@endphp
 @if(!empty($lmPlayer))
<div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-2 row-span-2 justify-self-center self-end">
  <div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
  @if ($lmPlayer->pivot->admin!==1)
    @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$lmPlayer->pivot->user_id)
      <form action="{{ route('joueur.squad.delete', [$lmPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-trash"></i>
        </button>
      </form>
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
  @else
    <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
      <i class="fa-solid fa-lock"></i>
    </a>
  @endif
</div>

    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />

    @if($lmPlayer->pivot->acceptationUser === 'accepté')
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
    </div>
    @endif

    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
        <div class="flex items-center justify-center text-black pt-6">
            <img src="{{ $lmPlayer->profile_picture ? asset('storage/' . $lmPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                 alt="Player image"
                 class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
        </div>
        <div class="flex justify-center items-center">
            <p class="text-center text-black text-[12px] font-semibold">{{ $lmPlayer->name }}</p>
        </div>
        <div class="flex justify-center items-center pb-6">
            <p class="text-center text-black text-[13px]">{{ $lmPlayer->city }}</p>
        </div>
    </div>

    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
        <p class="">{{ $lmPlayer->pivot->position }}</p>
    </div>
</div>
@else
<div class="relative w-[5rem] md:w-[9rem] h-fit col-start-4 col-span-1 row-start-2 row-span-2 justify-self-center self-end">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
      @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1,'LM',null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="1" class="hidden">
                <input type="text" name="position" value="LM" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
        <p>LM</p>
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

 @if(!empty($stPlayer))
<div class="group relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-4 row-span-1 justify-self-center self-center">
<div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
  @if ($stPlayer->pivot->admin!==1)
    @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$stPlayer->pivot->user_id)
      <form action="{{ route('joueur.squad.delete', [$stPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-trash"></i>
        </button>
      </form>
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
  @else
    <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
      <i class="fa-solid fa-lock"></i>
    </a>
  @endif
</div>

    <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />

    @if($stPlayer->pivot->acceptationUser === 'accepté')
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
 bg-orange-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-clock text-white text-xs"></i>
    </div>
    @endif

    <div class="text-white absolute top-0 flex justify-center flex-col items-center cursor-pointer w-[100%] h-[100%]" onclick="">
        <div class="flex items-center justify-center text-black pt-6">
            <img src="{{ $stPlayer->profile_picture ? asset('storage/' . $stPlayer->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                 alt="Player image"
                 class="w-[80%] h-[70%] object-contain rounded-md group-hover:brightness-[35%]" />
        </div>
        <div class="flex justify-center items-center">
            <p class="text-center text-black text-[12px] font-semibold">{{ $stPlayer->name }}</p>
        </div>
        <div class="flex justify-center items-center pb-6">
            <p class="text-center text-black text-[13px]">{{ $stPlayer->city }}</p>
        </div>
    </div>

    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
        <p class="">{{ $stPlayer->pivot->position }}</p>
    </div>
</div>
@else
<div class="relative w-[5rem] md:w-[9rem] h-fit col-start-3 col-span-1 row-start-4 row-span-1 justify-self-center self-center">
    <img src="{{ asset('assets/img/card.png') }}" alt="" />
    @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(1,'ST',null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="1" class="hidden">
                <input type="text" name="position" value="ST" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
    <div class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]">
        <p>ST</p>
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
   <div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
   @if ($gkPlayer->pivot->admin!==1)
      @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$gkPlayer->pivot->user_id)
        <form action="{{ route('joueur.squad.delete', [$gkPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      @else
        <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-lock"></i>
        </a>
      @endif
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
</div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($gkPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
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
     @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'GK', null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="2" class="hidden">
                <input type="text" name="position" value="GK" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
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
   <div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
   @if ($cbPlayer->pivot->admin!==1)
      @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$cbPlayer->pivot->user_id)
        <form action="{{ route('joueur.squad.delete', [$cbPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      @else
        <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-lock"></i>
        </a>
      @endif
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
</div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
      @if($cbPlayer->pivot->acceptationUser ==='accepté')
      <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
        <i class="fa-solid fa-check text-white text-xs"></i>
      </div>
      @else
      <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
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
     @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'CB',null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="2" class="hidden">
                <input type="text" name="position" value="CB" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
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
    <div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
    @if ($rmPlayer->pivot->admin!==1)
      @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$rmPlayer->pivot->user_id)
        <form action="{{ route('joueur.squad.delete', [$rmPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      @else
        <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-lock"></i>
        </a>
      @endif
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
</div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($rmPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
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
     @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'RM',null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="2" class="hidden">
                <input type="text" name="position" value="RM" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
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
 <div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
  @if ($lmPlayer->pivot->admin!==1)
    @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$lmPlayer->pivot->user_id)
      <form action="{{ route('joueur.squad.delete', [$lmPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-trash"></i>
        </button>
      </form>
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
  @else
    <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
      <i class="fa-solid fa-lock"></i>
    </a>
  @endif
</div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($lmPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
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
     @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'LM',null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="2" class="hidden">
                <input type="text" name="position" value="LM" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
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
    <div class="absolute top-1 h-[100%] w-[100%] left-0 z-20 hidden group-hover:flex flex-col">
    @if ($stPlayer->pivot->admin!==1)
      @if ($squad->adminPlayer()->id === Auth::user()->id || Auth::user()->id===$stPlayer->pivot->user_id)
        <form action="{{ route('joueur.squad.delete', [$stPlayer->pivot->user_id, $squad->id]) }}" method="POST" class="inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-white bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      @else
        <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
          <i class="fa-solid fa-lock"></i>
        </a>
      @endif
    @else
      <a onclick="" class="text-[white] bg-[#70182ee6] rounded-full flex justify-center items-center w-8 h-8">
        <i class="fa-solid fa-lock"></i>
      </a>
    @endif
</div>
      <img src="{{ asset('assets/img/rare-gold-24.png') }}" class="group-hover:brightness-[35%]" alt="" />
          <!-- Badge de statut -->
    @if($stPlayer->pivot->acceptationUser ==='accepté')
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
 bg-green-500 rounded-full border-2 border-white flex justify-center items-center z-10">
      <i class="fa-solid fa-check text-white text-xs"></i>
    </div>
    @else
    <div class="absolute top-2 left-1 group-hover:hidden w-7 h-7
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
    @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" onclick="openContainerGroupePlayer(2,'ST',null)">
              <i class="fa-solid fa-plus text-[1.6rem]"></i>
          </div>
          @else
           <div class="text-white absolute top-0 flex justify-center items-center cursor-pointer w-[100%] h-[100%]" >
              <form action="{{ route('joueur.squad.add') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="fa-solid fa-paper-plane"  ></i>
                </button>
                <input type="text" name="squad_id" value="{{ $squad->id }}" class="hidden">
                <input type="text" name="player_id" value="{{ Auth::id() }}" class="hidden">
                <input type="text" name="equipe" value="2" class="hidden">
                <input type="text" name="position" value="ST" class="hidden">
                <input type="text" name="side" value="null" class="hidden">
                <input type="text" name="invitationType" value="member" class="hidden">
              </form>
           </div>
          @endif
    <div
      class="absolute shadow-xl bg-[#555] text-white rounded-[50%] w-[3rem] text-center px-2 py-2 left-[50%] translate-x-[-50%]"
    >
      <p>ST</p>
    </div>
  </div>
  @endif
 
</div>

  <!-- POP UP PLAYERS-->
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
  <!-- POP UP TERRAINS-->
       <div
        id="container_terrains_reservation"
        class="bg-[#e8e8ff4c] w-full h-[100vh] hidden   fixed top-0 z-30"
      >
        <div
          class="relative w-[80%] md:w-[30%] m-auto md:h-[40%] h-[30%] bg-[#000000b5] rounded-xl overflow-hidden"
        >
          <img
            src="{{ asset('assets/img/pop_up.jpg') }}"
            alt=""
            class="absolute w-full z-[-5]"
          />
          <button
            onclick="closeContainerTerrainsReservation()"
            class="pt-[1rem] pr-[1rem] text-[1.4rem] h-[20%] w-[97%] text-end text-white"
          >
            <i class="fa-solid fa-xmark"></i>
          </button>
          <div
            id="content_terrains"
            class="flex justify-center gap-4 w-full h-[100%] items-center px-6  overflow-x-auto scrollbar-thin scrollbar-track-transparent scroll-smooth"
          >
       
          
        </div>
        </div>
      </div>
   <!-- POP UP CALENDAR-->
<div
        id="container_calendar"
        class="bg-[#e8e8ff4c] w-full h-[100vh] hidden  justify-center items-center fixed top-0 z-30"
      >
        <div
          class="relative w-[80%] md:w-[50%] m-auto  md:h-[80%] h-[50%] bg-[#000000b5] rounded-xl overflow-hidden "
        >
          <img
            src="{{ asset('assets/img/pop_up.jpg') }}"
            alt=""
            class="absolute w-full md:h-[100%] h-[100%] z-[-5]"
          />
          <button
            onclick="closeContainerCalendar()"
            class="py-[1rem] pr-[1rem] text-[1.4rem]  w-[97%] text-end text-white"
          >
            <i class="fa-solid fa-xmark"></i>
          </button>
          <div
            id="calendar"
            class=" h-[80%]   px-7 justify-center items-center gap-8 text-white "
          >
       
          
        </div>
        </div>
      </div>

      <!-- POP UP show all reservations-->
      <div
        id="container_all_reservation"
        class="bg-[#e8e8ff4c] w-full h-[100vh] hidden  justify-center items-center fixed top-0 z-30"
      >
        <div
          class="relative w-[80%] md:w-[50%] m-auto  md:h-[80%] h-[50%] bg-[#000000b5] rounded-xl overflow-hidden "
        >
          <img
            src="{{ asset('assets/img/pop_up.jpg') }}"
            alt=""
            class="absolute w-full md:h-[100%] h-[100%]  z-[-5]"
          />
          <button
            onclick="closeContainerAllReservation()"
            class="py-[1rem] pr-[1rem] text-[1.4rem]  w-[97%] text-end text-white"
          >
            <i class="fa-solid fa-xmark"></i>
          </button>
            <button
            id="addNewReservationButton"
            class="absolute bottom-8 left-[50%] translate-x-[-50%] bg-[#580a21] hover:bg-[#400618] text-white font-medium py-3 px-6 rounded-lg shadow-md transition-all duration-300 flex items-center gap-2"
          >
            <i class="fas fa-plus"></i>
            Créer une réservation
          </button>
       
          <div
            id="content_reservations"
            class=" h-[80%]   px-7 justify-center items-center gap-8 text-white "
          >
       
          
        </div>
        </div>
      </div>
      <!-- POP UP create reservation-->
      <div
  id="containerCreateReservation"
  class="bg-black bg-opacity-20 w-full h-screen hidden fixed top-0 z-30"
>
  <div
    class="relative w-4/5 md:w-1/3 m-auto md:h-2/5 h-1/3 bg-black bg-opacity-70 rounded-xl overflow-hidden shadow-xl"
  >
    <img
      src="{{ asset('assets/img/pop_up.jpg') }}"
      alt=""
      class="absolute w-full h-full object-cover  z-[-5]"
    />
    <button
      onclick="closeContainerCreateReservation()"
      class="absolute top-4 right-4 text-2xl text-white hover:text-gray-300 transition-colors duration-200"
    >
      <i class="fa-solid fa-xmark"></i>
    </button>
    <div
      id="contentCreateReservation"
      class="flex flex-col justify-center items-center w-full h-full p-6 overflow-x-auto scrollbar-thin scrollbar-track-transparent scroll-smooth"
    >
      <h3 class="text-white text-xl font-semibold mb-6">Sélectionnez votre horaire</h3>
      
      <div class="flex flex-wrap md:flex-nowrap justify-center items-center gap-6 w-full">
        <div class="flex items-center gap-2">
          <label for="time-from" class="text-white font-medium">De</label>
          <input 
            type="time" 
            name="time-from" 
            id="time-from"
            onchange="changetime()"
            class="bg-white bg-opacity-20 text-white border border-white border-opacity-30 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all appearance-none"
          >
        </div>
        
        <div class="flex items-center gap-2">
          <label for="time-to" class="text-white font-medium">À</label>
          <input 
            type="time" 
            name="time-to" 
            id="time-to"
             onchange="changetime()"
            class="bg-white bg-opacity-20 text-white border border-white border-opacity-30 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all appearance-none"
          >
        </div>
      </div>
      
      <button 

      onclick="submitReservation()"
      id="reserveButton"
        class="mt-8 bg-[#580a21] bg-[#580a21c4] text-white font-medium px-6 py-2 rounded-md transition-colors duration-200"
      >
        Réserver
      </button>
    </div>
  </div>
</div>
<div
    id="container_squad_reservations"
    class="bg-[#e8e8ff4c] w-full h-[100vh] hidden justify-center items-center fixed top-0 z-30"
>
    <div
        class="relative w-[90%] md:w-[70%] m-auto md:h-[80%] h-[80%] bg-[#000000b5] rounded-xl overflow-hidden"
    >
        <img
            src="{{ asset('assets/img/pop_up.jpg') }}"
            alt=""
            class="absolute w-full h-full object-cover z-[-5]"
        />
        <div class="flex justify-between items-center py-4 px-6 border-b border-gray-700">
            <h2 class="text-xl font-bold text-white">Réservations du Squad</h2>
            <button
                onclick="closeSquadReservations()"
                class="text-2xl text-white hover:text-gray-300 transition-colors duration-200"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div
            id="content_squad_reservations"
            class="p-6 h-[calc(100%-80px)] overflow-y-auto"
        >
            <div class="text-center text-white">
                <i class="fa-solid fa-spinner fa-spin text-3xl mb-4"></i>
                <p>Chargement des réservations...</p>
            </div>
        </div>
    </div>
</div>



      <script>
       const containerGroupePlayer = document.getElementById('container_groupe_player');
       const contentPopUp = document.getElementById('content_pop_up'); 
       const containerTerrainsReservation= document.getElementById('container_terrains_reservation');
       const content_terrains = document.getElementById('content_terrains'); 
     
       let squadId = '{{ $squad->id }}';
       
        function openContainerGroupePlayer(equipe,position,side) {
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
            
            showAllPlayers(data.players,equipe,position,data.playersExist,side);
            
            
          })
          .catch(error => console.error("Erreur :", error));
          }

        function showAllPlayers(players,equipe,position,playersExist,side) {
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
                        onclick="addToSquad(${player.id},${equipe},'${position}','${side}')"
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
        
        function addToSquad(playerId,equipe,position,side) { 
          
          
                // Préparation des données à envoyer
          const formData = new URLSearchParams();
          formData.append('player_id', playerId);
          formData.append('equipe', equipe);
          formData.append('position', position);
          formData.append('squad_id', squadId); 
          formData.append('side',side);
          formData.append('invitationType', 'admin');
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

          function showTerrains(city){
            containerTerrainsReservation.classList.remove('hidden');
            containerTerrainsReservation.classList.add('flex');
            content_terrains.innerHTML ="loading...";

            fetch(`/search/terrains/${city}`,{
              method: "GET",
              headers: {
                  "Content-Type": "application/x-www-form-urlencoded",
              },
                }).then(response => {
                  if (!response.ok) throw new Error('Erreur réseau');
                  return response.json();
              })
              .then(data =>{
                addAllTerrains(data); 
              })
              .catch(error => console.error("Erreur :", error));
              
              }   

              function addAllTerrains(terrains){
                    content_terrains.innerHTML = "";
        
        if (terrains.length === 0) {
            content_terrains.innerHTML = "<p class='text-white'>Aucun joueur trouvé.</p>";
              return;
        } else {
              terrains[0].forEach((terrain)=>{
                    content_terrains.innerHTML+=` <div class="bg-white/10 flex flex-col justify-end items-center min-w-[50%] h-[50%] rounded-lg p-4 hover:bg-white/20 transition duration-300 transform ">
                    
                      <h3 class="font-bold text-lg">${terrain.name}</h3>
                      <p class="mt-1"><i class="fa-solid fa-location-dot mr-2"></i>${terrain.city}</p>
                      ${terrain.size ? `<p class="mt-1"><i class="fa-solid fa-ruler mr-2"></i>${terrain.size}</p>` : ''}
                      ${terrain.price_hour ? `<p class="text-green-400 font-semibold mt-2">${terrain.price_hour} DH/heure</p>` : ''}
                      <div class="flex gap-4 items-center">
                      <a href="/terrains/${terrain.id}" class="block">
                      <button class="mt-8 bg-[#580a21] hover:bg-[#6c0c29] text-white py-1 px-4 rounded text-sm transition-all duration-300">
                        Voir détails
                      </button>
                    </a>
                      <button onclick="showcontainerCalendar('${terrain.id}','${squadId}')" class="mt-8 bg-[#580a21] hover:bg-[#6c0c29] text-white py-1 px-4 rounded text-sm transition-all duration-300">
                        Reserver
                      </button>
                      <div/>
                  </div>`;
              })
        }
              }
          
              function closeContainerTerrainsReservation(){
                containerTerrainsReservation.classList.remove('flex');
            containerTerrainsReservation.classList.add('hidden');
              }
          
     </script>
     <script>
    function showSquadReservations(squadId) {
        const container = document.getElementById('container_squad_reservations');
        const content = document.getElementById('content_squad_reservations');
        
        // Afficher la popup
        container.classList.remove('hidden');
        container.classList.add('flex');
        
        // Afficher un message de chargement
        content.innerHTML = `
            <div class="text-center text-white">
                <i class="fa-solid fa-spinner fa-spin text-3xl mb-4"></i>
                <p>Chargement des réservations...</p>
            </div>
        `;
        
        // Charger les réservations depuis l'API
        fetch(`/joueur/squad/reservations/${squadId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.json();
        })
        .then(data => {
              
            displaySquadReservations(data);
        })
        .catch(error => {
            console.error('Erreur :', error);
            content.innerHTML = `
                <div class="text-center text-white">
                    <i class="fa-solid fa-triangle-exclamation text-3xl text-red-500 mb-4"></i>
                    <p>Une erreur est survenue lors du chargement des réservations.</p>
                </div>
            `;
        });
    }
    
    function displaySquadReservations(reservations) {
        const content = document.getElementById('content_squad_reservations');
        
        // Si aucune réservation
        if (!reservations || reservations.length === 0) {
            content.innerHTML = `
                <div class="text-center text-white">
                    <i class="fa-solid fa-calendar-xmark text-3xl mb-4"></i>
                    <p>Aucune réservation trouvée pour ce squad.</p>
                </div>
            `;
            return;
        }
        
        // Organiser les réservations par date
        const reservationsByDate = {};
        reservations.forEach(reservation => {
            if (!reservationsByDate[reservation.date_reservation]) {
                reservationsByDate[reservation.date_reservation] = [];
            }
            reservationsByDate[reservation.date_reservation].push(reservation);
        });
        
        // Générer le HTML pour afficher les réservations
        let html = '';
        
        // Trier les dates (les plus récentes d'abord)
        const sortedDates = Object.keys(reservationsByDate).sort((a, b) => new Date(b) - new Date(a));
        
        sortedDates.forEach(date => {
            const formattedDate = new Date(date).toLocaleDateString('fr-FR', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            html += `
                <div class="mb-6">
                    <h3 class="text-white text-lg font-semibold capitalize mb-3">${formattedDate}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            `;
            
            reservationsByDate[date].forEach(reservation => {
                html += `
                    <div class="bg-white/10 rounded-lg p-4 border border-[#580a21]/50 transition hover:bg-white/20">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="text-white font-bold">${reservation.terrain.name}</h4>
                                <p class="text-gray-300 text-sm">
                                    <i class="fa-solid fa-location-dot mr-1"></i> ${reservation.terrain.city}
                                </p>
                            </div>
                            <div class="bg-[#580a21] px-3 py-1 rounded-full text-xs text-white">
                                ${reservation.reservationType === 'group' ? 'Groupe' : 'Individuel'}
                            </div>
                        </div>
                        <div class="flex items-center text-white mb-2">
                            <i class="fa-regular fa-clock mr-2"></i>
                            <span>${reservation.heure_debut} - ${reservation.heure_fin}</span>
                        </div>
                        <div class="flex justify-between items-center mt-3">
                            <div class="flex items-center">
                                <span class="inline-flex items-center justify-center bg-${getStatusColor(reservation.status)} text-white text-xs px-2 py-1 rounded">
                                    ${getStatusText(reservation.status)}
                                </span>
                            </div>
                            ${reservation.payment_status === 'paid' 
                                ? '<span class="inline-flex items-center justify-center bg-green-600 text-white text-xs px-2 py-1 rounded"><i class="fa-solid fa-check mr-1"></i> Payé</span>' 
                                : '<span class="inline-flex items-center justify-center bg-yellow-600 text-white text-xs px-2 py-1 rounded"><i class="fa-solid fa-clock mr-1"></i> En attente</span>'}
                        </div>
                    </div>
                `;
            });
            
            html += `
                    </div>
                </div>
            `;
        });
        
        content.innerHTML = html;
    }
    
    function getStatusColor(status) {
        switch (status) {
            case 'confirmed': return 'green-600';
            case 'pending': return 'yellow-600';
            case 'cancelled': return 'red-600';
            default: return 'gray-600';
        }
    }
    
    function getStatusText(status) {
        switch (status) {
            case 'confirmed': return 'Confirmé';
            case 'pending': return 'En attente';
            case 'cancelled': return 'Annulé';
            default: return status;
        }
    }
    
    function closeSquadReservations() {
        const container = document.getElementById('container_squad_reservations');
        container.classList.add('hidden');
        container.classList.remove('flex');
    }
</script>
     
    <script src="{{ asset('js/showReservations.js') }}"></script>

      </section>
      
 
@endsection