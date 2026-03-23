<script setup>
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import AppButton from "@/Components/AppButton.vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    form.put(route("password.update"), {
        errorBag: "updatePassword",
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header class="mb-6">
            <h2 class="text-lg font-bold text-gray-900">Security</h2>
            <p class="mt-1 text-sm text-gray-500">
                Ensure your account is using a long, random password to stay
                secure.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="space-y-6">
            <TextInput
                label="Current Password"
                ref="currentPasswordInput"
                v-model="form.current_password"
                type="password"
                :error="form.errors.current_password"
            />

            <TextInput
                label="New Password"
                ref="passwordInput"
                v-model="form.password"
                type="password"
                :error="form.errors.password"
            />

            <TextInput
                label="Confirm New Password"
                v-model="form.password_confirmation"
                type="password"
                :error="form.errors.password_confirmation"
            />

            <div class="flex items-center gap-4">
                <AppButton
                    type="submit"
                    variant="update"
                    :disabled="form.processing"
                >
                    Update Password
                </AppButton>

                <p
                    v-if="form.recentlySuccessful"
                    class="text-sm text-emerald-600 font-medium"
                >
                    Password updated.
                </p>
            </div>
            <!-- Errors -->
            <div
                v-if="Object.keys(form.errors).length > 0"
                class="mt-4 p-4 bg-red-50 border border-red-200 rounded-xl"
            >
                <p
                    class="text-xs font-bold text-red-500 uppercase tracking-widest mb-2"
                >
                    Please fix the following errors:
                </p>
                <ul class="space-y-1">
                    <li
                        v-for="error in Object.values(form.errors)"
                        :key="error"
                        class="text-sm text-red-600 flex items-center gap-2"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-red-400 shrink-0"
                        ></span>
                        {{ error }}
                    </li>
                </ul>
            </div>
        </form>
    </section>
</template>
