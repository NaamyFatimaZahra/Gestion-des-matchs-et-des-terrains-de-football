<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <title> @yield('title') </title>
    @vite('resources/css/app.css')
    <style>
      /* Menu mobile styling */
      .mobile-menu {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
      }
      
      .mobile-menu.open {
        transform: translateX(0);
      }
      
      /* Animation for hamburger to X */
      .hamburger-line {
        transition: all 0.3s ease-in-out;
      }
      
      .hamburger.active .hamburger-line:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
      }
      
      .hamburger.active .hamburger-line:nth-child(2) {
        opacity: 0;
      }
      
      .hamburger.active .hamburger-line:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
      }
      
      /* Custom scrollbar styling */
      .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
      }
      
      .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
      }
      
      .scrollbar-thin::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.3);
        border-radius: 20px;
      }
      
      .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background-color: rgba(255, 255, 255, 0.5);
      }
      
      /* For Firefox */
      .scrollbar-thin {
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
      }
      
      /* Smooth scrolling for all browsers */
      html {
        scroll-behavior: smooth;
      }
    </style>
  </head>
  <body class="relative w-full bg-gray-100">
    <!-- Header -->
    <header id="header" class="md:bg-transparent w-full fixed top-0 z-50">
      <nav class="container mx-auto px-4 py-3 relative">
        <!-- Desktop Menu -->
        <ul class="uppercase hidden md:flex items-center justify-center gap-8 text-white">
          @if (Auth::check() && Auth::user()->role->id!==3)
            <li><a href="{{ Auth::user()->role->name==='admin' ? route('admin.dashboard') : (Auth::user()->role->name==='proprietaire'?route('proprietaire.dashboard'):'kljjj') }}" class="nav-link hover:text-gray-300 transition duration-300">dashboard</a></li>
          @endif
          <li><a href="/home" class="nav-link hover:text-gray-300 transition duration-300">home</a></li>
          <li><a href="{{ route('terrains') }}" class="nav-link hover:text-gray-300 transition duration-300">Terrains</a></li>
          
          @if (Auth::check() && Auth::user()->role->id===3)
            <li><a href="{{ route('joueur.squadBuilder.create') }}" class="nav-link hover:text-gray-300 transition duration-300">squad builder</a></li>
            <li><a href="{{ route('joueur.squads') }}" class="nav-link hover:text-gray-300 transition duration-300">squads</a></li>
            <li><a href="{{ route('joueur.requests') }}" class="nav-link hover:text-gray-300 transition duration-300">requests</a></li>
            <li><a href="{{ route('joueur.invitations') }}" class="nav-link hover:text-gray-300 transition duration-300">Invitations</a></li>
            <li><a href="{{ route('joueur.squads.user') }}" class="nav-link hover:text-gray-300 transition duration-300">mes squads</a></li>
          @endif
          
          <li class="flex items-center relative h-fit w-fit mx-4">
            <input
              type="text"
              onkeyup="searchCities(this.value)"
              id="searchInput"
              class="pl-3 bg-white/20 text-white h-[2.5rem] w-[17rem] rounded-md capitalize outline-none placeholder-white"
              placeholder="search for terrains by city"
            />
            <label class="absolute right-4 text-white" for="searchInput">
              <i class="fa-solid fa-magnifying-glass"></i>
            </label>
            <!-- POP UP -->
            <div
              id="container_terrains"
              class="hidden w-[140%] h-[40vh] absolute top-[120%] left-[50%] translate-x-[-50%]  z-30"
            >
              <div
                class="relative w-[90%] max-w-4xl m-auto md:h-[100%]  bg-[#000000b5] rounded-xl overflow-hidden"
              >
                <img
                  src="{{ asset('assets/img/pop_up.jpg') }}"
                  alt=""
                  class="absolute w-full h-full object-cover  z-[-5]"
                />
                <button
                  onclick="closeSearchCities()"
                  class="pt-[1rem] pr-[1rem] text-[1.4rem] h-[20%] w-[97%] text-end text-white"
                >
                  <i class="fa-solid fa-xmark"></i>
                </button>
                <div
                  id="content_search"
            class="flex  gap-4 w-full h-[100%] justify-center items-center px-6  overflow-x-auto scrollbar-thin scrollbar-track-transparent scroll-smooth"
                >
                  <!-- Content will be populated here by JavaScript -->
                </div>
              </div>
            </div>
          </li>
          
          @if (Auth::check())
            <li>
              <h1 class="font-medium mr-4">{{ Auth::user()->name }}</h1>  
            </li>
            <li>
              <a href="{{ route('profile') }}"><i class="fa-solid fa-circle-user fa-lg"></i></a>
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex gap-2 items-center bg-[#580a21] hover:bg-[#580a21] text-white font-medium py-3 px-3 rounded transition duration-300 ease-in-out">
                  <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>
              </form>
            </li>
          @else
            <div class="flex items-center space-x-4">
              <a href="{{ route('showLogin') }}" class="btn-primary bg-white hover:bg-gray-100 text-[#580a21] font-semibold py-2 px-6 rounded-full shadow-md transition duration-300">
                Login
              </a>
              <a id="signUp" href="{{ route('showRegister') }}" class="btn-primary bg-transparent hover:bg-white/10 text-white font-semibold py-2 px-6 rounded-full border border-white transition duration-300">
                Sign Up
              </a>
            </div>
          @endif
        </ul>
        
        <!-- Mobile Hamburger Button -->
        <div class="md:hidden flex items-center justify-between relative">
          <div class="text-white relative hover:text-white cursor-pointer h-full w-[4rem]">
           <a href="{{ route('home') }}" class="">
            <img
            src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}"
            class="w-full absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"
            alt="Soccer ball"
          />
           </a>
        </div>
        
          <button id="menuBtn" class="hamburger flex flex-col items-center justify-center w-8 h-8 space-y-1.5">
            <span class="hamburger-line block w-6 h-0.5 bg-white"></span>
            <span class="hamburger-line block w-6 h-0.5 bg-white"></span>
            <span class="hamburger-line block w-6 h-0.5 bg-white"></span>
          </button>
        </div>
      </nav>
      
      <!-- Mobile Menu -->
      <div id="mobileMenu" class="mobile-menu md:hidden fixed top-0 left-0 w-full h-screen bg-[#580a21] z-40 pt-20 px-6">
        
        <!-- Close X button -->
        <button id="closeMenuBtn" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-white">
          <i class="fas fa-times text-2xl"></i>
        </button>
        <div class="flex flex-col h-full">
          <div class="flex-1 overflow-y-auto">
            <ul class="uppercase text-white space-y-6 py-4">
              @if (Auth::check() && Auth::user()->role->id!==3)
                <li><a href="{{ Auth::user()->role->name==='admin' ? route('admin.dashboard') : (Auth::user()->role->name==='proprietaire'?route('proprietaire.dashboard'):'kljjj') }}" class="block py-2 hover:text-gray-300 transition duration-300">dashboard</a></li>
              @endif
              <li><a href="/home" class="block py-2 hover:text-gray-300 transition duration-300">home</a></li>
              <li><a href="{{ route('terrains') }}" class="block py-2 hover:text-gray-300 transition duration-300">Terrains</a></li>
              
              @if (Auth::check() && Auth::user()->role->id===3)
                <li><a href="{{ route('joueur.squadBuilder.create') }}" class="block py-2 hover:text-gray-300 transition duration-300">squad builder</a></li>
                <li><a href="/squads" class="block py-2 hover:text-gray-300 transition duration-300">squads</a></li>
              @endif
              
              <li><a href="{{ route('joueur.squads.user') }}" class="block py-2 hover:text-gray-300 transition duration-300">mes Squads</a></li>
              
              <li class="py-2">
                <div class="relative">
                  <input
                    type="text"
                    class="pl-3 bg-white/20 text-white h-12 w-full rounded-md capitalize outline-none placeholder-white"
                    placeholder=""
                  />
                  <label class="absolute right-4 top-3 text-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </label>
                </div>
              </li>
            </ul>
          </div>
          
          <div class="py-6 border-t border-white/20">
            @if (Auth::check())
              <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                  <i class="fa-solid fa-circle-user fa-lg mr-3"></i>
                  <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                </div>
                <a href="{{ route('profile') }}" class="text-white hover:text-gray-300">
                  <i class="fa-solid fa-gear"></i>
                </a>
              </div>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white hover:bg-gray-100 text-[#580a21] font-medium py-3 px-4 rounded-md transition duration-300 ease-in-out">
                  <i class="fa-solid fa-arrow-right-to-bracket"></i>
                  <span>Logout</span>
                </button>
              </form>
            @else
              <div class="space-y-3">
                <a href="{{ route('showLogin') }}" class="block w-full text-center bg-white hover:bg-gray-100 text-[#580a21] font-semibold py-3 px-6 rounded-md shadow-md transition duration-300">
                  Login
                </a>
                <a href="{{ route('showRegister') }}" class="block w-full text-center bg-transparent hover:bg-white/10 text-white font-semibold py-3 px-6 rounded-md border border-white transition duration-300">
                  Sign Up
                </a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </header>

    <!-- Main content with padding for fixed header -->
    <main class="min-h-screen"> 
      @yield('content')
    </main>
    
   <!-- Footer -->
<footer class="bg-black w-full h-[10rem] flex flex-col justify-center items-center px-6">
  <div class="container mx-auto flex flex-row items-center justify-between">
    <!-- Copyright à gauche -->
    <div class="text-gray-400 text-sm">
      ©2025
    </div>
    
    <!-- Logo au centre -->
    <div class="absolute left-1/2 transform -translate-x-1/2">
      
       <img 
            src="http://127.0.0.1:8000/assets/img/soccer-red-removebg-preview.png" 
            class=" w-14" 
            alt="logo" 
        />
    </div>
    
    <!-- Médias sociaux à droite -->
    <div class="flex items-center space-x-4">
      <a href="#" class="text-white hover:text-gray-300">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#" class="text-white hover:text-gray-300">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="#" class="text-white hover:text-gray-300">
        <i class="fab fa-behance"></i>
      </a>
      <a href="#" class="text-white hover:text-gray-300">
        <i class="fab fa-soundcloud"></i>
      </a>
    </div>
  </div>
  
  <!-- Liens supplémentaires -->
  <div class="container mx-auto flex justify-center mt-4 space-x-4 text-gray-400 text-sm">
    <a href="#" class="hover:text-white">FR</a>
    <span>|</span>
    <a href="#" class="hover:text-white">EN</a>
  </div>
</footer>
    
    <script>
      // Script for handling regular header background
      const currentPage = window.location.pathname;
      const header = document.getElementById('header');
      
      if (header) {
        if (currentPage === '/home' || currentPage === '/' || currentPage==='/proprietaire/' || currentPage==='/proprietaire/home' || currentPage==='/proprietaire') {
          header.style.backgroundColor = 'transparent';
        } else {
          header.style.backgroundColor = '#580a21';
        }
      }
      
      // Mobile menu toggle
      const menuBtn = document.getElementById('menuBtn');
      const closeMenuBtn = document.getElementById('closeMenuBtn');
      const mobileMenu = document.getElementById('mobileMenu');
      
      // Function to open menu
      function openMenu() {
        mobileMenu.classList.add('open');
        menuBtn.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
      
      // Function to close menu
      function closeMenu() {
        mobileMenu.classList.remove('open');
        menuBtn.classList.remove('active');
        document.body.style.overflow = 'auto';
      }
      
      // Open menu with hamburger button
      menuBtn.addEventListener('click', openMenu);
      
      // Close menu with X button
      closeMenuBtn.addEventListener('click', closeMenu);
      
      // Close menu when clicking on a link
      const mobileLinks = mobileMenu.querySelectorAll('a');
      mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
          mobileMenu.classList.remove('open');
          menuBtn.classList.remove('active');
          document.body.style.overflow = 'auto';
        });
      });
      
      // Close menu when resizing to desktop size
      window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { // 768px is the md breakpoint in Tailwind
          mobileMenu.classList.remove('open');
          menuBtn.classList.remove('active');
          document.body.style.overflow = 'auto';
        }
      });

