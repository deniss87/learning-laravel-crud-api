@props(['active' => false])

<button {{ $attributes->merge(['type' => 'button']) }}
        onclick="document.getElementById('filter-modal').classList.remove('hidden')"
        class="relative flex-shrink-0 flex items-center justify-center w-11 h-11 border rounded-xl transition-all
               {{ $active ? 'bg-indigo-600 border-indigo-600 text-white shadow-md shadow-indigo-200' : 'border-gray-200 bg-gray-50 text-gray-500 hover:bg-white hover:border-indigo-400 hover:text-indigo-600' }}">
    <svg class="w-5 h-5" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M2 4.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m2 3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m2 3a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
    </svg>
    @if($active)
        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
    @endif
</button>