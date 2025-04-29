@extends('Layout.guest')
@section('title', 'Mes invitations')
@section('content')
<section class="w-[100%] min-h-[100vh] relative">
    <!-- Image de fond -->
    <div class="relative md:w-[100%] w-[100%] h-full">
        <img 
            src="../assets/img/stud-red.svg" 
            class="fixed w-[100%] h-[100vh] object-cover z-[-3] md:brightness-[50%]" 
            alt="" 
        />
    </div>
  
    <div class="min-h-[100vh] text-[white] relative z-10 pt-16">
        <header class="bg-[#580a21] py-20 text-center">
            <div class="text-xs uppercase tracking-wide mb-2">
                <a href="#" class="hover:text-red-500">Home</a> / 
                <span class="text-gray-400">invitation</span>
            </div>
            <h1 class="text-4xl font-bold uppercase"> invitation</h1>
        </header>
   
        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-6 lg:p-8 min-h-[60vh]">
            <div class="max-w-7xl mx-auto">
                
                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-md relative" role="alert">
                        <div class="flex items-center">
                            <div class="py-1">
                                <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" class="absolute top-[50%] translate-y-[-50%] right-0 mr-2 text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-md relative" role="alert">
                        <div class="flex items-center">
                            <div class="py-1">
                                <svg class="h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button type="button" class="absolute top-[50%] translate-y-[-50%] right-0 mr-2 text-red-700 hover:text-red-900" onclick="this.parentElement.style.display='none'">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @if($invitations)
                <!-- Tableau des invitations -->
                <div class="bg-[#685f5fe8] rounded-xl shadow-md overflow-hidden mb-8">
                    <table class="min-w-full divide-y divide-gray-600/30">
                        <thead class="bg-[#580a21]">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Squad
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Demande par
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Ville
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Formation
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#685f5fe8] text-white divide-y divide-gray-600/30">
                            @foreach ($invitations as $invitation)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white">{{ $invitation->squads[0]->name_squad }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img
                                            src="{{ isset($invitation->pivot->profile_picture) ? asset('storage/'. $invitation->pivot->profile_picture) : asset('storage/profile-pictures/blank-profile.webp') }}"
                                            alt="pivot image"
                                            class="w-8 h-8 rounded-full border-solid border-2 border-[#580a21] mr-3"
                                        />
                                        <div class="text-sm text-white">{{ $invitation->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm ">
                                    {{ $invitation->city }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#d8d9dd]">
                                    {{ $invitation->squads[0]->formation }}
                                </td>
                              <td class="py-4 whitespace-nowrap text-sm font-medium flex gap-8">
                                <form action="{{route('joueur.requests.update') }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="response" required onchange="this.form.submit()" class="bg-[#423939] text-white text-xs rounded-md border-none focus:outline-none focus:ring-1 focus:ring-[#580a21] py-1 px-2">
                                        <option value="accepté" {{ $invitation->pivot->acceptationUser === 'accepté' ? 'selected' : '' }}>Accepter</option>
                                        <option value="refusé" {{ $invitation->pivot->acceptationUser === 'refusé' ? 'selected' : '' }}>Refuser</option>
                                        <option value="en attente" {{ $invitation->pivot->acceptationUser === 'en attente' ? 'selected' : '' }} hidden>En attente</option>
                                    </select>
                                    <input type="text" name="userId" value="{{ $invitation->pivot->user_id }}" class="hidden">
                                    <input type="text" name="squadId" value="{{ $invitation->pivot->squad_id }}" class="hidden">
                                </form>
                                 <!-- Icône œil avec lien vers joueur.squad.show -->
                                    <a href="{{ route('joueur.squad.show', $invitation->squads[0]->id) }}"
                                    class="text-[#580a21] hover:text-[#6a0d25] text-lg"
                                    title="Voir l'équipe">
                                        <i class="fas fa-eye"></i> <!-- Font Awesome eye icon -->
                                    </a>
                            </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <!-- Message quand il n'y a pas de invitations -->
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 p-8 bg-[#685f5fe8] rounded-xl shadow text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-[#580a21]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-[#d8d9dd] text-xl font-bold mb-2">Aucune invitation</p>
                    <p class="text-[#d8d9dd] mb-4">Vous n'avez aucune invitation de squad en attente pour le moment.</p>
                    <a href="{{ route('joueur.squads') }}" class="inline-block bg-[#580a21] hover:bg-[#420718] text-white py-2 px-4 rounded-lg transition duration-300">
                        Découvrir des squads
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection