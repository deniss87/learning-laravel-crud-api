<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome to NextCRM" />

    <div
        class="antialiased bg-gradient-to-br from-slate-100 to-indigo-50 min-h-screen flex items-center justify-center font-['Sora']"
    >
        <div class="w-full max-w-lg mx-auto px-4">
            <div
                class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 px-10 py-12 text-center"
            >
                <div class="flex justify-center mb-6">
                    <div
                        class="w-14 h-14 rounded-xl bg-indigo-600 flex items-center justify-center shadow-md"
                    >
                        <svg
                            class="w-8 h-8 text-white"
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
                </div>

                <h1
                    class="text-3xl font-extrabold text-gray-900 mb-3 leading-tight"
                >
                    NEXT<span class="text-indigo-600">CRM</span>
                </h1>

                <p class="text-gray-500 text-sm leading-relaxed mb-10">
                    Welcome to our educational Laravel CRUD project.<br />
                    Manage your clients and orders efficiently.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-3">
                    <template v-if="$page.props.auth.user">
                        <Link
                            :href="route('dashboard')"
                            class="px-7 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-md hover:bg-indigo-700 active:scale-95 transition-all duration-150"
                        >
                            Go to Dashboard
                        </Link>
                    </template>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="px-7 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl shadow-sm hover:bg-gray-50 active:scale-95 transition-all duration-150"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="px-7 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-md hover:bg-indigo-700 active:scale-95 transition-all duration-150"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </div>

            <p class="text-center text-xs text-gray-400 mt-6">
                Deniss Patancevs · Educational Project
            </p>
        </div>
    </div>
</template>

<style>
/* @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;800&display=swap'); */
</style>
