<div class="bg-gray-800 rounded-lg shadow-md p-4 mb-6">
    <h3 class="text-lg font-semibold mb-3 text-white">Filter by Genre</h3>
    <ul class="space-y-2">
        <li>
            <a href="{{ route('gamelist.show') }}"
                class="block px-3 py-2 rounded {{ !request('genre') ? 'bg-blue-600 text-white' : 'text-blue-400 hover:bg-gray-700' }}">
                All
            </a>
        </li>
        @foreach ($genres as $genre)
        <li>
            <a href="{{ route('gamelist.show', ['genre' => $genre->id]) }}"
                class="block px-3 py-2 rounded {{ request('genre') == $genre->id ? 'bg-blue-600 text-white' : 'text-blue-400 hover:bg-gray-700' }}">
                {{ $genre->name }} ({{ $genre->games_count }})
            </a>
        </li>
        @endforeach
    </ul>
</div>