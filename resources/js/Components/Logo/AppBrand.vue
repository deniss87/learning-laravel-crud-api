<script setup>
import { Link } from "@inertiajs/vue3";
import AppLogo from "@/Components/Logo/AppLogo.vue";
import AppLogo2 from "@/Components/Logo/AppLogo2.vue";
</script>

<template>
    <Link href="/" class="flex items-center gap-3 group">
        <div
            class="w-14 h-14 rounded-xl bg-indigo-600 flex items-center justify-center shadow-md"
        >
            <!-- bg-indigo-600 p-2.5 rounded-2xl shadow-lg group-hover:scale-105 transition-transform -->
            <!-- w-14 h-14 rounded-xl bg-indigo-600 flex items-center justify-center shadow-md -->
            <AppLogo class="w-8 h-8 text-white" />
        </div>
        <span class="text-3xl font-black tracking-tighter text-gray-900">
            NEXT<span class="text-indigo-600">CRM</span>
        </span>
    </Link>
</template>
