<script setup>
import { ref, onMounted, onUnmounted } from "vue";

const props = defineProps({
    modelValue: String,
    error: String,
});

const emit = defineEmits(["update:modelValue"]);

const isOpen = ref(false);
const wrapper = ref(null);

const statuses = [
    { value: "pending", label: "Pending", color: "bg-yellow-500" },
    { value: "processing", label: "Processing", color: "bg-blue-500" },
    { value: "completed", label: "Completed", color: "bg-green-500" },
    { value: "cancelled", label: "Cancelled", color: "bg-red-500" },
];

const selectedStatus = () =>
    statuses.find((s) => s.value === props.modelValue) || statuses[0];

const select = (value) => {
    emit("update:modelValue", value);
    isOpen.value = false;
};

const handleClickOutside = (e) => {
    if (wrapper.value && !wrapper.value.contains(e.target))
        isOpen.value = false;
};

onMounted(() => document.addEventListener("click", handleClickOutside));
onUnmounted(() => document.removeEventListener("click", handleClickOutside));
</script>

<template>
    <div class="relative" ref="wrapper">
        <div
            @click="isOpen = !isOpen"
            :class="[
                'w-full px-4 py-2.5 bg-gray-50 border rounded-xl cursor-pointer flex justify-between items-center transition-all',
                isOpen
                    ? 'ring-2 ring-indigo-500 border-transparent'
                    : 'border-gray-200',
            ]"
        >
            <div class="flex items-center gap-2">
                <span
                    :class="['w-2 h-2 rounded-full', selectedStatus().color]"
                ></span>
                <span class="text-sm font-bold text-gray-900">{{
                    selectedStatus().label
                }}</span>
            </div>
            <svg
                class="w-5 h-5 text-gray-400 transition-transform"
                :class="{ 'rotate-180': isOpen }"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                />
            </svg>
        </div>

        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <div
                v-if="isOpen"
                class="absolute z-[110] w-full mt-2 bg-white border border-gray-100 shadow-2xl rounded-xl overflow-hidden"
            >
                <ul class="py-1">
                    <li
                        v-for="status in statuses"
                        :key="status.value"
                        @click="select(status.value)"
                        class="px-4 py-3 hover:bg-indigo-50 cursor-pointer flex items-center gap-3 transition-colors"
                    >
                        <span
                            :class="['w-2 h-2 rounded-full', status.color]"
                        ></span>
                        <span
                            :class="[
                                'text-sm',
                                modelValue === status.value
                                    ? 'font-bold text-indigo-600'
                                    : 'font-medium text-gray-700',
                            ]"
                        >
                            {{ status.label }}
                        </span>
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>
