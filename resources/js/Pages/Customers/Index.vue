<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SearchInput from "@/Components/SearchInput.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    customers: Object,
    filters: Object,
});

// Function for deleting a client
const deleteCustomer = (id) => {
    if (confirm("Are you sure you want to delete this customer?")) {
        router.delete(`/customers/${id}`, {
            preserveScroll: true,
        });
    }
};

// Function to get initials
const getInitials = (customer) => {
    return `${customer.first_name[0]}${customer.last_name[0]}`.toUpperCase();
};
</script>

<template>
    <Head title="Manage Clients" />

    <AuthenticatedLayout>
        <div
            class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8"
        >
            <div
                class="flex flex-col md:flex-row justify-between items-center gap-6 mb-8"
            >
                <div class="w-full md:w-auto">
                    <h3
                        class="text-2xl font-extrabold text-gray-900 tracking-tight"
                    >
                        Manage Clients
                    </h3>
                </div>

                <SearchInput
                    v-model="filters.search"
                    routeName="/customers"
                    placeholder="Search by name, email or phone..."
                />

                <div class="w-full md:w-auto text-right">
                    <Link
                        href="/customers/create"
                        class="inline-flex items-center justify-center w-full md:w-auto px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white shadow-md shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all duration-150"
                    >
                        <svg
                            class="w-5 h-5 me-2"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                            />
                        </svg>
                        Add Customer
                    </Link>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table
                    class="min-w-full divide-y divide-gray-100 border-b border-gray-100"
                >
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest"
                            >
                                Name
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest"
                            >
                                Email
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest"
                            >
                                Phone
                            </th>
                            <th
                                class="px-6 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-widest"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr
                            v-for="customer in customers.data"
                            :key="customer.id"
                            class="hover:bg-indigo-50/30 transition-colors group"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="h-10 w-10 flex-shrink-0 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-xs"
                                    >
                                        {{ getInitials(customer) }}
                                    </div>
                                    <div class="ms-4">
                                        <div
                                            class="text-sm font-semibold text-gray-900 group-hover:text-indigo-700 transition-colors"
                                        >
                                            {{ customer.first_name }}
                                            {{ customer.last_name }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"
                            >
                                {{ customer.email }}
                            </td>

                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"
                            >
                                {{ customer.phone || "—" }}
                            </td>

                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                            >
                                <div
                                    class="flex justify-end gap-3 opacity-80 group-hover:opacity-100 transition-opacity"
                                >
                                    <Link
                                        :href="`/customers/${customer.id}/edit`"
                                        class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                        title="Edit Customer"
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                            />
                                        </svg>
                                    </Link>

                                    <button
                                        @click="deleteCustomer(customer.id)"
                                        class="p-2 bg-slate-50 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                        title="Delete Customer"
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr v-if="customers.data.length === 0">
                            <td
                                colspan="4"
                                class="px-6 py-12 text-center text-gray-400 italic bg-gray-50/30 rounded-b-2xl"
                            >
                                No customers found matching your criteria.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                <Pagination :meta="customers" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
