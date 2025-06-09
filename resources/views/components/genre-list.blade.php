<div class="bg-gray-800 rounded-lg shadow-md p-4 mb-6">
    <h3 class="text-lg font-semibold mb-3">Genres</h3>
    <ul class="space-y-2">
        <li>
            <a href="{{ route('gamelist.show') }}"
                class="text-blue-400 hover:underline {{ !request('genre') ? 'font-bold' : '' }}">
                All Genres
            </a>
        </li>
        @foreach ($genres as $genre)
        <li>
            <a href="{{ route('gamelist.show', ['genre' => $genre->id]) }}"
                class="text-blue-400 hover:underline {{ request('genre') == $genre->id ? 'font-bold' : '' }}">
                {{ $genre->name }}
            </a>
        </li>
        @endforeach
    </ul>
</div>