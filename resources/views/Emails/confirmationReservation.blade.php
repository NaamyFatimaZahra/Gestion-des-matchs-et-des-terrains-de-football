<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
    <meta name="description" content="Confirmation de votre réservation">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="max-w-2xl mx-auto p-5">
        <div class="bg-white rounded-lg overflow-hidden shadow-lg">
            <!-- Header -->
            <div class="bg-[#580a21] text-white text-center py-4">
                <h1 class="text-2xl font-bold">Confirmation de Réservation</h1>
            </div>
            
            <!-- Content -->
            <div class="p-6 bg-gray-50">
                <p class="text-gray-800 mb-4">Bonjour {{ $reservation->reservationUsers->first()->user->name ?? 'cher client' }},</p>
                
                <p class="text-gray-800 mb-4">Nous vous confirmons votre réservation sur notre plateforme.</p>
                
                <p class="font-semibold text-gray-800 mb-2">Détails de la réservation :</p>
                <ul class="bg-white rounded-lg border border-gray-200 text-gray-700 mb-6 px-6 py-4">
                    <li class="py-1">
                        <span class="font-semibold">Terrain :</span> 
                        <span>{{ $reservation->terrain->name ?? 'N/A' }}</span>
                    </li>
                    <li class="py-1">
                        <span class="font-semibold">Date :</span> 
                        <span>{{ $reservation->date_reservation  }}</span>
                    </li>
                    <li class="py-1">
                        <span class="font-semibold">Heure :</span> 
                        <span>{{ $reservation->heure_debut }} - 
                        {{ $reservation->heure_fin  }}</span>
                    </li>
                    <li class="py-1">
                        <span class="font-semibold">Nombre de joueurs :</span> 
                        <span>{{ $reservation->reservationUsers->count() ?? 'N/A' }}</span>
                    </li>
                    <li class="py-1">
                        <span class="font-semibold">Prix total :</span> 
                        <span>{{ $reservation->terrain->price ?? 'N/A' }} DH</span>
                    </li>
                </ul>
                
                <p class="text-gray-800 mb-4">Vous pouvez consulter les détails de votre réservation en cliquant sur le bouton ci-dessous :</p>
                
                <div class="text-center my-6">
                    <a href="http://127.0.0.1:8000/home" 
                       class="bg-[#580a21] hover:bg-[#6e0b2a] text-white font-bold py-3 px-6 rounded inline-block transition duration-300">
                        Voir ma réservation
                    </a>
                </div>
                
                <p class="text-gray-800 mb-4">Si vous avez des questions ou si vous souhaitez modifier votre réservation, n'hésitez pas à nous contacter.</p>
                
                <p class="text-gray-800 mb-4">Nous vous remercions de votre confiance et sommes impatients de vous accueillir !</p>
                
                <p class="text-gray-800">
                    Cordialement,<br>
                    <span class="font-semibold">L'équipe Gestion Match</span>
                </p>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-100 text-center py-4 text-gray-500 text-sm">
                <p>© {{ date('Y') }} Gestion Match. Tous droits réservés.</p>
                <p class="mt-1">Cet email a été envoyé automatiquement. Merci de ne pas y répondre.</p>
            </div>
        </div>
    </div>
</body>
</html>