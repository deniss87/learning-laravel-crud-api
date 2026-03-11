<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 flex items-center p-4 text-sm text-green-800 border border-green-200 rounded-2xl bg-green-50 shadow-sm" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Success</span>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900">Manage Orders</h3>
                    </div>
                    
                    <!-- Search -->
                    <div class="w-full lg:max-w-md flex gap-2">
                        <form action="{{ route('orders.index') }}" method="GET" class="relative group flex-1">
                            <input type="hidden" name="sort" value="{{ $sort }}">
                            <input type="hidden" name="direction" value="{{ $direction }}">

                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text"
                                  id="order-search"
                                  name="search"
                                  value="{{ $search ?? '' }}"
                                  placeholder="Search by order number or customer name..."

                                  hx-get="{{ route('orders.index') }}"
                                  hx-trigger="keyup changed delay:500ms, search"
                                  hx-target="#orders-table"
                                  hx-select="#orders-table"
                                  hx-include="[name='sort'], [name='direction']"
                                  hx-push-url="true"

                                  class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all sm:text-sm"
                            >

                            <button type="button"
                                    id="clear-button"
                                    class="absolute inset-y-0 right-0 pr-3 items-center text-gray-400 hover:text-gray-600 transition-all hidden">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </form>

                    <!-- Filter Button -->
                    <x-filter-button 
                          id="filter-btn" 
                          :active="!empty($selectedStatuses) || $dateFrom || $dateTo" 
                    />
                    </div>

                    <!-- Filter Modal -->
                    @include('orders._filter-modal')

                    <a href="{{ route('orders.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-md hover:bg-indigo-700 active:scale-95 transition-all">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        New Order
                    </a>
                </div>

                @include('orders._table')

            </div>
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/searchInput.js')
         @vite('resources/js/orderFilters.js')
    @endpush
</x-app-layout>