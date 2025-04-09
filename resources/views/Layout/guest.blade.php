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
  </head>
  <body class="relative w-full bg-gray-100">
     
        <header id="header" class="md:bg-transparent absolute w-full md:z-10">
          <nav class="container mx-auto px-4 py-3">
            <ul class="uppercase hidden md:flex items-center justify-center gap-8 text-white">
            @if (Auth::check())
                <li><a href="
              {{ Auth::user()->role->name==='admin'? route('admin.dashboard'): route('proprietaire.dashboard')  }}
              
              " class="nav-link hover:text-gray-300 transition duration-300">dashboard</a></li>
            @endif
              <li><a href="/home" class="nav-link hover:text-gray-300 transition duration-300">home</a></li>
              <li><a href="" class="nav-link hover:text-gray-300 transition duration-300">squad builder</a></li>
              <li><a href="/squads" class="nav-link hover:text-gray-300 transition duration-300">squads</a></li>
              <li><a href="" class="nav-link hover:text-gray-300 transition duration-300">about</a></li>
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
            <div class="text-gray-400 hover:text-white cursor-pointer flex p-3 px-5 items-center">
                <h1 class="font-medium mr-4">{{ Auth::user()->name }}</h1>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex gap-2 items-center bg-[#580a21] hover:bg-[#580a21] text-white font-medium py-3 px-3 rounded transition duration-300 ease-in-out">
                       <i class="fa-solid fa-arrow-right-to-bracket"></i>
                   
                    </button>
                </form>
            </div>
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
          </nav>
        </header>

        <!-- Mobile header for guests -->
        <header class="md:bg-transparent md:bottom-[93%] md:left-[60%] absolute py-1 px-6 w-[80%] bottom-4 left-[50%] translate-x-[-50%] rounded-[3rem] bg-[#4f4a4ac6] z-10">
          <nav>
            <ul class="text-[#cec3c3] flex justify-between text-[1.6rem] md:hidden">
             
              <li>
                <a href=""><i class="fas fa-chart-line  px-3 py-3 bg-[#580a21] rounded-[50%]"></i></a>
              </li>
              <li>
                <a href="/home"><i class="fa-solid fa-house px-3 py-3 bg-[#580a21] rounded-[50%]"></i></a>
              </li>
              <li>
                <a href=""><i class="fa-solid fa-futbol py-3"></i></a>
              </li>
              <li>
                <a href="/squads"><i class="fa-solid fa-people-group py-3"></i></a>
              </li>
              <li>
                <a href=""><i class="fa-solid fa-circle-info py-3"></i></a>
              </li>
              <li>
                <a href=""><i class="fa-solid fa-magnifying-glass py-3"></i></a>
              </li>
            </ul>
          </nav>
        </header>

        <!-- Main content -->
        <main>
          @yield('content')
        </main>
         <footer class="bg-gray-800 border-t border-gray-700 p-4 ">
        <div class="container mx-auto text-center text-gray-400 text-sm">
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
    </script>
  </body>
</html>