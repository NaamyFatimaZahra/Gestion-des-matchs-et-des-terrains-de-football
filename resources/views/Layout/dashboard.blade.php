<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface de Paris Sportifs</title>
    
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
<body class="flex h-screen text-white">
     <!-- Sidebar -->
    <div class="h-screen bg-gray-900 w-16 flex flex-col items-center py-4">
        <!-- logo -->
        <div class="text-gray-400 hover:text-white cursor-pointer h-[3rem] w-[5rem] relative e-spin">
           <a href="{{ route('home') }}" class="">
            <img
            src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}"
            class="w-full absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]  "
            alt="Soccer ball"
          />
           </a>
        </div>
        
        <!-- Chart Icon (Dashboard) -->
        <div class="{{ request()->routeIs('admin.dashboard') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer p-3 mt-[3rem]">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line"></i></a>
        </div>
        
        <!-- Terrains Icon -->
        <div class="{{ request()->routeIs('admin.terrains.*') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer p-3">
            <a href="{{ route('admin.terrains.index') }}"><i class="fas fa-futbol"></i></a>
        </div>
        
        <!-- Users Icon -->
        <div class="{{ request()->routeIs('admin.users.*') ? 'bg-red-600 rounded-md text-white' : 'text-gray-400 hover:text-white' }} cursor-pointer p-3">
            <a href="{{ route('admin.users.index') ?? '#' }}"><i class="fas fa-users"></i></a>
        </div>
        
        <!-- Divider -->
        <div class="w-8 h-px bg-gray-700 my-2"></div>
        
     

        <!-- Logout Icon -->
        <div class="text-gray-400 hover:text-white cursor-pointer p-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>  

    <!-- Middle Panel -->
    <div class="flex-1 bg-gray-800 flex flex-col">
        <!-- Search Bar -->
        <div class="bg-gray-900 p-3 flex items-center justify-between border-b border-gray-700">
            <div class="flex items-center bg-gray-800 rounded-lg px-3 py-2 w-64">
                <input type="text" placeholder="Type to Search..." class="bg-transparent border-none outline-none text-sm flex-1">
                <i class="fas fa-search text-gray-400 ml-2"></i>
            </div>
            <div class="flex items-center space-x-4">
                <i class="fas fa-cog text-gray-400"></i>
                <i class="fas fa-bell text-gray-400"></i>
                <i class="fas fa-fire text-gray-400"></i>
                <div class="flex space-x-2">
                    <div class="w-6 h-6 rounded-full bg-red-600 flex items-center justify-center">FC</div>
                    <div class="w-6 h-6 rounded-full bg-red-600 flex items-center justify-center">AR</div>
                    <div class="w-6 h-6 rounded-full bg-yellow-500 flex items-center justify-center">BV</div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
</body>
</html>