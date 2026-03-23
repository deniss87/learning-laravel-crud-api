<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

const VARIANTS = {
    primary:
        "bg-indigo-600 text-white shadow-md shadow-indigo-200 hover:bg-indigo-700",
    danger: "bg-red-600 text-white shadow-md shadow-red-200 hover:bg-red-700",
    secondary: "bg-white text-gray-700 border border-gray-200 hover:bg-gray-50",
    update: "bg-emerald-600 text-white shadow-md shadow-emerald-200 hover:bg-emerald-700",
} as const;

type Variant = keyof typeof VARIANTS;

const props = withDefaults(
    defineProps<{
        href?: string;
        type?: "button" | "submit" | "reset";
        variant?: Variant;
        disabled?: boolean;
    }>(),
    {
        type: "button",
        variant: "primary",
        disabled: false,
    },
);
</script>

<template>
    <Link
        v-if="href"
        :href="href"
        :class="[
            'inline-flex items-center gap-2 px-6 py-3 font-semibold rounded-xl active:scale-95 transition-all',
            VARIANTS[props.variant],
            disabled ? 'opacity-50 pointer-events-none' : '',
        ]"
    >
        <slot />
    </Link>

    <button
        v-else
        :type="type"
        :disabled="disabled"
        :class="[
            'inline-flex items-center gap-2 px-6 py-3 font-semibold rounded-xl active:scale-95 transition-all',
            VARIANTS[props.variant],
            disabled ? 'opacity-50 cursor-not-allowed' : '',
        ]"
    >
        <slot />
    </button>
</template>
