<script setup>
import { ref } from "vue";
import { Link, useForm, router } from "@inertiajs/vue3";
import FlashMessage from "@/Components/FlashMessage.vue";

const showingNavigationDropdown = ref(false);
let closeTimer = null;

const openDropdown = () => {
    if (closeTimer) clearTimeout(closeTimer);
    showingNavigationDropdown.value = true;
};

const closeDropdownWithDelay = () => {
    closeTimer = setTimeout(() => {
        showingNavigationDropdown.value = false;
    }, 200);
};

const logoutForm = useForm({});

const logout = () => {
    router.post(route("logout"));
};
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
                        <div
                            class="ml-3 relative"
                            @mouseenter="openDropdown"
                            @mouseleave="closeDropdownWithDelay"
                        >
                            <div>
                                <button
                                    type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                >
                                    {{ $page.props.auth.user.name }}

                                    <svg
                                        class="ml-2 -mr-0.5 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </div>

                            <transition
                                enter-active-class="transition ease-out duration-200"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <div
                                    v-show="showingNavigationDropdown"
                                    class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-100"
                                    style="display: none"
                                >
                                    <div class="px-1 py-1">
                                        <Link
                                            :href="route('profile.edit')"
                                            class="group flex items-center rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out"
                                        >
                                            <svg
                                                class="w-4 h-4 mr-3 text-gray-400 group-hover:text-gray-600"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                />
                                            </svg>
                                            Profile
                                        </Link>
                                    </div>

                                    <div class="px-1 py-1">
                                        <button
                                            @click="logout"
                                            class="group flex w-full items-center rounded-md px-3 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-150 ease-in-out"
                                        >
                                            <svg
                                                class="w-4 h-4 mr-3 text-red-400 group-hover:text-red-500"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                                />
                                            </svg>
                                            Log Out
                                        </button>
                                    </div>
                                </div>
                            </transition>
                        </div>
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
                    <FlashMessage />
                    <slot />
                </div>
            </div>
        </main>
    </div>
</template>
