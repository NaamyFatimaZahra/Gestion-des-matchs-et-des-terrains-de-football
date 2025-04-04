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
    <!-- Sidebar for Admin -->
    @auth
      @if(Auth::user()->is_admin)
      <aside class="fixed top-0 left-0 h-full w-64 bg-[#580a21] shadow-lg z-20">
        <div class="flex items-center justify-center h-20 border-b border-[#6e152e]">
          <h1 class="text-white text-xl font-bold">Admin Dashboard</h1>
        </div>
        <nav class="mt-5">
          <ul class="text-[#cec3c3]">
            <li class="mb-2">
              <a href="/admin/dashboard" class="flex items-center px-6 py-3 hover:bg-[#6e152e]">
                <i class="fa-solid fa-gauge-high mr-3"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="mb-2">
              <a href="/home" class="flex items-center px-6 py-3 hover:bg-[#6e152e]">
                <i class="fa-solid fa-house mr-3"></i>
                <span>Home</span>
              </a>
            </li>
            <li class="mb-2">
              <a href="/squads" class="flex items-center px-6 py-3 hover:bg-[#6e152e]">
                <i class="fa-solid fa-people-group mr-3"></i>
                <span>Squads</span>
              </a>
            </li>
            <li class="mb-2">
              <a href="/admin/users" class="flex items-center px-6 py-3 hover:bg-[#6e152e]">
                <i class="fa-solid fa-users mr-3"></i>
                <span>Users</span>
              </a>
            </li>
            <li class="mb-2">
              <a href="/admin/settings" class="flex items-center px-6 py-3 hover:bg-[#6e152e]">
                <i class="fa-solid fa-gear mr-3"></i>
                <span>Settings</span>
              </a>
            </li>
            <li class="mb-2">
              <a href="" class="flex items-center px-6 py-3 hover:bg-[#6e152e]">
                <i class="fa-solid fa-futbol mr-3"></i>
                <span>Squad Builder</span>
              </a>
            </li>
            <li class="mb-2">
              <a href="" class="flex items-center px-6 py-3 hover:bg-[#6e152e]">
                <i class="fa-solid fa-circle-info mr-3"></i>
                <span>About</span>
              </a>
            </li>
            <li class="border-t border-[#6e152e] mt-4 pt-4">
              <form method="POST" action="{{ route('logout') }}" class="px-6">
                @csrf
                <button type="submit" class="flex items-center py-3 w-full text-left hover:bg-[#6e152e] text-red-400">
                  <i class="fa-solid fa-sign-out-alt mr-3"></i>
                  <span>Logout</span>
                </button>
              </form>
            </li>
          </ul>
        </nav>
      </aside>

      <!-- Main content with margin for admin -->
      <div class="ml-64">
        <!-- Admin Header -->
        <header class="bg-white shadow-md py-4 px-6">
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <h2 class="text-2xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}</h2>
            </div>
            <div class="flex items-center space-x-4">
              <div class="relative">
                <input
                  type="text"
                  id="adminSearchInput"
                  class="pl-10 pr-4 py-2 bg-gray-100 text-gray-800 rounded-full w-64 focus:outline-none focus:ring-2 focus:ring-[#580a21]"
                  placeholder="Search..."
                />
                <label class="absolute left-3 top-2.5 text-gray-500" for="adminSearchInput">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </label>
              </div>
              <div class="relative">
                <button class="text-gray-600 hover:text-gray-800">
                  <i class="fa-solid fa-bell text-xl relative">
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                  </i>
                </button>
              </div>
            </div>
          </div>
        </header>

        <!-- Main content area -->
        <main class="p-6">
          @yield('content')
        </main>
      </div>

      @else
      <!-- Regular user content (no admin sidebar) -->
      <div>
        <!-- Regular Header for non-admin authenticated users -->
        <header id="header" class="md:bg-transparent absolute w-full md:z-10">
          <nav class="container mx-auto px-4 py-3">
            <ul class="uppercase hidden md:flex items-center justify-center gap-8 text-white">
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
              <div class="flex items-center space-x-4">
                <span class="text-white font-semibold">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                  @csrf
                  <button type="submit" class="btn-primary bg-white hover:bg-gray-100 text-red-600 font-semibold py-2 px-6 rounded-full shadow-md transition duration-300">
                    <i class="fa-solid fa-sign-out-alt mr-1"></i> Logout
                  </button>
                </form>
              </div>
            </ul>
          </nav>
        </header>

        <!-- Mobile header for non-admin authenticated users -->
        <header class="md:bg-transparent md:bottom-[93%] md:left-[60%] absolute py-1 px-6 w-[80%] bottom-4 left-[50%] translate-x-[-50%] rounded-[3rem] bg-[#4f4a4ac6] z-10">
          <nav>
            <ul class="text-[#cec3c3] flex justify-between text-[1.6rem] md:hidden">
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
              <li>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                  @csrf
                  <button type="submit" class="bg-transparent border-0">
                    <i class="fa-solid fa-sign-out-alt py-3 text-red-400"></i>
                  </button>
                </form>
              </li>
            </ul>
          </nav>
        </header>

        <!-- Main content -->
        <main>
          @yield('content')
        </main>
      </div>
      @endif
    @else
      <!-- Guest user content -->
      <div>
        <header id="header" class="md:bg-transparent absolute w-full md:z-10">
          <nav class="container mx-auto px-4 py-3">
            <ul class="uppercase hidden md:flex items-center justify-center gap-8 text-white">
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
              <div class="flex items-center space-x-4">
                <a href="{{ route('showLogin') }}" class="btn-primary bg-white hover:bg-gray-100 text-[#580a21] font-semibold py-2 px-6 rounded-full shadow-md transition duration-300">
                  Login
                </a>
                <a id="signUp" href="{{ route('showRegister') }}" class="btn-primary bg-transparent hover:bg-white/10 text-white font-semibold py-2 px-6 rounded-full border border-white transition duration-300">
                  Sign Up
                </a>
              </div>
            </ul>
          </nav>
        </header>

        <!-- Mobile header for guests -->
        <header class="md:bg-transparent md:bottom-[93%] md:left-[60%] absolute py-1 px-6 w-[80%] bottom-4 left-[50%] translate-x-[-50%] rounded-[3rem] bg-[#4f4a4ac6] z-10">
          <nav>
            <ul class="text-[#cec3c3] flex justify-between text-[1.6rem] md:hidden">
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
      </div>
    @endauth

    <script>
      // Script for handling regular header background
      const currentPage = window.location.pathname;
      const header = document.getElementById('header');
      
      if (header) {
        if (currentPage === '/home' || currentPage === '/') {
          header.style.backgroundColor = 'transparent';
        } else {
          header.style.backgroundColor = '#580a21';
        }
      }
    </script>
  </body>
</html>