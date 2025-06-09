<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <x-search-bar />
                <x-sort-games />
            </div>
    
            <!-- Game Cards -->
            <div class="grid gap-6">
                @foreach($games as $game)
                <x-game-card :game="$game" />
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
