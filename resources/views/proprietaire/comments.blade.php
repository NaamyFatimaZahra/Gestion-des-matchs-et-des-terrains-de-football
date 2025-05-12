@extends('Layout.dashboard')
@section('title', 'Commentaires des Terrains')
@section('content')

<div class="container mx-auto px-2 py-4 mt-[4rem] text-gray-800 bg-rose-50">
    <!-- En-tête avec navigation et titre -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="bg-[#580a21] hover:bg-[#420718] text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors duration-200 shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Commentaires des Terrains</h1>
        </div>
    </div>

    <!-- Alerte de succès avec animation -->
    @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 sm:px-4 sm:py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }
        }, 2000);
    </script>
    @endif

    <!-- Message d'erreur général -->
    @if(session('error'))
    <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 sm:px-4 sm:py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
        <button type="button" class="absolute top-0 right-0 px-3 py-2 sm:px-4 sm:py-3" onclick="this.parentElement.remove()">
            <span class="sr-only">Fermer</span>
            <i class="fas fa-times text-sm sm:text-base"></i>
        </button>
    </div>
    @endif

    <!-- Mobile view (visible only on small screens) -->
    <div class="block md:hidden" id="mobile-comments-container">
        <div class="space-y-4">
            @forelse($comments ?? [] as $comment)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-3 sm:p-4">
                <div class="flex justify-between items-start mb-2">
                    <div class="w-4/5">
                        <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">{{ $comment->terrain->name ?? 'N/A' }}</h3>
                        <div class="flex items-center mt-1">
                            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center mr-2 flex-shrink-0">
                                @if($comment->user && $comment->user->profile_photo)
                                <img src="{{ asset('storage/' . $comment->user->profile_photo) }}" alt="Photo de profil" class="w-6 h-6 rounded-full object-cover">
                                @else
                                <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                @endif
                            </div>
                            <span class="text-xs sm:text-sm text-gray-600 truncate">{{ $comment->user->name ?? 'Utilisateur anonyme' }}</span>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">{{ $comment->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="flex">
                        <form action="{{ route('proprietaire.comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="mt-2 pt-2 border-t border-gray-100">
                    <div class="flex mb-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 {{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            @endfor
                    </div>
                    <p class="text-xs sm:text-sm text-gray-700 break-words">{{ $comment->content }}</p>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 text-center text-gray-500">
                <div class="flex flex-col items-center py-4">
                    <svg class="w-8 h-8 sm:w-12 sm:h-12 mb-2 sm:mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <p class="text-sm sm:text-base">Aucun commentaire trouvé.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Desktop view (visible only on large screens) -->
    <div class="hidden md:block bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#580a21]">
                    <tr>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Terrain</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Créateur</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Commentaire</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Note</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-4 sm:px-6 py-2 sm:py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($comments ?? [] as $comment)
                    <tr class="hover:bg-rose-50 transition-colors duration-200">
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            {{ $comment->id }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            <a href="{{ route('proprietaire.terrain.show',$comment->terrain->id ) }}" class="text-[#580a21] hover:text-[#420718] hover:underline transition-colors">
                                {{ $comment->terrain->name ?? 'N/A' }}
                            </a>
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            <div class="flex items-center">
                                <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-rose-50 flex items-center justify-center mr-2 flex-shrink-0">
                                    @if($comment->user && $comment->user->profile_photo)
                                    <img src="{{ asset('storage/' . $comment->user->profile_photo) }}" alt="Photo de profil" class="w-6 h-6 sm:w-8 sm:h-8 rounded-full object-cover">
                                    @else
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    @endif
                                </div>
                                <span class="text-xs sm:text-sm text-gray-800 truncate max-w-[120px] lg:max-w-full">
                                    {{ $comment->user->name ?? 'Utilisateur anonyme' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-800">
                            <div class="max-w-[120px] sm:max-w-[200px] lg:max-w-md truncate">
                                {{ $comment->content }}
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 {{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    @endfor
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-800">
                            {{ $comment->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-right text-xs sm:text-sm font-medium">
                            <div class="flex justify-end">
                                <form action="{{ route('proprietaire.comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-700">
                                        <i class="fas fa-trash text-base sm:text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 sm:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm text-gray-500">
                            <div class="flex flex-col items-center py-4 sm:py-6">
                                <svg class="w-8 h-8 sm:w-12 sm:h-12 mb-2 sm:mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                                <p>Aucun commentaire trouvé</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination (if necessary) -->
    @if(isset($comments) && $comments instanceof \Illuminate\Pagination\LengthAwarePaginator && $comments->hasPages())
    <div class="mt-4 sm:mt-6 px-2" id="pagination-container">
        <nav class="flex items-center justify-between bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-2 sm:p-4">
            <div class="flex-1 flex justify-between">
                <!-- Mobile pagination -->
                <div class="flex items-center sm:hidden justify-between w-full">
                    @if($comments->onFirstPage())
                    <span class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                        Préc.
                    </span>
                    @else
                    <a href="{{ $comments->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
                        Préc.
                    </a>
                    @endif

                    <span class="text-xs text-gray-700 mx-2">
                        Page {{ $comments->currentPage() }}/{{ $comments->lastPage() }}
                    </span>

                    @if($comments->hasMorePages())
                    <a href="{{ $comments->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-[#580a21] bg-white border border-gray-300 rounded-md hover:bg-rose-50">
                        Suiv.
                    </a>
                    @else
                    <span class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                        Suiv.
                    </span>
                    @endif
                </div>

                <!-- Desktop pagination -->
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs sm:text-sm text-gray-700">
                            Affichage de <span class="font-medium">{{ $comments->firstItem() }}</span> à <span class="font-medium">{{ $comments->lastItem() }}</span> sur <span class="font-medium">{{ $comments->total() }}</span> commentaires
                        </p>
                    </div>

                    <div>
                        <span class="relative z-0 inline-flex shadow-sm rounded-md">
                            {{-- Previous page link --}}
                            @if($comments->onFirstPage())
                            <span class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md">
                                <span class="sr-only">Précédent</span>
                                <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            @else
                            <a href="{{ $comments->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-l-md hover:bg-rose-50">
                                <span class="sr-only">Précédent</span>
                                <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            @endif

                            {{-- Pagination links - Limited to 5 on smaller screens --}}
                            @php
                            $window = 2; // Links shown on each side of current page
                            $currentPage = $comments->currentPage();
                            $lastPage = $comments->lastPage();
                            $startPage = max(1, $currentPage - $window);
                            $endPage = min($lastPage, $currentPage + $window);

                            // Always show first and last page
                            $showFirstDots = $startPage > 1;
                            $showLastDots = $endPage < $lastPage;
                                @endphp

                                @if($showFirstDots)
                                <a href="{{ $comments->url(1) }}" class="hidden sm:inline-flex relative items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-rose-50 hover:text-[#580a21]">
                                1
                                </a>
                                @if($startPage > 2)
                                <span class="hidden sm:inline-flex relative items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300">
                                    ...
                                </span>
                                @endif
                                @endif

                                @foreach(range($startPage, $endPage) as $page)
                                @if($page == $currentPage)
                                <span class="relative inline-flex items-center px-3 sm:px-4 py-1 sm:py-2 text-xs sm:text-sm font-medium text-white bg-[#580a21] border border-[#580a21]">
                                    {{ $page }}
                                </span>
                                @else
                                <a href="{{ $comments->url($page) }}" class="relative inline-flex items-center px-3 sm:px-4 py-1 sm:py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-rose-50 hover:text-[#580a21]">
                                    {{ $page }}
                                </a>
                                @endif
                                @endforeach

                                @if($showLastDots)
                                @if($endPage < $lastPage - 1)
                                    <span class="hidden sm:inline-flex relative items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300">
                                    ...
                        </span>
                        @endif
                        <a href="{{ $comments->url($lastPage) }}" class="hidden sm:inline-flex relative items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-rose-50 hover:text-[#580a21]">
                            {{ $lastPage }}
                        </a>
                        @endif

                        {{-- Next page link --}}
                        @if($comments->hasMorePages())
                        <a href="{{ $comments->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-[#580a21] bg-white border border-gray-300 rounded-r-md hover:bg-rose-50">
                            <span class="sr-only">Suivant</span>
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @else
                        <span class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-r-md">
                            <span class="sr-only">Suivant</span>
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        @endif
                        </span>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    @endif
</div>

@endsection