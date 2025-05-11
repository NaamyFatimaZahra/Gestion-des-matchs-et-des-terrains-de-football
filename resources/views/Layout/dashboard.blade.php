<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite('resources/css/app.css')
    <title> @yield('title') </title>
    <style>
        body {
            background-color: #fff1f2; /* bg-rose-50 */
            color: #1f2937; /* text-gray-800 */
        }
        .sidebar-icon {
            width: 28px;
            height: 28px;
        }
        /* Add these transition styles */
        .sidebar-transition {
            transition: width 0.3s ease, transform 0.3s ease;
            overflow-x: hidden; /* Empêche le débordement horizontal */
        }
        .menu-item {
            transition: background-color 0.3s ease, width 0.3s ease;
            white-space: nowrap; /* Empêche le texte de se mettre sur plusieurs lignes */
        }
        .menu-text {
            transition: opacity 0.3s ease, visibility 0.3s ease;
            opacity: 0;
            visibility: hidden;
        }
        .sidebar-transition:hover .menu-text {
            opacity: 1;
            visibility: visible;
        }
        /* Assure que la largeur du contenu principal s'adapte correctement */
        #main-content {
            transition: margin-left 0.3s ease;
        }
        
        /* Style pour la sidebar mobile */
        @media (max-width: 639px) {
            .sidebar-mobile {
                transform: translateX(-100%);
            }
            .sidebar-mobile.active {
                transform: translateX(0);
            }
        }
        
        /* Overlay pour mobile */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }
        .mobile-overlay.active {
            display: block;
        }
        
        /* Style pour le bouton de fermeture du sidebar mobile */
        #mobile-close-btn {
            display: none;
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: #420718;
            color: white;
            border: none;
            border-radius: 50%;
            width: 2rem;
            height: 2rem;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 60;
        }
        
        /* Afficher le bouton de fermeture uniquement en mode mobile lorsque la sidebar est active */
        @media (max-width: 640px) {
            #sidebar.active #mobile-close-btn {
                display: flex;
            }
        }
    </style>
