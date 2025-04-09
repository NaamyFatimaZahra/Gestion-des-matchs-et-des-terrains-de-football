    @extends('Layout.guest')
    @section('title', 'Accès Refusé')
    @section('content')
   <section class="flex h-[100vh]">
        <div class="flex justify-between items-center w-[70%] m-auto h-[80vh] bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Section de gauche (avec le design bordeaux similaire) -->
            <div class="relative h-full w-[50%] bg-[#580a21] rounded-tr-[8rem] rounded-br-[8rem]">
                <div class="absolute left-[50%] top-[50%] translate-x-[-50%] translate-y-[-50%] flex justify-center items-center flex-col">
                    <!-- Logo/Icon avec Font Awesome -->
                    <div class="flex justify-center mb-4">
                        <div class="h-16 w-16 rounded-full border-2 border-[white] flex items-center justify-center">
                            <i class="fas fa-user-clock text-[white] text-3xl"></i>
                        </div>
                    </div>
                    
                    <!-- Titre -->
                    <h2 class="text-2xl font-medium text-center text-[white] mb-1">Processus d'inscription</h2>
                    <p class="text-center text-gray-300 mb-6">Veuillez patienter</p>
                    <a href="/" class="text-[#580a21] pt-[1rem] bg-[white] py-[1rem] px-[1rem] text-center rounded-lg w-[70%]">Retour à l'accueil</a>
                </div>
            </div>

            <!-- Section du message d'attente -->
            <div class="w-[50%] p-8 flex flex-col justify-center items-center">
                <div class="text-center mb-8">
                    <div class="inline-flex justify-center items-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 mb-4">
                        <i class="fas fa-hourglass-half text-4xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[#580a21] mb-4">Compte en cours de traitement</h2>
                    <p class="text-gray-600 mb-6">Votre compte est actuellement en cours d'examen. Nous confirmerons votre inscription aussi vite que possible.</p>
                    
                    <!-- Barre de progression -->
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-6">
                        <div class="bg-[#580a21] h-2.5 rounded-full w-2/3 "></div>
                    </div>
                    
                    <div class="text-sm text-gray-500 mb-8">
                        <p>Vous recevrez un e-mail de confirmation dès que votre compte sera activé.</p>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex flex-col gap-4">
                        <a href="mailto:support@example.com" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 inline-flex items-center justify-center">
                            <i class="far fa-envelope mr-2"></i>
                            Contacter le support
                        </a>
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-[#580a21] text-white rounded-md hover:bg-[#7a0d2b] inline-flex items-center justify-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Retour à la connexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection