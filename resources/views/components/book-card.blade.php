@props(['book', 'link'])

<div class="flex justify-between bg-white rounded-lg overflow-hidden mb-6 shadow-lg">
    <div class="p-6">
        <a href="{{ $link }}" class="text-xl font-semibold mb-2">{{ $book->title }}</a>
        <p class="text-gray-600">{{ $book->author }}</p>
    </div>
    <div class="p-6">
        <h1 class="text-xl font-semibold mb-2">{{ number_format( $book->reviews_avg_rating, 1) }}</h1>
        <p class="text-sm text-gray-600">Out of  {{$book->reviews_count}} {{Str::plural('review', $book->reviews_count) }} </p>
    </div>


</div>