</head>
<body class="flex  h-screen text-gray-800 bg-rose-50">
    <button id="mobile-menu-toggle" class="fixed top-4 left-4 z-50 sm:hidden bg-[#580a21] text-white p-2 px-3 rounded-md shadow-lg">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Overlay for mobile -->
    <div id="mobile-overlay" class="mobile-overlay"></div>
    
    <!-- Sidebar avec état par défaut différent selon device -->
    <div id="sidebar" class="fixed top-0 left-0 h-screen bg-[#580a21] w-[5rem] flex flex-col items-start py-4 z-50 hover:w-[13rem] px-3 sidebar-transition sidebar-mobile sm:transform-none sm:block hidden">
        <!-- Bouton de fermeture (uniquement visible en mobile) -->
        <button id="mobile-close-btn" class="sm:hidden">
            <i class="fas fa-times"></i>
        </button>
        
        <!-- logo -->
        <div class="text-white relative hover:text-white cursor-pointer h-[3rem] w-[4rem]">
           <a href="{{ route('home') }}" class="">
            <img
            src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}"
            class="w-full absolute top-[3rem] left-[50%] translate-x-[-50%] translate-y-[-50%]"
            alt="Soccer ball"
          />
           </a>
        </div>
        
        <!-- home -->
        <div class="h-[3rem] w-[100%]  flex p-3 px-5 mt-[6rem] {{ request()->routeIs('home') ? 'bg-[#420718] rounded-md text-white group-hover:w-[90%]' : 'text-white hover:text-white' }} cursor-pointer menu-item">
            <a href="{{ route('home') }}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-house"></i>
               <p class="capitalize menu-text">home</p>
            </a>
        </div>

        <!-- Chart Icon (Dashboard) -->
        <div class="h-[3rem] w-[100%]  flex p-3 px-5 {{ request()->routeIs('*.dashboard') ? 'bg-[#420718] rounded-md text-white group-hover:w-[90%]' : 'text-white hover:text-white' }} cursor-pointer menu-item">
            <a href="{{ Auth::user()->role->name==='admin' ? route('admin.dashboard') :  (Auth::user()->role->name==='proprietaire'?route('proprietaire.dashboard'):'ll') }}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-chart-line"></i>    
                <p class="capitalize menu-text">dashboard</p>
            </a>
        </div>
        
        <!-- Terrains Icon -->
        <div class="h-[3rem] w-[100%]  flex p-3 px-5 items-center {{ request()->routeIs('*.terrains.*') ||  request()->routeIs('*.terrain.*') ? 'bg-[#420718] rounded-md text-white group-hover:w-[90%]' : 'text-white hover:text-white' }} cursor-pointer p-3 menu-item">
            <a href="{{ Auth::user()->role->name==='admin' ? route('admin.terrains.index') :  (Auth::user()->role->name==='proprietaire'?route('proprietaire.terrains.index'):'ll') }}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-futbol"></i>
                <p class="capitalize menu-text">terrains</p>
            </a> 
        </div>
        
        
     @if (Auth::user()->role->name==='admin')
        <!-- Users Icon -->
        <div class="h-[3rem] w-[100%]  flex p-3 px-5 {{ request()->routeIs('admin.users.*') ? 'bg-[#420718] rounded-md text-white group-hover:w-[90%]' : 'text-white hover:text-white' }} cursor-pointer p-3 menu-item">
            <a href="{{ route('admin.users.index')}}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-users"></i>         
                <p class="capitalize menu-text">users</p>
            </a>
        </div>

        
         <!-- Settings Icon -->
        <div class="h-[3rem] w-[100%]  flex p-3 px-5 {{ request()->routeIs('admin.services.*') ? 'bg-[#420718] rounded-md text-white group-hover:w-[90%]' : 'text-white hover:text-white' }} cursor-pointer p-3 menu-item">
            <a href="{{ route('admin.services.index') ?? '#' }}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-gear"></i>   
                <p class="capitalize menu-text">services</p>
            </a>
        </div>
     @endif
       @if (Auth::user()->role->name==='proprietaire')
        <!-- reservation Icon -->
        <div class="h-[3rem] w-[100%]  flex p-3 px-5 {{request()->routeIs('proprietaire.reservation.*') ? 'bg-[#420718] rounded-md text-white group-hover:w-[90%]' : 'text-white hover:text-white' }} cursor-pointer p-3 menu-item">
            <a href="{{ route('proprietaire.reservation.index') }}" class="flex gap-3 justify-center items-center">
                <i class="fa-solid fa-ticket"></i>        
                <p class="capitalize menu-text">reservations</p>
            </a>
        </div>
        <!-- commets Icon -->
        <div class="h-[3rem] w-[100%]  flex p-3 px-5 {{request()->routeIs('proprietaire.comments.index') ? 'bg-[#420718] rounded-md text-white group-hover:w-[90%]' : 'text-white hover:text-white' }} cursor-pointer p-3 menu-item">
            <a href="{{ route('proprietaire.comments.index') }}" class="flex gap-3 justify-center items-center">
                <i class="fa-solid fa-comments"></i>
                <p class="capitalize menu-text">avis</p>
            </a>
        </div>
     @endif

        <!-- Profile Icon -->
        <div class="h-[3rem] w-[100%] flex p-3 px-5 {{ request()->routeIs('profile') ? 'bg-[#420718] rounded-md text-white group-hover:w-[90%]' : 'text-white hover:text-white' }} cursor-pointer p-3 menu-item">
            <a href="{{ route('profile') }}" class="flex gap-3 justify-center items-center">
                <i class="fa-solid fa-user"></i>         
                <p class="capitalize menu-text">profile</p>
            </a>
        </div>
      
        <!-- Divider -->
        <div class="w-[80%] h-px bg-rose-200 my-2"></div>
        
        <!-- Logout Icon -->
        <div class="text-white hover:text-white cursor-pointer h-[3rem] flex p-3 px-5 items-center menu-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex gap-3 justify-center items-center">
                    <i class="fas fa-sign-out-alt"></i>
                    <p class="capitalize menu-text">logout</p>
                </button>
            </form>
        </div>
    </div>  

    <!-- Middle Panel (avec marge à gauche pour la sidebar) -->
    <div id="main-content" class="flex-1 flex flex-col  md:items-end transition-all duration-300">
        <!-- Search Bar -->
        <div class="bg-rose-50 p-3 flex items-center  justify-between border-b border-rose-50 fixed w-[100%] md:w-[89%] lg:w-[92%] top-0 z-40 ">
            <div class="flex items-center  m-auto md:m-0 rounded-lg px-3 py-2 w-64">
                <input type="text" placeholder="Type to Search..." class="py-[7px] ml-5 pl-3  rounded-sm border-solid border-rose-50 outline-none text-sm flex-1 text-gray-600">
                <i class="fas fa-search text-gray-400 ml-2"></i>
            </div>
            <div class="flex items-center space-x-4">
               
                <div class="">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center">         
                        <a href="{{ route('profile') }}">   
                            <i class="fa-solid fa-circle-user text-[1.4rem] text-[#420718e2]"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 mt-[6rem]  md:w-[89%] lg:w-[92%] ">
            @yield('content')
          
        </div>
        <footer class="bg-rose-50 border-t border-rose-50 p-4 shadow-inner w-full">
            <div class="container mx-auto text-center text-gray-500 text-sm">
                &copy; 2025 SportStats - Tous droits réservés
            </div>
        </footer>
    </div>

    <!-- Script pour gérer l'affichage de la sidebar en mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileCloseBtn = document.getElementById('mobile-close-btn');
            const sidebar = document.getElementById('sidebar');
            const mobileOverlay = document.getElementById('mobile-overlay');
            const mainContent = document.getElementById('main-content');
            
            // Fonction pour basculer la sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                mobileOverlay.classList.toggle('active');
                
                // Pour les écrans mobiles, afficher la barre latérale à une largeur plus grande
                if (sidebar.classList.contains('active')) {
                    sidebar.classList.remove('hidden');
                    sidebar.style.width = '13rem'; // Élargir la sidebar en mode mobile
                    
                    // Afficher tous les textes des menus en mobile
                    const menuTexts = document.querySelectorAll('.menu-text');
                    menuTexts.forEach(text => {
                        text.style.opacity = '1';
                        text.style.visibility = 'visible';
                    });
                } else {
                    if (window.innerWidth < 640) { // sm breakpoint
                        setTimeout(() => {
                            sidebar.classList.add('hidden');
                        }, 300); // Attendre la fin de l'animation
                    }
                }
            }
            
            // Fonction pour fermer la sidebar en mobile
            function closeSidebar() {
                sidebar.classList.remove('active');
                mobileOverlay.classList.remove('active');
                
                if (window.innerWidth < 640) { // sm breakpoint
                    setTimeout(() => {
                        sidebar.classList.add('hidden');
                    }, 300); // Attendre la fin de l'animation
                }
            }
            
            // Écouteur d'événement pour le bouton de menu mobile
            mobileMenuToggle.addEventListener('click', toggleSidebar);
            
            // Écouteur d'événement pour le bouton de fermeture
            mobileCloseBtn.addEventListener('click', closeSidebar);
            
            // Cliquer sur l'overlay ferme la sidebar
            mobileOverlay.addEventListener('click', closeSidebar);
            
            // Ajuster l'affichage lors du redimensionnement de la fenêtre
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 640) { // sm breakpoint
                    sidebar.classList.remove('active');
                    sidebar.classList.remove('hidden'); // S'assurer que sidebar est visible sur desktop
                    mobileOverlay.classList.remove('active');
                    sidebar.style.width = '5rem'; // Réinitialiser à la largeur par défaut
                    
                    // Réinitialiser l'opacité des textes
                    const menuTexts = document.querySelectorAll('.menu-text');
                    menuTexts.forEach(text => {
                        text.style.opacity = '';
                        text.style.visibility = '';
                    });
                } else {
                    // Sur mobile, cacher la sidebar si elle n'est pas active
                    if (!sidebar.classList.contains('active')) {
                        sidebar.classList.add('hidden');
                    }
                }
            });
            
            // Vérifier l'état initial selon la taille d'écran
            if (window.innerWidth < 640) {
                // Sur mobile, cacher la sidebar sauf si elle est active
                if (!sidebar.classList.contains('active')) {
                    sidebar.classList.add('hidden');
                }
            } else {
                // Sur desktop, toujours afficher la sidebar
                sidebar.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>