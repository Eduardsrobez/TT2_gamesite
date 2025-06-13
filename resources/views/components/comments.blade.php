<div class="mt-8 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Comments</h2>

    <!-- Comment Form -->
    @auth
    <form action="{{ route('comments.store', $game) }}" method="POST" class="mb-6">
        @csrf
        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Your Comment
            </label>
            <textarea name="comment" id="comment" rows="3"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                required></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Your Rating
            </label>
            <div class="flex items-center space-x-2">
                @for($i = 1; $i <= 5; $i++) <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600" {{ $i==3
                    ? 'checked' : '' }}>
                    <label for="rating-{{ $i }}" class="text-gray-700 dark:text-gray-300">
                        {{ $i }} ★
                    </label>
                    @endfor
            </div>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
            Submit Comment
        </button>
    </form>
    @else
    <p class="text-gray-600 dark:text-gray-400 mb-6">
        <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Log in</a> to leave a comment.
    </p>
    @endauth

    <!-- Comments List -->
    <div class="space-y-4">
        @forelse($comments as $comment)
        <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-medium text-gray-900 dark:text-white">
                        {{ $comment->user->name ?? 'Deleted User'}}
                    </h4>
                    <div class="flex items-center mt-1">
                        @for($i = 1; $i <= 5; $i++) @if($i <=$comment->rating)
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @else
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endif
                            @endfor
                    </div>
                </div>
                <span class="text-sm text-gray-500">
                    {{ $comment->created_at }}
                </span>
            </div>

            <p class="mt-2 text-gray-700 dark:text-gray-300">
                {{ $comment->comment }}
            </p>

            @if(Auth::check() && (Auth::id() === $comment->user_id || Auth::user()->isAdmin()))
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <x-danger-button>Delete</x-danger-button>
            </form>
            @endif
        </div>
        @empty
        <p class="text-gray-600 dark:text-gray-400">No comments yet.</p>
        @endforelse
    </div>
</div>
