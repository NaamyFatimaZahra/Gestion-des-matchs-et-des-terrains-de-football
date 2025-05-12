@extends('Layout.guest')

@section('content')



<section class="w-[100%] relative">
  <video
    autoplay
    loop
    class="h-[100vh] w-[100%] object-cover hidden md:block">
    <source src="{{ asset('assets/img/stad-foot.mp4') }}" type="video/mp4" />
  </video>
  <div class="md:hidden">
    <img
      src="{{ asset('assets/img/stud-red.svg') }}"
      class="h-[100vh] w-[100%] object-cover brightness-[50%]"
      alt="" />
  </div>
  <div
    class="md:bg-[#7c00008a] w-[100%] h-[100vh] absolute top-0 left-0 z-5 flex justify-center items-center">

    <!-- Overlay -->
    <div class="absolute inset-0  flex flex-col justify-center items-center px-6 md:px-20">
      <div class="max-w-4xl mx-auto text-center hero-text">
        <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
          Stop Searching For Your Perfect Match <span class="text-yellow-400"> Create It</span>
        </h1>


      </div>

      <div class="absolute bottom-24 md:bottom-2 animate-bounce">
        <img
          src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}"
          class="w-32 md:w-48"
          alt="Soccer ball" />
      </div>
    </div>

  </div>
  <div
    class="text-white uppercase absolute top-[46%] right-[-11rem] rotate-[-90deg] tracking-[.7rem]">
    <p class="w-max">make dream come true</p>
  </div>
