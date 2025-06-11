<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Game Header - Standardized Image Size -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden mb-8 mt-8 flex flex-col md:flex-row">
                <!-- Image Container - Fixed 1/3 Width -->
                <div class="w-full md:w-1/3 bg-gray-200 dark:bg-gray-700 flex-shrink-0 relative">
                    @if($game->cover_image)
                        <img src="{{ asset('storage/' . $game->cover_image) }}"
                             alt="{{ $game->name }}"
                             class="w-full h-full object-contain p-4">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                            <svg class="w-1/3 h-1/3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Content Section - Takes remaining 2/3 -->
                <div class="w-full md:w-2/3 p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $game->name }}</h1>
                            <p class="text-gray-600 dark:text-gray-300 mt-2">
                                Created by {{ $game->user->name }}
                            </p>
                        </div>
                        @if(auth()->id() === $game->user_id || auth()->user()->isAdmin())
                            <x-secondary-button>Edit</x-secondary-button>
                        @endif
                    </div>

                    <!-- Genres -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach($game->genres as $genre)
                            <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                {{ $genre->name }}
                            </span>
                        @endforeach
                    </div>

                    <!-- Play Button -->
                    <div class="mt-6">
                        <a href="{{ $game->game_link }}" target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 border border-gray-300 rounded-md text-white font-semibold transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Play Game
                        </a>
                    </div>
                </div>
            </div>

            <!-- Game Details Sections -->
            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Description</h2>
                    <div class="text-gray-900 dark:text-white mb-4 break-words">
                        {!! nl2br(e($game->description)) !!}
                    </div>
                </div>

                <!-- Media Placeholder -->
            </div>

            <div class="space-y-6 mt-8">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Details</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Developer</p>
                            <p class="text-gray-900 dark:text-white">{{ $game->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Posted On</p>
                            <p class="text-gray-900 dark:text-white">{{ $game->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
</x-app-layout>
