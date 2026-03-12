<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <Link
                                href="/dashboard"
                                class="flex items-center gap-2 group"
                            >
                                <div class="bg-indigo-600 p-1.5 rounded-lg">
                                    <svg
                                        class="w-5 h-5 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"
                                        />
                                    </svg>
                                </div>
                                <span
                                    class="text-xl font-black tracking-tight text-gray-900"
                                >
                                    NEXT<span class="text-indigo-600">CRM</span>
                                </span>
                            </Link>
                        </div>

                        <div
                            class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                        >
                            <Link
                                href="/dashboard"
                                :class="{
                                    'border-indigo-400 text-gray-900':
                                        $page.component === 'Dashboard',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300':
                                        $page.component !== 'Dashboard',
                                }"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out"
                            >
                                Dashboard
                            </Link>
                            <Link
                                href="/customers"
                                :class="{
                                    'border-indigo-400 text-gray-900':
                                        $page.component === 'Customers/Index',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300':
                                        $page.component !== 'Customers/Index',
                                }"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out"
                            >
                                Customers
                            </Link>
                            <Link
                                href="/orders"
                                :class="{
                                    'border-indigo-400 text-gray-900':
                                        $page.component === 'Orders/Index',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300':
                                        $page.component !== 'Orders/Index',
                                }"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out"
                            >
                                Orders
                            </Link>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <span class="text-sm font-medium text-gray-500">{{
                            $page.props.auth.user.name
                        }}</span>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <slot />
                </div>
            </div>
        </main>
    </div>
</template>
