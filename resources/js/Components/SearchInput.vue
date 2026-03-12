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

const search = ref(props.modelValue);

watch(
    search,
    debounce((value) => {
        emit("update:modelValue", value);
        router.get(
            props.routeName,
            { search: value },
            {
                preserveState: true,
                replace: true,
            },
        );
    }, 500),
);
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
            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all sm:text-sm"
        />
    </div>
</template>
