<x-layout>
    <div class="max-w-md mx-auto mt-6 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Add Review for {{ $book->title }}</h1>
        <form action="{{ route('books.reviews.store', $book) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="rating" class="block text-gray-700 font-semibold">Rating</label>
                {{-- <input type="number" name="rating" id="rating" min="1" max="5" class="border-gray-300 rounded-md w-full p-2" required> --}}
                <select name="rating" id="rating" class="border-gray-300 rounded-md w-full p-2">
                    <option value="">Select a rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                            {{ $i }} {{ Str::plural('Star', $i) }}
                        </option>

                    @endfor

                </select>
                <x-error class="italic" field="rating" />
            </div>
            <div class="mb-4">
                <label for="review" class="block text-gray-700 font-semibold">Review</label>
                <textarea name="review" id="review" rows="3" @class(['border-gray-300 rounded-md w-full p-2', 'border-red-700' => $errors->has('review')]) placeholder="15 chars at least..."  required>{{ old('review') }}</textarea>
                <x-error class="italic" field="review" />
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Submit Review</button>
                <a href="{{ route('books.show', ['book' => $book]) }}" class="inline-block bg-gray-200 hover:bg-gray-300 hover:cursor-pointer text-gray-700 font-semibold py-2 px-4 rounded-md">Cancel</a>
            </div>
        </form>
    </div>
</x-layout>
