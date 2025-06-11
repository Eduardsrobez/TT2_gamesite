<x-app-layout>
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 10000)"
            x-show="show"
            class="fixed left-4 bottom-4 z-50"
        >
            <div class="bg-green-600 dark:bg-green-700 text-white px-4 py-3 rounded-md shadow-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 md:flex">
        <!-- Sidebar -->
        <aside class="w-full md:w-1/4 mb-6 md:mb-0 md:mr-6">
            <x-genre-list :genres="$genres" />
            <x-contact-box />
        </aside>

        <!-- Main Content -->
        <section class="flex-1">
            <!-- Search and Sort -->
            <form method="GET" action="{{ route('gamelist.show') }}">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <x-search-bar />
                    <x-sort-games />
                </div>
                @if(request('genre'))
                <input type="hidden" name="genre" value="{{ request('genre') }}">
                @endif     
            </form>

            <!-- Game Cards -->
            <div class="grid gap-6">
                @foreach($games as $game)
                    <x-game-card :game="$game" />
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