function searchCities(value) {
  let containerTerrains = document.getElementById('container_terrains');
  let contentSearch = document.getElementById('content_search');
  
  if (value.length > 0) {
    containerTerrains.classList.remove('hidden');
    
    // Afficher un indicateur de chargement
    contentSearch.innerHTML = `
      <div class="text-center w-full col-span-1 sm:col-span-2 lg:col-span-3">
        <i class="fa-solid fa-spinner fa-spin fa-2x mb-3"></i>
        <p>Recherche en cours...</p>
      </div>
    `;
    
    fetch(`/search/terrains/${value}`, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
    })
    .then(response => {
      if (!response.ok) throw new Error('Erreur réseau');
      return response.json();
    })
    .then(data => {
      contentSearch.innerHTML = '';
      console.log(data[0]);
      if (data[0].length>0) {
        data[0].forEach(terrain => {
          contentSearch.innerHTML+=`
            <div class="bg-white/10 min-w-[50%] mb-[5rem] rounded-lg p-4 hover:bg-white/20 transition duration-300 transform ">
              <a href="/terrains/${terrain.id}" class="block h-full">
                <h3 class="font-bold text-lg">${terrain.name}</h3>
                <p class="mt-1"><i class="fa-solid fa-location-dot mr-2"></i>${terrain.city}</p>
                ${terrain.size ? `<p class="mt-1"><i class="fa-solid fa-ruler mr-2"></i>${terrain.size}</p>` : ''}
                ${terrain.price_hour ? `<p class="text-green-400 font-semibold mt-2">${terrain.price_hour} DH/heure</p>` : ''}
                <button class="mt-3 bg-[#580a21] hover:bg-[#6c0c29] text-white py-1 px-4 rounded text-sm transition-all duration-300">
                  Voir détails
                </button>
              </a>
            </div>`;
        });
      } else {
        // Aucun résultat trouvé
        contentSearch.innerHTML = `
          <div class="text-center mb-[5rem] w-full col-span-1 sm:col-span-2 lg:col-span-3">
            <i class="fa-solid fa-search fa-2x mb-3"></i>
            <p class="text-lg">Aucun terrain trouvé pour "${value}"</p>
            <p class="text-sm text-gray-400 mt-2">Essayez une autre ville ou consultez tous les terrains</p>
            <a href="/terrains" class="inline-block mt-4 bg-[#580a21] hover:bg-[#6c0c29] text-white py-2 px-4 rounded transition-all duration-300">
              Voir tous les terrains
            </a>
          </div>
        `;
      }
    })
    .catch(error => {
      console.error("Erreur:", error);
      contentSearch.innerHTML = `
        <div class="text-center w-full col-span-1 sm:col-span-2 lg:col-span-3">
          <i class="fa-solid fa-circle-exclamation fa-2x mb-3"></i>
          <p class="text-lg text-red-400">Erreur lors du chargement des terrains</p>
          <p class="mt-2">Veuillez réessayer plus tard</p>
        </div>
      `;
    });
  } else {
    containerTerrains.classList.add('hidden');
  }
}

function closeSearchCities() {
  const containerTerrains = document.getElementById('container_terrains');
  containerTerrains.classList.add('hidden');
  
  // Vider l'input de recherche
  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.value = '';
  }
}
    </script>
  </body>
</html>







 