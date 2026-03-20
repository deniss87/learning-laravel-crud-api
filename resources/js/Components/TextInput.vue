<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: [String, Number],
    type: { type: String, default: "text" },
    label: String,
    error: String,
    placeholder: String,
    required: Boolean,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="w-full">
        <label
            v-if="label"
            class="block font-semibold text-xs uppercase tracking-widest text-gray-500 mb-2 ml-2"
        >
            {{ label }}
        </label>

        <input
            ref="input"
            :type="type"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :placeholder="placeholder"
            :required="required"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full h-12 px-4 transition-all"
            :class="{
                'border-red-500 focus:border-red-500 focus:ring-red-500': error,
            }"
        />

        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="transform -translate-y-1 opacity-0"
            enter-to-class="transform translate-y-0 opacity-100"
        >
            <p
                v-if="error"
                class="mt-2 text-xs text-red-600 font-medium italic ml-1"
            >
                {{ error }}
            </p>
        </transition>
    </div>
</template>
