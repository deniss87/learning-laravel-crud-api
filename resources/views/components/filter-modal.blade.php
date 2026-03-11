@props(['title' => 'Filters', 'subtitle' => 'Narrow down your results'])

<!-- Backdrop + Panel -->
<div id="filter-modal" class="fixed inset-0 z-50 hidden" aria-modal="true">
    <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm"
         onclick="document.getElementById('filter-modal').classList.add('hidden')"></div>

    <div class="absolute right-0 top-0 h-full w-full max-w-sm bg-white shadow-2xl flex flex-col">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <div>
                <h2 class="text-lg font-bold text-gray-900">{{ $title }}</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ $subtitle }}</p>
            </div>
            <button onclick="document.getElementById('filter-modal').classList.add('hidden')"
                    class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Body -->
        <form id="filter-form" class="flex-1 overflow-y-auto px-6 py-6 space-y-8">
            {{ $fields }}
        </form>

        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-100 flex gap-3">
            <button type="button"
                    onclick="resetFilters()"
                    class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50 transition-all">
                Reset
            </button>
            <button type="button"
                    onclick="applyFilters()"
                    class="flex-1 px-4 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all">
                Apply Filters
            </button>
        </div>
    </div>
</div>