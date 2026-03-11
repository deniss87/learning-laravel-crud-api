<div class="mt-8 flex justify-center items-center gap-4">
    @if ($items->onFirstPage())
        <span class="p-2 text-gray-200 cursor-not-allowed">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </span>
    @else
        <a href="{{ $items->previousPageUrl() }}" class="p-2 text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
    @endif

    <div class="text-sm font-medium text-gray-500 px-4 py-2">
        Page <span class="text-gray-500">{{ $items->currentPage() }}</span> of <span class="text-gray-500">{{ $items->lastPage() }}</span>
    </div>

    @if ($items->hasMorePages())
        <a href="{{ $items->nextPageUrl() }}" class="p-2 text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    @else
        <span class="p-2 text-gray-200 cursor-not-allowed">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </span>
    @endif
</div>