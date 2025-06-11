@php
$fullStars = floor($averageRating);
$hasHalfStar = ($averageRating - $fullStars) >= 0.5;
$emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
@endphp

<div class="flex items-center">
    <!-- Stars -->
    <div class="flex mr-2">
        @for ($i = 0; $i < $fullStars; $i++) <svg class="w-5 h-5 text-yellow-400" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            @endfor

            @if ($hasHalfStar)
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <defs>
                    <linearGradient id="half-star" x1="0" x2="100%" y1="0" y2="0">
                        <stop offset="50%" stop-color="currentColor" />
                        <stop offset="50%" stop-color="#D1D5DB" />
                    </linearGradient>
                </defs>
                <path fill="url(#half-star)"
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            @endif

            @for ($i = 0; $i < $emptyStars; $i++) <svg class="w-5 h-5 text-gray-300" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                @endfor
    </div>

    <!-- Rating text -->
    <span class="text-sm text-gray-300">
        @if($ratingCount > 0)
        {{ number_format($averageRating, 1) }} ({{ $ratingCount }} {{ Str::plural('review', $ratingCount) }})
        @else
        No reviews yet
        @endif
    </span>
</div>