<script setup>
import SearchableSelect from "@/Components/SearchableSelect.vue";
import StatusSelect from "@/Components/StatusSelect.vue";
import { Link } from "@inertiajs/vue3";
import AppButton from "@/Components/AppButton.vue";

defineProps({
    form: Object,
    customers: Array,
    submitLabel: { type: String, default: "Save Order" },
});

defineEmits(["submit"]);
</script>

<template>
    <form @submit.prevent="$emit('submit')" class="space-y-6">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2"
                >Select Customer</label
            >
            <SearchableSelect
                v-model="form.customer_id"
                :options="customers"
                :error="form.errors.customer_id"
                placeholder="Start typing client name or email..."
            />
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2"
                >Order Number</label
            >
            <input
                v-model="form.order_number"
                type="text"
                :class="{
                    'border-red-500 focus:ring-red-500':
                        form.errors.order_number,
                }"
                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all uppercase"
            />
            <div
                v-if="form.errors.order_number"
                class="mt-1 text-xs text-red-500 font-medium"
            >
                {{ form.errors.order_number }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2"
                    >Total Amount (€)</label
                >
                <input
                    v-model="form.total_amount"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    :class="{
                        'border-red-500 focus:ring-red-500':
                            form.errors.total_amount,
                    }"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all"
                />
                <div
                    v-if="form.errors.total_amount"
                    class="mt-1 text-xs text-red-500 font-medium"
                >
                    {{ form.errors.total_amount }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2"
                    >Status</label
                >
                <StatusSelect
                    v-model="form.status"
                    :error="form.errors.status"
                />
            </div>
        </div>

        <div
            class="mt-12 pt-8 border-t border-gray-100 flex items-center justify-end space-x-6"
        >
            <Link
                :href="route('orders.index')"
                class="text-sm font-bold text-gray-500 hover:text-gray-600 transition-colors uppercase tracking-widest"
            >
                Cancel
            </Link>

            <AppButton type="submit" :disabled="form.processing">
                <span
                    v-if="form.processing"
                    class="animate-spin inline-block w-4 h-4 border-2 border-white/30 border-t-white rounded-full"
                ></span>
                {{ submitLabel }}
            </AppButton>
        </div>
    </form>
</template>
