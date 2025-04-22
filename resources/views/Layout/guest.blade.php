<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    />
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
            <li><a href="{{ route('joueur.squadBuilder') }}" class="nav-link hover:text-gray-300 transition duration-300">squad builder</a></li>
            <li><a href="/squads" class="nav-link hover:text-gray-300 transition duration-300">squads</a></li>
          @endif
          
          <li><a href="{{ route('about') }}" class="nav-link hover:text-gray-300 transition duration-300">about</a></li>
          <li class="flex items-center relative mx-4">
            <input
              type="text"
              id="searchInput"
              class="pl-3 bg-white/20 text-white h-[2.5rem] w-[17rem] rounded-md capitalize outline-none placeholder-white"
              placeholder="search for city"
            />
            <label class="absolute right-4 text-white" for="searchInput">
              <i class="fa-solid fa-magnifying-glass"></i>
            </label>
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
                <li><a href="{{ route('joueur.squadBuilder') }}" class="block py-2 hover:text-gray-300 transition duration-300">squad builder</a></li>
                <li><a href="/squads" class="block py-2 hover:text-gray-300 transition duration-300">squads</a></li>
              @endif
              
              <li><a href="{{ route('about') }}" class="block py-2 hover:text-gray-300 transition duration-300">about</a></li>
              
              <li class="py-2">
                <div class="relative">
                  <input
                    type="text"
                    class="pl-3 bg-white/20 text-white h-12 w-full rounded-md capitalize outline-none placeholder-white"
                    placeholder="search for city"
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
    <main class=" min-h-screen"> 
      @yield('content')
    </main>
    
    <footer class="bg-rose-50 border-t border-gray-200 p-4 shadow-inner w-full">
      <div class="container mx-auto text-center text-gray-600 text-sm">
        &copy; 2025 SportStats - Tous droits réservés
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
    </script>
  </body>
</html>