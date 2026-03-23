<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({ email: "", password: "", remember: false });

defineProps({
    canResetPassword: Boolean,
    status: String,
});
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <form @submit.prevent="form.post(route('login'))">
            <div>
                <TextInput
                    v-model="form.email"
                    type="email"
                    label="Full Name"
                    autofocus
                    placeholder="admin@mail.com"
                    :error="form.errors.email"
                />
            </div>

            <div class="mt-6">
                <TextInput
                    v-model="form.password"
                    type="password"
                    label="Password"
                    placeholder="••••••••"
                    :error="form.errors.password"
                />
            </div>
            <!-- Remember Me -->
            <div class="flex items-center mt-6 mb-4">
                <label class="inline-flex items-center cursor-pointer group">
                    <input
                        type="checkbox"
                        v-model="form.remember"
                        class="w-5 h-5 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 transition-all"
                    />
                    <span
                        class="ms-3 text-sm text-gray-600 group-hover:text-gray-900"
                        >Remember me</span
                    >
                </label>
            </div>
            <!-- Sign In Button -->
            <div class="mt-8">
                <button
                    type="submit"
                    class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 active:scale-95 transition-all shadow-md shadow-indigo-200 disabled:opacity-50"
                    :disabled="form.processing"
                >
                    Sign In
                </button>
            </div>

            <div class="pt-6 border-t border-gray-50 text-center space-y-2">
                <!-- Sign Up Link -->
                <p class="text-sm text-gray-500">
                    Don't have an account?
                    <Link
                        :href="route('register')"
                        class="text-indigo-600 font-bold hover:text-indigo-800 transition-colors"
                        >Register</Link
                    >
                </p>
                <!-- Forgot password Link -->
                <div v-if="canResetPassword">
                    <Link
                        :href="route('password.request')"
                        class="text-xs text-gray-400 hover:text-gray-600 transition-colors underline underline-offset-4"
                    >
                        Forgot your password?
                    </Link>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
