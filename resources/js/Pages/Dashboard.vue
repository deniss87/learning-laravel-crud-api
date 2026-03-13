<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    stats: Object,
});

const formatCurrency = (value) => {
    return new Intl.NumberFormat("de-DE", {
        style: "currency",
        currency: "EUR",
    }).format(value);
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div
                class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow"
            >
                <div class="flex items-center">
                    <div class="p-3 bg-indigo-50 rounded-xl">
                        <svg
                            class="w-8 h-8 text-indigo-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                            />
                        </svg>
                    </div>
                    <div class="ms-5">
                        <p
                            class="text-sm font-bold text-gray-400 uppercase tracking-widest"
                        >
                            Total Clients
                        </p>
                        <h4 class="text-3xl font-black text-gray-900">
                            {{ stats.total_customers }}
                        </h4>
                    </div>
                </div>
                <div class="mt-4">
                    <Link
                        href="/customers"
                        class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 inline-flex items-center"
                    >
                        View all clients
                        <svg
                            class="w-4 h-4 ms-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </Link>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow"
            >
                <div class="flex items-center">
                    <div class="p-3 bg-emerald-50 rounded-xl">
                        <svg
                            class="w-8 h-8 text-emerald-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                            />
                        </svg>
                    </div>
                    <div class="ms-5">
                        <p
                            class="text-sm font-bold text-gray-400 uppercase tracking-widest"
                        >
                            Total Orders
                        </p>
                        <h4 class="text-3xl font-black text-gray-900">
                            {{ stats.total_orders }}
                        </h4>
                    </div>
                </div>
                <div class="mt-4">
                    <Link
                        href="/orders"
                        class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 inline-flex items-center"
                    >
                        Manage orders
                        <svg
                            class="w-4 h-4 ms-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </Link>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow"
            >
                <div class="flex items-center">
                    <div class="p-3 bg-amber-50 rounded-xl">
                        <svg
                            class="w-8 h-8 text-amber-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                            />
                        </svg>
                    </div>
                    <div class="ms-5">
                        <p
                            class="text-sm font-bold text-gray-400 uppercase tracking-widest"
                        >
                            Revenue
                        </p>
                        <h4 class="text-3xl font-black text-gray-900">
                            {{ formatCurrency(stats.revenue || 0) }}
                        </h4>
                    </div>
                </div>
                <div class="mt-4 text-sm text-gray-500 italic">
                    Based on completed orders
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
