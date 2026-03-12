<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CustomerForm from "./Partials/CustomerForm.vue";

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
});

const createCustomer = () => {
    form.post("/customers", {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Add New Customer" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto">
            <div
                class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8"
            >
                <CustomerForm
                    :form="form"
                    submitLabel="Create Customer"
                    @submit="createCustomer"
                >
                </CustomerForm>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
