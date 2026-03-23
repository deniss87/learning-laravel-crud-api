<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <Head title="Account Settings" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto space-y-6">
            <div
                class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 px-10 py-8"
            >
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>

            <div
                class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 px-10 py-8"
            >
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div
                class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 px-10 py-8"
            >
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
