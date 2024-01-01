@if ($rating)
<div class="flex">

    @for ($i=1; $i <= 5; $i++)

    <svg class="w-4 h-4 fill-current {{ $i <= $rating ? 'text-yellow-500' : 'text-gray-400' }}" viewBox="0 0 20 20">
        <path d="M10 12.585L3.175 16.75 5 10.5 0 6.415l6.588-.908L10 0l3.412 5.507L20 6.415 15 10.5l1.825 6.25z" />
    </svg>

    @endfor
</div>
@else
  <p class="empty-text text-lg font-semibold">No ratings yet</p>
@endif
