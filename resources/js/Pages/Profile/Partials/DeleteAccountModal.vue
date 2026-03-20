<script setup>
import TextInput from "@/Components/TextInput.vue";
import AppButton from "@/Components/AppButton.vue";

const props = defineProps({
    form: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["confirm", "close"]);
</script>

<template>
    <div
        class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
    >
        <div
            class="bg-white p-8 rounded-2xl shadow-2xl max-w-md w-full border border-gray-100"
        >
            <h2 class="text-xl font-extrabold text-gray-900 mb-2">
                Are you absolutely sure?
            </h2>
            <p class="text-sm text-gray-500 mb-6">
                Please enter your password to confirm account deletion. This
                action cannot be undone.
            </p>

            <TextInput
                label="Password"
                type="password"
                :modelValue="form.password"
                @update:modelValue="form.password = $event"
                :error="form.errors.password"
                @keyup.enter="emit('confirm')"
            />

            <!-- Errors -->
            <div
                v-if="Object.keys(form.errors).length > 0"
                class="mt-4 p-4 bg-red-50 border border-red-200 rounded-xl"
            >
                <ul class="space-y-1">
                    <li
                        v-for="(error, key) in form.errors"
                        :key="key"
                        class="text-sm text-red-600 flex items-center gap-2"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-red-400 shrink-0"
                        ></span>
                        {{ error.password }}
                    </li>
                </ul>
            </div>

            <div class="mt-8 flex gap-3">
                <AppButton
                    variant="secondary"
                    class="flex-1 justify-center"
                    @click="emit('close')"
                >
                    Cancel
                </AppButton>
                <AppButton
                    variant="danger"
                    class="flex-1 justify-center"
                    :disabled="form.processing"
                    @click="emit('confirm')"
                >
                    Delete Forever
                </AppButton>
            </div>
        </div>
    </div>
</template>
