<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 p-8">
                
                <form action="{{ route('customers.update', $customer) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="first_name" value="First Name" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ old('first_name', $customer->first_name) }}" required />
                        </div>

                        <div>
                            <x-input-label for="last_name" value="Last Name" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ old('last_name', $customer->last_name) }}" required />
                        </div>

                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $customer->email) }}" required />
                        </div>

                        <div>
                            <x-input-label for="phone" value="Phone" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ old('phone', $customer->phone) }}" />
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <a href="{{ route('customers.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            Update Customer
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>