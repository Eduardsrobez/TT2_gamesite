<x-app-layout>
    <div class="py-8 mt-8">
        <div class="mx-auto" style="width: 70%;">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Edit Post</h1>

                <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" value="Game Name *" />
                        <x-text-input
                            id="name"
                            name="name"
                            type="text"
                            class="mt-1 block w-full"
                            value="{{ old('name', $game->name) }}"
                        />
                        @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="description" value="Description" />
                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        >{{ old('description', $game->description) }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="game_link" value="Link to Game *" />
                        <x-text-input
                            id="game_link"
                            name="game_link"
                            class="mt-1 block w-full"
                            value="{{ old('game_link', $game->game_link) }}"
                        />
                        @error('game_link')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="genres" value="Genres *" />
                        <select
                            id="genres"
                            name="genres[]"
                            multiple
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        >
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres', $game->genres->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Hold Ctrl/Cmd to select multiple genres</p>
                        @error('genres')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="cover_image" value="Cover Image" />
                        <input
                            type="file"
                            id="cover_image"
                            name="cover_image"
                            accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-indigo-50 dark:file:bg-indigo-900/50 file:text-indigo-700 dark:file:text-indigo-300
                            hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/40"
                        >
                        @if($game->cover_image)
                            <p class="text-sm mt-1 text-gray-500 dark:text-gray-400">Current image: {{ $game->cover_image }}</p>
                        @endif
                        @error('cover_image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button type="submit">
                            Update Post
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
