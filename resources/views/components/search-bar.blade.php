<form method="GET" action="{{ route('gamelist.show') }}" class="w-full">
    <!-- Added w-full -->
    <div class="relative w-full">
        <!-- Added w-full -->
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search games..."
            class="w-full px-4 py-2 rounded bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        @if(request('search'))
        <a href="{{ route('gamelist.show', request()->except('search')) }}" 
            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
        </a>
        @endif
        <!-- Preserve other query parameters -->
        @foreach(request()->except('search') as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </div>
</form>