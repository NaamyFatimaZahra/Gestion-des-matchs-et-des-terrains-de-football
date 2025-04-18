@extends('Layout.guest')
@section('title', 'Accès Refusé')
@section('content')
<section class="flex min-h-[100vh] justify-center items-center bg-rose-50 px-4 py-6">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-xl shadow-lg max-w-md w-full border-t-4 border-[#580a21] mx-auto">
        <div class="flex justify-center mb-6 sm:mb-8">
            <div class="h-16 w-16 sm:h-20 sm:w-20 bg-rose-100 rounded-full flex items-center justify-center transform rotate-12 transition-transform hover:rotate-0 duration-300 overflow-hidden">
                 <img
                    src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}"
                    class="w-full h-full object-contain p-2"
                    alt="Soccer ball"
                 />
            </div>
        </div>
        
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2 sm:mb-3 font-sans text-center">Compte Suspendu</h1>
        
        <div class="h-0.5 w-20 sm:w-24 bg-[#580a21] mx-auto my-4 sm:my-5 opacity-75"></div>
        
        <p class="text-gray-700 mb-5 sm:mb-6 leading-relaxed text-sm sm:text-base">
            Votre compte a été temporairement suspendu en raison d'une violation des conditions d'utilisation de notre plateforme.
        </p>
        
        <div class="bg-rose-50 p-4 sm:p-5 rounded-lg mb-6 sm:mb-8 border-l-4 border-[#580a21]">
            <p class="text-xs sm:text-sm text-gray-600">
                Si vous pensez qu'il s'agit d'une erreur, veuillez contacter notre équipe d'assistance pour résoudre ce problème.
            </p>
        </div>
        
        <div class="flex flex-col space-y-3 sm:space-y-4">
            <a href="#" class="bg-[#580a21] hover:bg-[#420718] text-white py-2 sm:py-3 px-4 sm:px-6 rounded-lg transition duration-300 font-medium flex items-center justify-center text-sm sm:text-base">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1 sm:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                Contacter l'assistance
            </a>
            <a href="#" class="text-[#580a21] hover:text-[#420718] text-xs sm:text-sm flex items-center justify-center group">
                En savoir plus sur notre politique
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection