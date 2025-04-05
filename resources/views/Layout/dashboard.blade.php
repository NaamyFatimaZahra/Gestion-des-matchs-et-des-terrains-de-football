<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface de Paris Sportifs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <!-- Menu Icon -->
        <div class="text-gray-400 hover:text-white cursor-pointer mb-6 p-3">
            <i class="fas fa-bars"></i>
        </div>
        
        <!-- Divider -->
        <div class="w-8 h-px bg-gray-700 my-2"></div>
        
        <!-- Chart Icon -->
        <div class="text-gray-400 hover:text-white cursor-pointer p-3">
            <i class="fas fa-chart-line"></i>
        </div>
        
        <!-- Table Icon -->
        <div class="text-gray-400 hover:text-white cursor-pointer p-3">
            <i class="fas fa-table"></i>
        </div>
        
        <!-- Heart Icon -->
        <div class="text-gray-400 hover:text-white cursor-pointer p-3">
            <i class="fas fa-heart"></i>
        </div>
        
        <!-- Divider -->
        <div class="w-8 h-px bg-gray-700 my-2"></div>
        
        <!-- Soccer Ball Icon (Active) -->
        <div class="bg-red-600 rounded-md text-white cursor-pointer p-3">
           <a href=""> <i class="fas fa-futbol"></i></a>
        </div>
        <!-- services -->
        <div class="text-gray-400 hover:text-white cursor-pointer p-3">
           <a href=""> <i class="fa-solid fa-tags"></i></a>
        </div>
        
        <!-- Divider -->
        <div class="w-8 h-px bg-gray-700 my-2"></div>
        
       
        <!-- User Icon -->
        <div class="text-gray-400 hover:text-white cursor-pointer p-3">
            <i class="fas fa-user"></i>
        </div>
       
       
        <!-- Divider -->
        <div class="w-8 h-px bg-gray-700 my-2"></div>
        
        <!-- Search Icon -->
        <div class="text-gray-400 hover:text-white cursor-pointer p-3">
            <i class="fas fa-search"></i>
        </div>
        
       
        
        <!-- Divider -->
        <div class="w-8 h-px bg-gray-700 my-2"></div>
        
        <!-- Settings Icon -->
        <div class="text-gray-400 hover:text-white cursor-pointer mt-auto p-3">
            <i class="fas fa-cog"></i>
        </div>
        <div class="text-gray-400 hover:text-white cursor-pointer p-3">
    
     <form method="POST" action="{{ route('logout') }}" class="px-6">
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