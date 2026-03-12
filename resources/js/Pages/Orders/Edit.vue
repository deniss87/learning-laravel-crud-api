<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import OrderForm from "./Partials/OrderForm.vue";

const props = defineProps({
    order: Object,
    customers: Array,
});

const form = useForm({
    customer_id: props.order.customer_id,
    order_number: props.order.order_number,
    total_amount: props.order.total_amount,
    status: props.order.status,
});

const submit = () => {
    form.put(route("orders.update", props.order.id));
};
</script>

<template>
    <Head title="Edit Order" />
    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto">
            <div
                class="bg-white shadow-sm sm:rounded-2xl p-8 border border-gray-100"
            >
                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">
                    Edit Order
                </h2>
                <OrderForm
                    :form="form"
                    :customers="customers"
                    submitLabel="Update Order"
                    @submit="submit"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
