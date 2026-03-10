<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('orders.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 flex items-center transition">
                    <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Orders
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 p-8 md:p-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Create New Order</h2>
                
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="customer_id" value="Select Customer" class="text-gray-700 font-bold" />
                            <select id="customer_select" name="customer_id" required placeholder="tart typing a customer name or email..." autocomplete="off"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150">
                                <option value="" disabled selected>— Choose a client —</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->last_name }} {{ $customer->first_name }} ({{ $customer->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="order_number" value="Order Number" class="text-gray-700 font-bold" />
                            <x-text-input id="order_number" name="order_number" type="text" class="block mt-1 w-full" 
                                :value="old('order_number', 'ORD-' . strtoupper(Str::random(6)))" required />
                            <x-input-error :messages="$errors->get('order_number')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="total_amount" value="Total Amount (€)" class="text-gray-700 font-bold" />
                                <x-text-input id="total_amount" name="total_amount" type="number" step="0.01" class="block mt-1 w-full" 
                                    :value="old('total_amount')" placeholder="0.00" required />
                                <x-input-error :messages="$errors->get('total_amount')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="status" value="Initial Status" class="text-gray-700 font-bold" />
                                <select id="status" name="status" required
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 pt-8 border-t border-gray-100 flex items-center justify-end space-x-4">
                        <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 px-10 py-4 text-base rounded-xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                            {{ __('Create Order') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    new TomSelect("#customer_select",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>