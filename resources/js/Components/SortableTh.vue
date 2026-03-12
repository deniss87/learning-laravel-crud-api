<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    field: String,
    label: String,
    currentSort: String,
    currentDirection: String,
    queryParams: Object,
});

const isActive = computed(() => props.currentSort === props.field);
const nextDirection = computed(() =>
    isActive.value && props.currentDirection === "asc" ? "desc" : "asc",
);

const sortLink = computed(() => {
    return {
        ...props.queryParams,
        sort: props.field,
        direction: nextDirection.value,
    };
});
</script>

<template>
    <th
        class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest"
    >
        <Link
            :href="route('orders.index', sortLink)"
            class="flex items-center gap-1 hover:text-indigo-600 transition-colors group"
        >
            {{ label }}
            <span class="flex flex-col opacity-40 group-hover:opacity-100">
                <svg
                    v-if="isActive && currentDirection === 'asc'"
                    class="w-3 h-3"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                    />
                </svg>
                <svg
                    v-else-if="isActive && currentDirection === 'desc'"
                    class="w-3 h-3"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    />
                </svg>
                <svg
                    v-else
                    class="w-3 h-3"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        fill-rule="evenodd"
                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </span>
        </Link>
    </th>
</template>
