<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Game Header -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden mb-8 mt-8 flex flex-col md:flex-row">
                <!-- Image -->
                <div class="w-full md:w-1/3 bg-gray-200 dark:bg-gray-700 flex-shrink-0 relative">
                    @if($game->cover_image)
                        <img src="{{ asset('storage/' . $game->cover_image) }}" alt="{{ $game->name }}" class="w-full h-full object-contain p-4">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                            <svg class="w-1/3 h-1/3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Game Content -->
                <div class="w-full md:w-2/3 p-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $game->name }}</h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">
                            Created by {{ $game->user?->name ?? 'Deleted User' }}
                        </p>
                    </div>

                    <!-- Genres -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach($game->genres as $genre)
                            <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded">{{ $genre->name }}</span>
                        @endforeach
                    </div>

                    <!-- Play Button -->
                    <div class="mt-6 mb-8">
                        <a href="{{ $game->game_link }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 border border-gray-300 rounded-md text-white font-semibold transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Play Game
                        </a>
                    </div>

                    <!-- Ratings -->
                    <div class="mt-8">
                        <x-rating-display :game="$game"/>
                    </div>

                    <!-- Edit/Delete Buttons -->
                    @if(auth()->id() === $game->user_id || auth()->user()->isAdmin())
                        <div class="mt-6 flex items-center gap-3">
                            <a href="{{ route('games.edit', $game) }}">
                                <x-secondary-button>Edit</x-secondary-button>
                            </a>
                            <form action="{{ route('games.destroy', $game) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this game?');">
                                @csrf
                                @method('DELETE')
                                <x-danger-button type="submit">Delete</x-danger-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Game Description -->
            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Description</h2>
                    <div class="text-gray-900 dark:text-white mb-4 break-words">
                        {!! nl2br(e($game->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Game Details -->
            <div class="space-y-6 mt-8">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Details</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Developer</p>
                            <p class="text-gray-900 dark:text-white">{{ $game->user?->name ?? 'Deleted User' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Posted On</p>
                            <p class="text-gray-900 dark:text-white">{{ $game->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 10000)" x-show="show" class="fixed left-4 bottom-4 z-50">
                    <div class="bg-green-600 dark:bg-green-700 text-white px-4 py-3 rounded-md shadow-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Tabbed Comments and Tester Reviews Section -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <div x-data="{ tab: 'comments' }">

                    <!-- Tabs -->
                    <div class="flex border-b border-gray-300 dark:border-gray-700 mb-6">
                        <button @click="tab = 'comments'"
                                class="px-4 py-2 font-semibold focus:outline-none"
                                :class="tab === 'comments' ? 'border-b-4 border-blue-600 text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400'">
                            User Comments
                        </button>

                        <button @click="tab = 'tester_reviews'"
                                class="ml-6 px-4 py-2 font-semibold focus:outline-none"
                                :class="tab === 'tester_reviews' ? 'border-b-4 border-blue-600 text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400'">
                            Tester Reviews
                        </button>
                    </div>

                    <!-- Comments Content -->
                    <div x-show="tab === 'comments'">
                        <x-comments :game="$game" />
                    </div>

                    <!-- Tester Reviews Content -->
                    <div x-show="tab === 'tester_reviews'">
                        <x-tester-reviews :game="$game" />
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
