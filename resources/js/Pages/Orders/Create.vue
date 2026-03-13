<script setup>
import { Head, useForm, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import OrderForm from "./Partials/OrderForm.vue";

const props = defineProps({
    customers: Array,
    next_order_number: String,
});

const generateOrderNumber = () => {
    const randomStr = Math.random().toString(36).substring(2, 8).toUpperCase();
    return `ORD-${randomStr}`;
};

const form = useForm({
    customer_id: "",
    order_number: generateOrderNumber(),
    total_amount: "",
    status: "pending",
});

const submit = () => {
    form.post(route("orders.store"));
};
</script>

<template>
    <Head title="Create Order" />
    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto">
            <div
                class="bg-white shadow-sm sm:rounded-2xl p-8 border border-gray-100"
            >
                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">
                    Create New Order
                </h2>
                <OrderForm
                    :form="form"
                    :customers="customers"
                    @submit="submit"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
