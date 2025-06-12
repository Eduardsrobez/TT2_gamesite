<div class="bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex h-48 overflow-hidden">
    <!-- Image -->
    <div class="w-1/3 min-w-[120px] bg-gray-700 flex-shrink-0">
        @if($game->cover_image)
        <img src="{{ asset('storage/' . $game->cover_image) }}" alt="{{ $game->name }}"
            class="w-full h-full object-cover">
        @else
        <div class="w-full h-full flex items-center justify-center text-gray-400">
            No image
        </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-4 flex-1 flex flex-col overflow-hidden">

        <!-- Game title -->
        <div class="mt-auto flex justify-between items-center">
            <h3 class="text-xl font-bold text-white mb-2 truncate">{{ $game->name }}</h3>

            @if(!$game->admin_approved)
            <form action="{{ route('games.approve', $game) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                    Approve
                </button>
            </form>
            @endif
        </div>

        <!-- Genres -->
        @if($game->genres->isNotEmpty())
        <div class="mb-2 flex flex-wrap gap-1">
            @foreach($game->genres->take(3) as $genre)
            <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded">
                {{ $genre->name }}
            </span>
            @endforeach
        </div>
        @endif

        <!-- Description -->
        <p class="text-gray-300 text-base break-words line-clamp-2">
            {{ Str::limit($game->description ?? 'Description coming soon', 120, '...') }}
        </p>

        <!-- Action buttons -->
        <div class="mt-auto flex justify-between items-center">
            <x-rating-display :game="$game" />
            <a href="{{ route('games.details', $game->id) }}"
                class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">
                Details
            </a>
        </div>


        <p class="text-gray-300 text-base text-sm" style="opacity: 0.3"> {{ $game->submitted_on }} </p>
    </div>
</div>

