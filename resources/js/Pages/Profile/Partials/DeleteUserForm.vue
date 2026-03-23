<script setup>
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import AppButton from "@/Components/AppButton.vue";
import DeleteAccountModal from "@/Pages/Profile/Partials/DeleteAccountModal.vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.reset();
};
</script>

<template>
    <section>
        <header class="mb-6">
            <h2 class="text-lg font-bold text-red-600">Danger Zone</h2>
            <p class="mt-1 text-sm text-gray-500">
                Once your account is deleted, all of its data will be
                permanently removed.
            </p>
        </header>

        <AppButton
            @click="confirmingUserDeletion = true"
            variant="danger"
            :disabled="form.processing"
        >
            Delete Account
        </AppButton>

        <DeleteAccountModal
            v-if="confirmingUserDeletion"
            :form="form"
            @confirm="deleteUser"
            @close="closeModal"
        />
    </section>
</template>
