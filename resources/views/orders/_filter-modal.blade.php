<div id="filter-modal" class="fixed inset-0 z-50 hidden" aria-modal="true">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm"
         onclick="document.getElementById('filter-modal').classList.add('hidden')"></div>

    <!-- Modal -->
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl flex flex-col max-h-[90vh]">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Filter Orders</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Narrow down your orders</p>
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

                @if($search)
                    <input type="hidden" name="search" value="{{ $search }}">
                @endif

                <!-- Status -->
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Status</h3>
                    <div class="space-y-2">
                        @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                            <label class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all
                                          {{ in_array($status, $selectedStatuses ?? []) ? 'border-indigo-300 bg-indigo-50' : 'border-gray-100 hover:border-gray-200 hover:bg-gray-50' }}">
                                <input type="checkbox"
                                       name="statuses[]"
                                       value="{{ $status }}"
                                       {{ in_array($status, $selectedStatuses ?? []) ? 'checked' : '' }}
                                       class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                       onchange="this.closest('label').classList.toggle('border-indigo-300', this.checked);
                                                 this.closest('label').classList.toggle('bg-indigo-50', this.checked);
                                                 this.closest('label').classList.toggle('border-gray-100', !this.checked);">
                                <span class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                    <span class="w-2 h-2 rounded-full
                                        {{ $status === 'completed' ? 'bg-green-500' :
                                           ($status === 'pending' ? 'bg-yellow-500' :
                                           ($status === 'processing' ? 'bg-blue-500' : 'bg-gray-400')) }}">
                                    </span>
                                    {{ ucfirst($status) }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Date Range -->
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Date Range</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5">From</label>
                            <input type="date" name="date_from" value="{{ $dateFrom ?? '' }}"
                                   class="block w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1.5">To</label>
                            <input type="date" name="date_to" value="{{ $dateTo ?? '' }}"
                                   class="block w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                        </div>
                    </div>
                </div>
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
</div>

<script>
  function applyFilters() {

    const form = document.getElementById("filter-form");
    const searchInput = document.getElementById("order-search");
    const modal = document.getElementById("filter-modal");

    // Close the modal
    modal.classList.add("hidden");


    // Updating the URL with filter parameters
    const formData = new FormData(form);
    const url = new URL(window.location);

    // // Clearing old filter parameters
    ['statuses[]', 'date_from', 'date_to'].forEach(k => url.searchParams.delete(k));

    if (searchInput.value) {
        url.searchParams.set('search', searchInput.value);
    }

    formData.forEach((value, key) => {
        if (value) {
            url.searchParams.append(key, value);
        }
    });

    window.history.pushState({}, "", url);

    // Trigger HTML with form data + search
    // htmx.trigger(searchInput, 'search');
    htmx.ajax('GET', url.toString(), {
        target: '#orders-table',
        select: '#orders-table',
        swap: 'outerHTML'
    });

    updateFilterButton(url.searchParams.has('statuses[]') || url.searchParams.has('date_from') || url.searchParams.has('date_to'));
}

function resetFilters() {
    const form = document.getElementById("filter-form");
    const modal = document.getElementById("filter-modal");
    const searchInput = document.getElementById("order-search");

    // Resetting checkboxes and dates
    form.querySelectorAll('input[type="checkbox"]').forEach((cb) => {
        cb.checked = false;
        cb.closest("label").classList.remove(
            "border-indigo-300",
            "bg-indigo-50",
        );
        cb.closest("label").classList.add("border-gray-100");
    });
    form.querySelectorAll('input[type="date"]').forEach((d) => (d.value = ""));

    modal.classList.add("hidden");

    // Clearing URLs from Filters
    const url = new URL(window.location);
    url.searchParams.delete("statuses[]");
    url.searchParams.delete("date_from");
    url.searchParams.delete("date_to");
    window.history.pushState({}, "", url);

    // Updating the table
    htmx.ajax('GET', url.toString(), {
        target: '#orders-table',
        select: '#orders-table',
        swap: 'outerHTML'
    });

    updateFilterButton(false);

  }

  function updateFilterButton(isActive) {
    const filterBtn = document.getElementById('filter-btn');
    if (!filterBtn) return;
    const dot = filterBtn.querySelector('span');

    if (isActive) {
        filterBtn.classList.add('bg-indigo-600', 'border-indigo-600', 'text-white', 'shadow-md', 'shadow-indigo-200');
        filterBtn.classList.remove('border-gray-200', 'bg-gray-50', 'text-gray-500');
        if (!dot) {
            filterBtn.insertAdjacentHTML('beforeend',
                '<span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>'
            );
        }
    } else {
        filterBtn.classList.remove('bg-indigo-600', 'border-indigo-600', 'text-white', 'shadow-md', 'shadow-indigo-200');
        filterBtn.classList.add('border-gray-200', 'bg-gray-50', 'text-gray-500');
        if (dot) dot.remove();
    }
}

</script>