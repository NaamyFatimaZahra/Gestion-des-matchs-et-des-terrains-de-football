<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite('resources/css/app.css')
    <title> @yield('title') </title>
    <style>
        body {
            background-color: #0f1419;
            color: white;
        }
        .sidebar-icon {
            width: 28px;
            height: 28px;
        }
    </style>
</head>
<body class="flex h-screen text-white ">
     <!-- Sidebar (maintenant fixed) -->
    <div class="group fixed top-0 left-0 h-screen  bg-gray-900 w-[5rem] flex flex-col items-start  py-4 z-50  hover:w-[13rem] px-3 ">
        <!-- logo -->
        <div class="text-gray-400 relative hover:text-white cursor-pointer h-[3rem] w-[4rem] ">
           <a href="{{ route('home') }}" class="">
            <img
            src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}"
            class="w-full absolute top-[3rem] left-[50%] translate-x-[-50%] translate-y-[-50%] "
            alt="Soccer ball"
          />
           </a>
        </div>
        
        <!-- home -->
        <div class=" h-[3rem] flex p-3 px-5 mt-[6rem] {{ request()->routeIs('home') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer ">
            <a href="{{ route('home') }}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-house "></i>
               <p class="capitalize hidden group-hover:block">home</p>
            </a>
        </div>

        <!-- Chart Icon (Dashboard) -->
        <div class=" h-[3rem] flex p-3 px-5  {{ request()->routeIs('*.dashboard') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer  ">
            <a href="{{ Auth::user()->role->name==='admin' ? route('admin.dashboard') :  (Auth::user()->role->name==='proprietaire'?route('proprietaire.dashboard'):'ll') }}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-chart-line"></i>    
                <p class="capitalize hidden group-hover:block">dashboard</p>
            </a>
        </div>
        
        <!-- Terrains Icon -->
        <div class=" h-[3rem] flex p-3 px-5  items-center {{ request()->routeIs('*.terrains.*') ||  request()->routeIs('*.terrain.*') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer p-3">
            <a href="{{ Auth::user()->role->name==='admin' ? route('admin.terrains.index') :  (Auth::user()->role->name==='proprietaire'?route('proprietaire.terrains.index'):'ll') }}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-futbol "></i>
                <p class="capitalize hidden group-hover:block">terrains</p>
            </a> 
        </div>
        
        
     @if (Auth::user()->role->name==='admin')
        <!-- Users Icon -->
        <div class="h-[3rem] flex p-3 px-5  {{ request()->routeIs('admin.users.*') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer p-3">
            <a href="{{ route('admin.users.index')}}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-users"></i>         
                <p class="capitalize hidden group-hover:block">users</p>
            </a>
        </div>

        
         <!-- Settings Icon -->
        <div class="h-[3rem] flex p-3 px-5  {{ request()->routeIs('admin.services.*') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer p-3">
            <a href="{{ route('admin.services.index') ?? '#' }}" class="flex gap-3 justify-center items-center">
                <i class="fas fa-gear"></i>   
                <p class="capitalize hidden group-hover:block">services</p>
            </a>
        </div>
     @endif
       @if (Auth::user()->role->name==='proprietaire')
        <!-- reservation Icon -->
        <div class="h-[3rem] flex p-3 px-5  {{request()->routeIs('proprietaire.reservation.*') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer p-3">
            <a href="{{ route('proprietaire.reservation.index') }}" class="flex gap-3 justify-center items-center">
                <i class="fa-solid fa-ticket"></i>        
                <p class="capitalize hidden group-hover:block">reservations</p>
            </a>
        </div>
        <!-- commets Icon -->
        <div class="h-[3rem] flex p-3 px-5  {{request()->routeIs('proprietaire.comments.index') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer p-3">
            <a href="{{ route('proprietaire.comments.index') }}" class="flex gap-3 justify-center items-center">
                <i class="fa-solid fa-comments"></i>
                <p class="capitalize hidden group-hover:block">avis</p>
            </a>
        </div>
     @endif
      
        <!-- Divider -->
        <div class="w-[80%]  h-px bg-gray-700 my-2"></div>
        
        <!-- Logout Icon -->
        <div class="text-gray-400 hover:text-white cursor-pointer h-[3rem] flex p-3 px-5   items-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex gap-3 justify-center items-center">
                    <i class="fas fa-sign-out-alt " ></i>
                    <p class="capitalize hidden group-hover:block">logout</p>
                </button>
            </form>
        </div>
    </div>  

    <!-- Middle Panel (avec marge à gauche pour la sidebar) -->
    <div class="flex-1 bg-gray-800 flex flex-col ml-16 pl-4">
        <!-- Search Bar -->
        <div class="bg-gray-900 p-3 flex items-center justify-between border-b border-gray-700 sticky top-0 z-40">
            <div class="flex items-center bg-gray-800 rounded-lg px-3 py-2 w-64">
                <input type="text" placeholder="Type to Search..." class="bg-transparent border-none outline-none text-sm flex-1">
                <i class="fas fa-search text-gray-400 ml-2"></i>
            </div>
            <div class="flex items-center space-x-4">
                <i class="fas fa-cog text-gray-400"></i>
                <i class="fas fa-bell text-gray-400"></i>
                <i class="fas fa-fire text-gray-400"></i>
                <div class="flex space-x-2">
                    <div class="w-6 h-6 rounded-full bg-yellow-500 flex items-center justify-center">BV</div>
                </div>
            </div>
        </div>
        <div class="overflow-y-auto flex-1 px-4 ">
            @yield('content')
            <footer class="bg-gray-800 border-t border-gray-700 p-4 mt-8">
        <div class="container mx-auto text-center text-gray-400 text-sm">
            &copy; 2025 SportStats - Tous droits réservés
        </div>
    </footer>
        </div>
        
    </div>
      <!-- Footer -->
    
</body>
</html>