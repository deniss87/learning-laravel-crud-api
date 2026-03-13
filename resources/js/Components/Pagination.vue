<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    meta: {
        type: Object,
        default: () => ({}),
    },
});

const prevUrl = computed(() => {
    return props.meta?.links?.find((link) => link.label.includes("Previous"))
        ?.url;
});

const nextUrl = computed(() => {
    return props.meta?.links?.find((link) => link.label.includes("Next"))?.url;
});
</script>

<template>
    <div
        v-if="meta && meta.links"
        class="mt-2 flex justify-center items-center gap-4"
    >
        <Component
            :is="prevUrl ? Link : 'span'"
            :href="prevUrl"
            :class="[
                'p-2 rounded-full transition-all duration-200',
                prevUrl
                    ? 'text-gray-500 hover:text-gray-900 hover:bg-gray-100'
                    : 'text-gray-200 cursor-not-allowed',
            ]"
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
                    d="M15 19l-7-7 7-7"
                />
            </svg>
        </Component>

        <div class="text-sm font-medium text-gray-500 px-4 py-2">
            Page <span class="text-gray-500">{{ meta.current_page }}</span> of
            <span class="text-gray-500">{{ meta.last_page }}</span>
        </div>

        <Component
            :is="nextUrl ? Link : 'span'"
            :href="nextUrl"
            :class="[
                'p-2 rounded-full transition-all duration-200',
                nextUrl
                    ? 'text-gray-500 hover:text-gray-900 hover:bg-gray-100'
                    : 'text-gray-200 cursor-not-allowed',
            ]"
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
                    d="M9 5l7 7-7 7"
                />
            </svg>
        </Component>
    </div>
</template>
