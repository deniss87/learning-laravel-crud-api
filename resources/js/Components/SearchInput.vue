<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import debounce from "lodash/debounce";

const props = defineProps({
    modelValue: String,
    placeholder: {
        type: String,
        default: "Search...",
    },
    routeName: String,
});

const emit = defineEmits(["update:modelValue"]);

const search = ref(props.modelValue || "");

// Monitor changes for live search
watch(
    search,
    debounce((value) => {
        emit("update:modelValue", value);
        performSearch(value);
    }, 500),
);

// The function of the query itself
const performSearch = (value) => {
    router.get(
        route(props.routeName),
        { search: value },
        {
            preserveState: true,
            replace: true,
        },
    );
};

// Instant cleaning function
const clearSearch = () => {
    search.value = "";
    emit("update:modelValue", "");
    performSearch("");
};
</script>

<template>
    <div class="relative group w-full lg:max-w-md">
        <div
            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
        >
            <svg
                class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                />
            </svg>
        </div>

        <input
            v-model="search"
            type="text"
            :placeholder="placeholder"
            class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all sm:text-sm"
        />

        <button
            v-if="search.length > 0"
            @click="clearSearch"
            type="button"
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
        >
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </div>
</template>
