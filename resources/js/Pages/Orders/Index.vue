<script setup>
import { ref, computed } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SearchInput from "@/Components/SearchInput.vue";
import Pagination from "@/Components/Pagination.vue";
import SortableTh from "@/Components/SortableTh.vue";
import FilterButton from "@/Components/FilterButton.vue";
import OrderFilterModal from "./Partials/OrderFilterModal.vue";

const props = defineProps({
    orders: Object,
    filters: Object,
});

const isFilterModalOpen = ref(false);

const isFilterActive = computed(() => {
    return (
        props.filters.statuses?.length > 0 ||
        !!props.filters.date_from ||
        !!props.filters.date_to
    );
});

const deleteOrder = (id) => {
    if (confirm("Delete this order?")) {
        router.delete(`/orders/${id}`, { preserveScroll: true });
    }
};

const getStatusClass = (status) => {
    const classes = {
        processing: "bg-blue-100 text-blue-700",
        completed: "bg-green-100 text-green-700",
        pending: "bg-yellow-100 text-yellow-700",
    };
    return classes[status] || "bg-gray-100 text-gray-700";
};
</script>

<template>
    <Head title="Manage Orders" />

    <AuthenticatedLayout>
        <div
            class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8"
        >
            <div
                class="flex flex-col md:flex-row justify-between items-center gap-6 mb-8"
            >
                <h3
                    class="text-2xl font-extrabold text-gray-900 tracking-tight"
                >
                    Manage Orders
                </h3>

                <div class="w-full lg:max-w-md flex gap-2">
                    <SearchInput
                        v-model="filters.search"
                        routeName="orders.index"
                        placeholder="Order number or customer name..."
                    />

                    <FilterButton
                        :active="isFilterActive"
                        @click="isFilterModalOpen = true"
                    />
                </div>

                <OrderFilterModal
                    :show="isFilterModalOpen"
                    :filters="filters"
                    @close="isFilterModalOpen = false"
                />

                <Link
                    :href="route('orders.create')"
                    class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-md hover:bg-indigo-700 active:scale-95 transition-all"
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
                    New Order
                </Link>
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
                                Order #
                            </th>
                            <SortableTh
                                field="customer"
                                label="Customer"
                                :currentSort="filters.sort"
                                :currentDirection="filters.direction"
                                :queryParams="filters"
                            />
                            <SortableTh
                                field="total_amount"
                                label="Amount"
                                :currentSort="filters.sort"
                                :currentDirection="filters.direction"
                                :queryParams="filters"
                            />
                            <SortableTh
                                field="status"
                                label="Status"
                                :currentSort="filters.sort"
                                :currentDirection="filters.direction"
                                :queryParams="filters"
                            />
                            <SortableTh
                                field="created_at"
                                label="Date"
                                align="center"
                                :currentSort="filters.sort"
                                :currentDirection="filters.direction"
                                :queryParams="filters"
                            />
                            <th
                                class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-widest"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        <tr
                            v-for="order in orders.data"
                            :key="order.id"
                            class="hover:bg-indigo-50/30 transition-colors group"
                        >
                            <td
                                class="px-6 py-4 whitespace-nowrap font-bold text-indigo-600"
                            >
                                {{ order.order_number }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-gray-700 font-medium"
                            >
                                {{ order.customer.first_name }}
                                {{ order.customer.last_name }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900"
                            >
                                €{{
                                    Number(order.total_amount).toLocaleString(
                                        undefined,
                                        { minimumFractionDigits: 2 },
                                    )
                                }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    :class="getStatusClass(order.status)"
                                    class="px-3 py-2 rounded-full text-[10px] font-bold uppercase tracking-wider"
                                >
                                    {{ order.status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col items-center">
                                    <span class="font-medium text-gray-900">{{
                                        new Date(
                                            order.created_at,
                                        ).toLocaleDateString("de-DE")
                                    }}</span>
                                    <span
                                        class="text-[10px] text-gray-400 uppercase font-bold"
                                        >{{
                                            new Date(
                                                order.created_at,
                                            ).toLocaleTimeString([], {
                                                hour: "2-digit",
                                                minute: "2-digit",
                                                hour12: false,
                                            })
                                        }}</span
                                    >
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center gap-2">
                                    <Link
                                        v-if="order.can.edit"
                                        :href="route('orders.edit', order.id)"
                                        class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                    >
                                        <svg
                                            class="w-4 h-4"
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
                                        v-if="order.can.delete"
                                        @click="deleteOrder(order.id)"
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                    >
                                        <svg
                                            class="w-4 h-4"
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
                        <tr v-if="orders.data.length === 0">
                            <td
                                colspan="6"
                                class="px-6 py-10 text-center text-gray-500 italic"
                            >
                                No orders found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                <Pagination :meta="orders" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
