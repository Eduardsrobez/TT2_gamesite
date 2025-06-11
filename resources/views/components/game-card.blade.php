<div class="bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex flex-col h-full">
    <!-- Image placeholder with fixed height -->
    @if($game->cover_image)
    <div class="h-40 overflow-hidden">
        <img src="{{ asset('storage/' . $game->cover_image) }}" alt="{{ $game->name }}"
            class="w-full h-full object-cover">
    </div>
    @else
    <div class="h-40 bg-gray-700 flex items-center justify-center">
        <span class="text-gray-400">No image</span>
    </div>
    @endif

    <!-- Content area -->
    <div class="p-4 flex-1 flex flex-col">
        <!-- Game title - properly sized -->
        <h3 class="text-xl font-bold text-white mb-2">{{ $game->name }}</h3>

        <!-- Genres - more compact -->
        @if($game->genres->isNotEmpty())
        <div class="mb-3 flex flex-wrap gap-1">
            @foreach($game->genres->take(3) as $genre)
            <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded">
                {{ $genre->name }}
            </span>
            @endforeach
        </div>
        @endif

        <!-- Description - better readability -->
        <p class="text-gray-300 text-base mb-4 break-words">
            {{ Str::limit($game->description ?? 'Description coming soon', 120, '...') }}
        </p>

        <!-- Action buttons -->
        <div class="mt-auto flex justify-between items-center">
            <span class="text-yellow-400 text-sm">★★★★☆</span>
            <a href="{{ route('games.details', $game->id) }}"
               class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">
                Details
            </a>
        </div>
    </div>
</div>
