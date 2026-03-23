<script setup>
import { Link } from "@inertiajs/vue3";
import AppBrand from "@/Components/Logo/AppBrand.vue";
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center bg-gray-100 px-4">
        <div class="flex-grow flex flex-col items-center justify-center">
            <div class="mb-8 flex flex-col items-center gap-3">
                <AppBrand />
            </div>

            <div
                class="w-full sm:max-w-md px-8 py-10 mb-6 bg-white overflow-hidden rounded-2xl shadow-xl ring-1 ring-gray-200"
            >
                <slot />
            </div>
        </div>
        <!-- Footer -->
        <footer class="text-center text-xs text-gray-400">
            Deniss Patancevs · Educational Project
        </footer>
    </div>
</template>
