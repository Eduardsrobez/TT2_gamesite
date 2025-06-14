<div class="mt-8 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Tester Reviews</h2>

    <!-- Tester Review Form -->
    @auth
        @if(auth()->user()->isTester() || auth()->user()->isAdmin())
            <form action="{{ route('tester-reviews.store', $game) }}" method="POST" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="review" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Your Review
                    </label>
                    <textarea name="review" id="review" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                              required></textarea>
                </div>

                <div class="mb-4">
                    <label for="bugs_found" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Bugs Found
                    </label>
                    <textarea name="bugs_found" id="bugs_found" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                    Submit Review
                </button>
            </form>
        @else
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Only testers can submit reviews.
            </p>
        @endif
    @else
        <p class="text-gray-600 dark:text-gray-400 mb-6">
            <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Log in</a> to leave a tester review.
        </p>
    @endauth

    <!-- Reviews List -->
    <div class="space-y-4">
        @forelse($game->testerReviews as $review)
            <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-white">
                            {{ $review->user?->name ?? 'Deleted User'}}
                        </h4>
                    </div>
                    <span class="text-sm text-gray-500">
                        {{ $review->created_at }}
                    </span>
                </div>

                <p class="mt-2 text-gray-700 dark:text-gray-300 break-words whitespace-pre-wrap">
                    {{ $review->review }}
                </p>

                <div class="mt-2">
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-semibold">Bugs Found:</p>
                    <p class="text-gray-700 dark:text-gray-300 break-words whitespace-pre-wrap">{{ $review->bugs_found ?? 'None'}}</p>
                </div>

                @if(Auth::check() && (Auth::id() === $review->user_id || Auth::user()->isAdmin()))
                    <form action="{{ route('tester-reviews.destroy', $review) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Delete</x-danger-button>
                    </form>
                @endif
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-400">No tester reviews yet.</p>
        @endforelse
    </div>
</div>