</section>
<section class="bg-[#f1aaaa39] w-full py-8 md:py-16 relative">

  <!-- Premier bloc -->
  <div class="flex flex-col md:flex-row px-4 sm:px-8 md:px-12 lg:px-16 xl:px-28 items-center justify-between relative mb-12 md:mb-16 py-8 md:py-16">
    <!-- Colonne de texte -->
    <div class="flex flex-col w-full md:w-5/12 mb-10 md:mb-0">
      <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold opacity-5 text-[#7c0000] leading-none">01</h1>
      <p class="text-gray-700 text-base sm:text-lg leading-relaxed mt-4 max-w-full md:max-w-[90%]">
        Interface permettant aux propriétaires d'ajouter un terrain de football avec ses caractéristiques (nom, description, capacité). Le design en bordeaux sur fond rose facilite la saisie des informations essentielles pour partager son terrain avec la communauté.
      </p>
      <div class="mt-6">
        <button class="bg-[#7c0000] text-white px-4 sm:px-6 py-2 rounded-md hover:bg-[#5c0000] transition-colors duration-300 flex items-center gap-2">
          <span>En savoir plus</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Colonne d'image avec cercles -->
    <div class="relative w-full md:w-7/12 h-64 sm:h-80 md:h-96 lg:h-[30rem] flex items-center justify-center">
      <!-- Cercle principal -->
      <div class="absolute w-56 h-56 sm:w-64 sm:h-64 md:w-80 md:h-80 lg:w-[28rem] lg:h-[28rem] rounded-full bg-[#7c0000cc] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>

      <!-- Cercle secondaire décoratif -->
      <div class="absolute w-28 h-28 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-[14rem] lg:h-[14rem] rounded-full bg-[#7c0000aa] left-[65%] top-[70%] transform -translate-x-1/2 -translate-y-1/2 blur-[2px]"></div>

      <!-- Halo lumineux -->
      <div class="absolute w-60 h-60 sm:w-72 sm:h-72 md:w-96 md:h-96 lg:w-[30rem] lg:h-[30rem] rounded-full bg-[#7c000022] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>

      <!-- Image -->
      <img
        class="absolute h-56 sm:h-64 md:h-80 lg:h-[28rem] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 drop-shadow-2xl"
        src="{{ asset('assets/img/proprietaire.png') }}"
        alt="Interface pour ajouter un terrain">

      <!-- Points décoratifs (masqués sur petits écrans) -->
      <div class="absolute w-72 h-72 sm:w-80 sm:h-80 md:w-[32rem] md:h-[32rem] lg:w-[36rem] lg:h-[36rem] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-0 opacity-20 hidden sm:block">
        <div class="absolute w-2 h-2 bg-white rounded-full top-[20%] left-[80%]"></div>
        <div class="absolute w-3 h-3 bg-white rounded-full top-[30%] left-[15%]"></div>
        <div class="absolute w-2 h-2 bg-white rounded-full top-[70%] left-[75%]"></div>
        <div class="absolute w-2 h-2 bg-white rounded-full top-[85%] left-[25%]"></div>
      </div>
    </div>
  </div>

  <!-- Deuxième bloc (redessiné) -->
  <div class="flex flex-col md:flex-row-reverse px-4 sm:px-8 md:px-12 lg:px-16 xl:px-28 items-center justify-between relative mb-12 md:mb-16">
    <!-- Colonne de texte -->
    <div class="flex flex-col w-full md:w-5/12 mb-10 md:mb-0">
      <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold opacity-5 text-[#7c0000] leading-none">02</h1>
      <p class="text-gray-700 text-base sm:text-lg leading-relaxed mt-4 max-w-full md:max-w-[90%]">
        Visualisation tactique montrant un joueur (gyugyu Agadir) en position de gardien (GK) et des emplacements vides pour les autres positions (CB, CM, ST, LM, RM). Le fond de stade avec éclairage rouge crée une ambiance immersive pour construire son équipe.
      </p>
      <div class="mt-6">
        <button class="bg-[#7c0000] text-white px-4 sm:px-6 py-2 rounded-md hover:bg-[#5c0000] transition-colors duration-300 flex items-center gap-2">
          <span>En savoir plus</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Colonne d'image avec cercles -->
    <div class="relative w-full md:w-7/12 h-64 sm:h-80 md:h-96 lg:h-[30rem] flex items-center justify-center">
      <!-- Cercle principal -->
      <div class="absolute w-56 h-56 sm:w-64 sm:h-64 md:w-80 md:h-80 lg:w-[28rem] lg:h-[28rem] rounded-full bg-[#7c0000cc] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>

      <!-- Cercle secondaire décoratif -->
      <div class="absolute w-28 h-28 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-[14rem] lg:h-[14rem] rounded-full bg-[#7c0000aa] left-[65%] top-[70%] transform -translate-x-1/2 -translate-y-1/2 blur-[2px]"></div>

      <!-- Halo lumineux -->
      <div class="absolute w-60 h-60 sm:w-72 sm:h-72 md:w-96 md:h-96 lg:w-[30rem] lg:h-[30rem] rounded-full bg-[#7c000022] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>

      <!-- Image -->
      <img
        class="absolute h-56 sm:h-64 md:h-80 lg:h-[28rem] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 drop-shadow-2xl"
        src="{{ asset('assets/img/position.png') }}"
        alt="Visualisation tactique">

      <!-- Points décoratifs (masqués sur petits écrans) -->
      <div class="absolute w-72 h-72 sm:w-80 sm:h-80 md:w-[32rem] md:h-[32rem] lg:w-[36rem] lg:h-[36rem] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-0 opacity-20 hidden sm:block">
        <div class="absolute w-2 h-2 bg-white rounded-full top-[20%] left-[80%]"></div>
        <div class="absolute w-3 h-3 bg-white rounded-full top-[30%] left-[15%]"></div>
        <div class="absolute w-2 h-2 bg-white rounded-full top-[70%] left-[75%]"></div>
        <div class="absolute w-2 h-2 bg-white rounded-full top-[85%] left-[25%]"></div>
      </div>
    </div>
  </div>

  <!-- Troisième bloc (redessiné) -->
  <div class="flex flex-col md:flex-row px-4 sm:px-8 md:px-12 lg:px-16 xl:px-28 items-center justify-between relative py-8 md:py-16">
    <!-- Colonne de texte -->
    <div class="flex flex-col w-full md:w-5/12 mb-10 md:mb-0">
      <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold opacity-5 text-[#7c0000] leading-none">03</h1>
      <p class="text-gray-700 text-base sm:text-lg leading-relaxed mt-4 max-w-full md:max-w-[90%]">
        Formulaire pour créer sa propre équipe en spécifiant le nom, la ville, la formation tactique (1-2-1, 3-3-1, 4-3-3) et sa position préférée. L'interface sobre sur fond de terrain de football guide l'utilisateur dans l'organisation de ses matchs.
      </p>
      <div class="mt-6">
        <button class="bg-[#7c0000] text-white px-4 sm:px-6 py-2 rounded-md hover:bg-[#5c0000] transition-colors duration-300 flex items-center gap-2">
          <span>En savoir plus</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Colonne d'image avec cercles -->
    <div class="relative w-full md:w-7/12 h-64 sm:h-80 md:h-96 lg:h-[30rem] flex items-center justify-center">
      <!-- Cercle principal -->
      <div class="absolute w-56 h-56 sm:w-64 sm:h-64 md:w-80 md:h-80 lg:w-[28rem] lg:h-[28rem] rounded-full bg-[#7c0000cc] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>

      <!-- Cercle secondaire décoratif -->
      <div class="absolute w-28 h-28 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-[14rem] lg:h-[14rem] rounded-full bg-[#7c0000aa] left-[65%] top-[70%] transform -translate-x-1/2 -translate-y-1/2 blur-[2px]"></div>

      <!-- Halo lumineux -->
      <div class="absolute w-60 h-60 sm:w-72 sm:h-72 md:w-96 md:h-96 lg:w-[30rem] lg:h-[30rem] rounded-full bg-[#7c000022] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>

      <!-- Image -->
      <img
        class="absolute h-56 sm:h-64 md:h-80 lg:h-[28rem] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 drop-shadow-2xl"
        src="{{ asset('assets/img/create_equip.png') }}"
        alt="Formulaire de création d'équipe">

      <!-- Points décoratifs (masqués sur petits écrans) -->
      <div class="absolute w-72 h-72 sm:w-80 sm:h-80 md:w-[32rem] md:h-[32rem] lg:w-[36rem] lg:h-[36rem] left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-0 opacity-20 hidden sm:block">
        <div class="absolute w-2 h-2 bg-white rounded-full top-[20%] left-[80%]"></div>
        <div class="absolute w-3 h-3 bg-white rounded-full top-[30%] left-[15%]"></div>
        <div class="absolute w-2 h-2 bg-white rounded-full top-[70%] left-[75%]"></div>
        <div class="absolute w-2 h-2 bg-white rounded-full top-[85%] left-[25%]"></div>
      </div>
    </div>
  </div>

</section>


@endsection