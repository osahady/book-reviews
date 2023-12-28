@props(['link'])

<div class="bg-white rounded-lg overflow-hidden shadow-lg flex items-center justify-center h-full">
    <div class="p-6 text-center">
        <h2 class="text-xl font-semibold mb-2">No Books</h2>
        <p class="text-gray-600 mb-4">There are no books yet.</p>
        <a href="{{ $link }}" class="text-slate-700 font-semibold cursor underline inline-block">
            Go to Index
        </a>
    </div>
</div>
