<script setup>
import { reactive, watch } from "vue";
import { router } from "@inertiajs/vue3";
import AppButton from "@/Components/AppButton.vue";

const props = defineProps({
    show: Boolean,
    filters: Object,
});

const emit = defineEmits(["close"]);

// Local copy of filters
const form = reactive({
    statuses: props.filters.statuses || [],
    date_from: props.filters.date_from || "",
    date_to: props.filters.date_to || "",
});

// Synchronize the form if the props have changed externally
watch(
    () => props.filters,
    (newFilters) => {
        form.statuses = newFilters.statuses || [];
        form.date_from = newFilters.date_from || "";
        form.date_to = newFilters.date_to || "";
    },
    { deep: true },
);

watch(
    () => props.show,
    (isVisible) => {
        if (isVisible) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "";
        }
    },
);

const applyFilters = () => {
    router.get(
        route("orders.index"),
        {
            ...props.filters,
            statuses: form.statuses,
            date_from: form.date_from,
            date_to: form.date_to,
            page: 1,
        },
        {
            preserveState: true,
            replace: true,
            onSuccess: () => emit("close"),
        },
    );
};

const resetFilters = () => {
    form.statuses = [];
    form.date_from = "";
    form.date_to = "";

    router.get(
        route("orders.index"),
        {
            search: props.filters.search,
        },
        {
            preserveState: true,
            replace: true,
            onSuccess: () => emit("close"),
        },
    );
};

const toggleStatus = (status) => {
    const index = form.statuses.indexOf(status);
    if (index > -1) {
        form.statuses.splice(index, 1);
    } else {
        form.statuses.push(status);
    }
};
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
        <div
            class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm"
            @click="emit('close')"
        ></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div
                class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden"
            >
                <div
                    class="flex items-center justify-between px-6 py-5 border-b border-gray-100"
                >
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">
                            Filter Orders
                        </h2>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Narrow down your orders
                        </p>
                    </div>
                    <button
                        @click="emit('close')"
                        class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-all"
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
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                <div class="px-6 py-6 space-y-8 overflow-y-auto max-h-[70vh]">
                    <div>
                        <h3
                            class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3"
                        >
                            Status
                        </h3>
                        <div class="space-y-2">
                            <label
                                v-for="status in [
                                    'pending',
                                    'processing',
                                    'completed',
                                    'cancelled',
                                ]"
                                :key="status"
                                :class="[
                                    'flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all',
                                    form.statuses.includes(status)
                                        ? 'border-indigo-300 bg-indigo-50'
                                        : 'border-gray-100 hover:bg-gray-50',
                                ]"
                            >
                                <input
                                    type="checkbox"
                                    :value="status"
                                    :checked="form.statuses.includes(status)"
                                    @change="toggleStatus(status)"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                />
                                <span
                                    class="flex items-center gap-2 text-sm font-medium text-gray-700"
                                >
                                    <span
                                        :class="[
                                            'w-2 h-2 rounded-full',
                                            status === 'completed'
                                                ? 'bg-green-500'
                                                : status === 'pending'
                                                  ? 'bg-yellow-500'
                                                  : status === 'processing'
                                                    ? 'bg-blue-500'
                                                    : 'bg-gray-400',
                                        ]"
                                    ></span>
                                    {{
                                        status.charAt(0).toUpperCase() +
                                        status.slice(1)
                                    }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <h3
                            class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3"
                        >
                            Date Range
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label
                                    class="block text-xs font-medium text-gray-500 mb-1.5"
                                    >From</label
                                >
                                <input
                                    type="date"
                                    v-model="form.date_from"
                                    class="block w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500 transition-all"
                                />
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-medium text-gray-500 mb-1.5"
                                    >To</label
                                >
                                <input
                                    type="date"
                                    v-model="form.date_to"
                                    class="block w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500 transition-all"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="px-6 py-4 border-t border-gray-100 flex gap-3 bg-gray-50/50"
                >
                    <button
                        @click="resetFilters"
                        class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-100 transition-all"
                    >
                        Reset
                    </button>
                    <button
                        @click="applyFilters"
                        class="flex-1 px-4 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow-md hover:bg-indigo-700 transition-all"
                    >
                        Apply Filters
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
