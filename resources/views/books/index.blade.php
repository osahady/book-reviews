<x-layout>
    <h1 class="text-lg">Index of Books</h1>
    <form method="GET" action="{{ route('books.index') }}" class="flex items-center mb-8 justify-between">
        <input type="text" name="title" value="{{ request('title') }}" class="border h-10 outline-none ring-1 ring-slate-500/50 focus:shadow-lg border-gray-300 w-full max-w-xl rounded-md p-2" placeholder="Search by title...">
        <input type="hidden" name="filter" value="{{ request('filter') }}">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 h-10 rounded-md hover:bg-slate-600 transition duration-150 ease-in-out">Search</button>
        <a href="{{ route('books.index') }}" class="bg-slate-200 text-slate-700 ring-1 ring-slate-700/10 h-10 px-4 py-2 rounded-md hover:bg-orange-300 transition duration-150 ease-in-out">Reset</a>
    </form>

    @php
        $filters = [
            '' => 'Latest',
            'popular_last_month' => 'Popular Last Month',
            'popular_last_6_months' => 'Popular Last 6 Months',
            'highest_rated_last_month' => 'Highest Rated Last Month',
            'highest_rated_last_6_months' => 'Highest Rated Last 6 Months',
        ];
        $currentFilter = request()->get('filter', '');
    @endphp

    {{-- tabs --}}
    <div class="flex flex-wrap justify-between items-center">

        @foreach ($filters as $key => $label)
        <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}" class="bg-gray-200 mb-8 text-slate-900 px-2 py-2 h-10 text-sm rounded-md hover:bg-slate-300 transition duration-150 ease-in-out {{ request('filter') === $key || ($key === '' && request('filter') === null ) ? 'font-bold bg-blue-100 text-blue-500' : '' }}">{{ $label }}</a>

        @endforeach
    </div>


  {{-- listing books --}}
  @forelse ($books as $book)
    <x-book-card link="{{ route('books.show', $book) }}" :book="$book" />
  @empty
    <x-reset-card link="{{ route('books.index') }}" />
  @endforelse

    {{-- pagination --}}
    <div class="mt-8">
        {{ $books->links() }}
    </div>

</x-layout>
