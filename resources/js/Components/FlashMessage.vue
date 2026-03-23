<script setup>
import { watch, ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const visible = ref(true);
const timeout = ref(null);

// monitor changes in flash messages
watch(
    () => page.props.flash.success,
    (message) => {
        if (message) {
            visible.value = true;

            if (timeout.value) clearTimeout(timeout.value);

            // Hide after 3 seconds
            timeout.value = setTimeout(() => {
                visible.value = false;
                page.props.flash.success = null;
            }, 3000);
        }
    },
    { immediate: true },
);
</script>

<template>
    <Transition
        enter-active-class="transform transition ease-out duration-300"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="visible && page.props.flash.success"
            class="fixed top-14 left-1/2 -translate-x-1/2 z-50 w-full max-w-sm pointer-events-none"
        >
            <div
                class="mx-4 flex items-center p-3 text-sm text-emerald-800 border border-emerald-200 rounded-xl bg-emerald-50/95 backdrop-blur-sm shadow-xl shadow-emerald-100/50 pointer-events-auto"
            >
                <div class="bg-emerald-200 p-1 rounded-full me-3">
                    <svg
                        class="w-3.5 h-3.5 text-emerald-700"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="3"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>
                <div class="font-bold tracking-wide leading-tight">
                    {{ page.props.flash.success }}
                </div>
                <button
                    @click="visible = false"
                    class="ms-auto text-emerald-500 hover:text-emerald-700 transition-colors"
                >
                    <svg
                        class="w-3.5 h-3.5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </Transition>
</template>
