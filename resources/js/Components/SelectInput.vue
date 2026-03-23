<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";

const props = defineProps({
    modelValue: [String, Number],
    options: {
        type: Array,
        required: true,
    },
    placeholder: {
        type: String,
        default: "Select an option",
    },
    label: String,
    error: String,
});

const emit = defineEmits(["update:modelValue"]);

const isOpen = ref(false);
const wrapper = ref(null);

const selectedOption = computed(
    () => props.options.find((opt) => opt.value === props.modelValue) || null,
);

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
        <label
            v-if="label"
            class="block font-semibold text-xs uppercase tracking-widest text-gray-500 mb-2 ml-2"
        >
            {{ label }}
        </label>
        <div
            @click="isOpen = !isOpen"
            :class="[
                'w-full px-4 h-10 bg-white border rounded-md cursor-pointer flex justify-between items-center transition-all shadow-sm',
                isOpen
                    ? 'ring-2 ring-indigo-500 border-transparent'
                    : 'border-gray-300 hover:border-gray-400',
            ]"
        >
            <div class="flex items-center">
                <template v-if="selectedOption">
                    <span
                        v-if="selectedOption.color"
                        :class="[
                            'w-2 h-2 rounded-full shrink-0',
                            selectedOption.color,
                        ]"
                    ></span>
                    <span class="text-sm font-bold text-gray-900 truncate">{{
                        selectedOption.label
                    }}</span>
                </template>
                <span v-else class="text-sm text-gray-400">{{
                    placeholder
                }}</span>
            </div>
            <svg
                class="w-4 h-4 text-gray-400 transition-transform duration-200"
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
                <ul class="py-1 max-h-60 overflow-auto">
                    <li
                        v-for="option in options"
                        :key="option.value"
                        @click="select(option.value)"
                        class="py-3 px-4 hover:bg-indigo-50 cursor-pointer flex items-center gap-3 transition-colors"
                    >
                        <span
                            v-if="option.color"
                            :class="['w-2 h-2 rounded-full', option.color]"
                        ></span>
                        <span
                            :class="[
                                'text-sm truncate',
                                modelValue === option.value
                                    ? 'font-bold text-indigo-600'
                                    : 'font-medium text-gray-700',
                            ]"
                        >
                            {{ option.label }}
                        </span>
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>
