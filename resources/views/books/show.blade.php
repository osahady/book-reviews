{{-- <x-layout>
    <div class="p-4">
        <x-book-card link="" :book="$book">
        </x-book-card>
    </div>
</x-layout> --}}

<x-layout>


  <div class="mb-4">
    <h1 class="mb-2 text-2xl">{{ $book->title }}</h1>

    <div class="book-info">
      <div class="book-author mb-4 text-lg font-semibold">by {{ $book->author }}</div>
      <div class="book-rating flex items-center">
        <div class="mr-2 text-sm font-medium text-slate-700">
          {{ number_format($book->reviews_avg_rating, 1) }}
          <x-star-rating :rating="$book->reviews_avg_rating" />
        </div>
        <span class="book-review-count text-sm text-gray-500">
          {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
        </span>
      </div>
    </div>
  </div>

  <div>
    <h2 class="mb-4 text-xl font-semibold">Reviews</h2>
    <ul>
      @forelse ($book->reviews as $review)
        <li class="book-item mb-4">
            <div class="mb-2 flex items-center justify-between">
                <div class="p-4">
                    <div class="font-semibold">{{ $review->rating }} {{ Str::plural('Star', $review->rating)  }}</div>
                    <x-star-rating :rating="$book->reviews_avg_rating" />
                </div>
              <div class="book-review-count">{{ $review->created_at->format('j-m-Y') }}</div>
            </div>
            <p class="text-gray-700">{{ $review->review }}</p>
        </li>
      @empty
        <li class="mb-4">
          <div class="empty-book-item">
            <p class="empty-text text-lg font-semibold">No reviews yet</p>
          </div>
        </li>
      @endforelse
    </ul>
  </div>
</x-layout>
