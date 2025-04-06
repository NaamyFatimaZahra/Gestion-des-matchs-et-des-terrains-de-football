    @extends('Layout.guest')
    @section('title', 'Accès Refusé')
    @section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8 text-center">
    <div class="mb-6">
    <div class="mx-auto mb-4 w-24 h-24 bg-red-100 rounded-full flex items-center justify-center">
    <i class="fas fa-lock text-red-500 text-5xl"></i>
    </div>
    <h1 class="text-3xl font-bold text-[#580a21] mb-4">Accès Refusé</h1>
    <p class="text-gray-600 mb-6">
    Vous n'avez pas la permission d'accéder à cette page.
    Veuillez vous connecter avec les autorisations appropriées.
    </p>
    </div>
           <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-[#580a21] text-white rounded-md hover:bg-[#7a0d2b] transition duration-300 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Se connecter
                </a>
                
                <a href="{{ route('home') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 flex items-center justify-center">
                    <i class="fas fa-home mr-2"></i>
                    Page d'accueil
                </a>
            </div>
        </div>
    </div>
    @endsection