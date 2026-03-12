<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CustomerForm from "./Partials/CustomerForm.vue";

const props = defineProps({
    customer: Object,
});

const form = useForm({
    first_name: props.customer.first_name,
    last_name: props.customer.last_name,
    email: props.customer.email,
    phone: props.customer.phone || "",
});

const updateCustomer = () => {
    form.put(`/customers/${props.customer.id}`);
};
</script>

<template>
    <Head :title="`Edit ${customer.first_name}`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Customer
            </h2>
        </template>

        <div class="max-w-2xl mx-auto">
            <div
                class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 p-8"
            >
                <CustomerForm
                    :form="form"
                    submitLabel="Update Customer"
                    @submit="updateCustomer"
                >
                    <template #actions-left>
                        <Link
                            href="/customers"
                            class="text-sm font-semibold text-gray-500 hover:text-gray-700"
                        >
                            Cancel
                        </Link>
                    </template>
                </CustomerForm>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
