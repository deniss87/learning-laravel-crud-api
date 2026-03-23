<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from "vue";

const props = defineProps({
    modelValue: [String, Number],
    options: Array,
    placeholder: { type: String, default: "Search customer..." },
    error: String,
});

const emit = defineEmits(["update:modelValue"]);

const isOpen = ref(false);
const search = ref("");
const wrapper = ref(null);

// Synchronize the initial value
const syncSelected = () => {
    const selected = props.options.find((opt) => opt.id === props.modelValue);
    if (selected) {
        search.value = `${selected.last_name} ${selected.first_name}`;
    }
};

onMounted(syncSelected);
// If the model changes externally (for example, a form reset), we update the text
watch(
    () => props.modelValue,
    (newVal) => {
        if (!newVal) search.value = "";
        else syncSelected();
    },
);

// Filtering the list
const filteredOptions = computed(() => {
    const query = search.value.toLowerCase().trim();

    const selected = props.options.find((opt) => opt.id === props.modelValue);
    const selectedName = selected
        ? `${selected.last_name} ${selected.first_name}`.toLowerCase()
        : "";

    if (!query || query === selectedName) {
        return props.options;
    }

    return props.options.filter(
        (opt) =>
            opt.first_name.toLowerCase().includes(query) ||
            opt.last_name.toLowerCase().includes(query) ||
            opt.email.toLowerCase().includes(query),
    );
});

const selectOption = (opt) => {
    search.value = `${opt.last_name} ${opt.first_name}`;
    emit("update:modelValue", opt.id);
    isOpen.value = false;
};

const handleInput = () => {
    isOpen.value = true;
    // If the user has deleted everything, we reset the ID
    if (search.value === "") {
        emit("update:modelValue", null);
    }
};

const handleClickOutside = (event) => {
    if (wrapper.value && !wrapper.value.contains(event.target)) {
        isOpen.value = false;
        // Return the name of the selected client if the user simply clicked past it.
        syncSelected();
    }
};

onMounted(() => document.addEventListener("click", handleClickOutside));
onUnmounted(() => document.removeEventListener("click", handleClickOutside));
</script>

<template>
    <div class="relative" ref="wrapper">
        <div class="relative">
            <input
                v-model="search"
                type="text"
                @focus="isOpen = true"
                @input="handleInput"
                :placeholder="placeholder"
                :class="[
                    'w-full px-4 py-2.5 bg-gray-50 border rounded-xl transition-all focus:ring-2 focus:ring-indigo-500 outline-none',
                    error ? 'border-red-500' : 'border-gray-200',
                ]"
            />
            <div
                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
            >
                <svg
                    class="h-5 w-5 text-gray-400"
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
                class="absolute z-[100] w-full mt-2 bg-white border border-gray-100 shadow-2xl rounded-xl overflow-hidden"
            >
                <ul class="max-h-80 overflow-y-auto custom-scrollbar">
                    <li
                        v-for="opt in filteredOptions"
                        :key="opt.id"
                        @click="selectOption(opt)"
                        class="px-4 py-3 hover:bg-indigo-50 cursor-pointer transition-colors border-b border-gray-50 last:border-none flex flex-col"
                    >
                        <span class="text-sm font-bold text-gray-900"
                            >{{ opt.last_name }} {{ opt.first_name }}</span
                        >
                        <span class="text-xs text-gray-500">{{
                            opt.email
                        }}</span>
                    </li>
                    <li
                        v-if="filteredOptions.length === 0"
                        class="px-4 py-8 text-center text-gray-400 text-sm italic"
                    >
                        No results for "{{ search }}"
                    </li>
                </ul>
            </div>
        </transition>

        <div v-if="error" class="mt-1 text-xs text-red-500 font-medium">
            {{ error }}
        </div>
    </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #e2e8f0;
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #cbd5e1;
}
</style>
