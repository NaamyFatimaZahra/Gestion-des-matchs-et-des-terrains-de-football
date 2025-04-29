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
              
              @if ($squad->players()->where('user_id', Auth::user()->id)->where('admin',1)->count()===1)
          <div class="flex space-x-4">
        <form action="{{ route('squads.destroy', $squad->id) }}" method="POST" >
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-[#70182e] text-white px-5 py-3 rounded-lg hover:bg-[#580a21] transition-all duration-300 flex items-center justify-center">
                Supprimer
            </button>
        </form>
        
        <a href="" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Réserver un terrain
        </a>
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
       

   function openContainerGroupePlayer(equipe,position,side) {
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