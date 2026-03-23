<script setup>
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import AppButton from "@/Components/AppButton.vue";

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header class="mb-6">
            <h2 class="text-lg font-bold text-gray-900">Profile Information</h2>
            <p class="mt-1 text-sm text-gray-500">
                Update your account's profile information and email address.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="space-y-6"
        >
            <TextInput
                label="Name"
                v-model="form.name"
                :error="form.errors.name"
                required
                autofocus
            />

            <TextInput
                label="Email Address"
                type="email"
                v-model="form.email"
                :error="form.errors.email"
                required
            />

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>
            </div>

            <div class="flex items-center gap-4">
                <AppButton type="submit" :disabled="form.processing">
                    Save Changes
                </AppButton>

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-emerald-600 font-medium"
                    >
                        Saved successfully.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
