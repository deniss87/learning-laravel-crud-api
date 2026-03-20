<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "user",
});

const roleOptions = [
    { value: "user", label: "Standard User" },
    { value: "admin", label: "Administrator" },
];

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="mb-6 text-center">
            <h2 class="text-xl font-bold text-gray-900">Create Account</h2>
        </div>

        <form @submit.prevent="submit">
            <div>
                <TextInput
                    v-model="form.name"
                    type="text"
                    label="Full Name"
                    required
                    autofocus
                    placeholder="John Doe"
                    :error="form.errors.name"
                />
            </div>

            <div class="mt-4">
                <TextInput
                    v-model="form.email"
                    label="Email Address"
                    type="email"
                    required
                    placeholder="john@example.com"
                    :error="form.errors.email"
                />
            </div>

            <div class="mt-4">
                <TextInput
                    v-model="form.password"
                    label="Password"
                    type="password"
                    required
                    placeholder="••••••••"
                    :error="form.errors.password"
                />
            </div>

            <div class="mt-4">
                <TextInput
                    v-model="form.password_confirmation"
                    label="Confirm Password"
                    type="password"
                    required
                    placeholder="••••••••"
                    :error="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4">
                <SelectInput
                    v-model="form.role"
                    label="Access Level"
                    :options="roleOptions"
                    :error="form.errors.role"
                />
            </div>
            <!-- Create Account Button -->
            <div class="mt-6">
                <button
                    type="submit"
                    class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 active:scale-95 transition-all shadow-md shadow-indigo-200 disabled:opacity-50"
                    :disabled="form.processing"
                >
                    Create Account
                </button>
            </div>
        </form>

        <div class="pt-6 border-t border-gray-50 text-center">
            <p class="text-sm text-gray-500">
                Already have an account?
                <Link
                    :href="route('login')"
                    class="text-indigo-600 font-bold hover:text-indigo-800 transition-colors"
                    >Log In</Link
                >
            </p>
        </div>
    </GuestLayout>
</template>
