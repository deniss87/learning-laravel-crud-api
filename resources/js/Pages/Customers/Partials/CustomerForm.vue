<script setup>
defineProps({
    form: Object,
    submitLabel: {
        type: String,
        default: "Save",
    },
});

defineEmits(["submit"]);
</script>

<template>
    <form @submit.prevent="$emit('submit')" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2"
                    >First Name</label
                >
                <input
                    v-model="form.first_name"
                    type="text"
                    :class="{
                        'border-red-500 focus:ring-red-500':
                            form.errors.first_name,
                    }"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all"
                />
                <div
                    v-if="form.errors.first_name"
                    class="mt-1 text-xs text-red-500 font-medium"
                >
                    {{ form.errors.first_name }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2"
                    >Last Name</label
                >
                <input
                    v-model="form.last_name"
                    type="text"
                    :class="{
                        'border-red-500 focus:ring-red-500':
                            form.errors.last_name,
                    }"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all"
                />
                <div
                    v-if="form.errors.last_name"
                    class="mt-1 text-xs text-red-500 font-medium"
                >
                    {{ form.errors.last_name }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2"
                    >Email Address</label
                >
                <input
                    v-model="form.email"
                    type="email"
                    :class="{
                        'border-red-500 focus:ring-red-500': form.errors.email,
                    }"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all"
                />
                <div
                    v-if="form.errors.email"
                    class="mt-1 text-xs text-red-500 font-medium"
                >
                    {{ form.errors.email }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2"
                    >Phone Number</label
                >
                <input
                    v-model="form.phone"
                    type="tel"
                    @input="
                        form.phone = form.phone.replace(/[^0-9\s\-\+\(\)]/g, '')
                    "
                    :class="{
                        'border-red-500 focus:ring-red-500': form.errors.phone,
                    }"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all"
                />
                <div
                    v-if="form.errors.phone"
                    class="mt-1 text-xs text-red-500 font-medium"
                >
                    {{ form.errors.phone }}
                </div>
            </div>
        </div>

        <div
            class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-50"
        >
            <slot name="actions-left" />
            <button
                type="submit"
                :disabled="form.processing"
                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-md hover:bg-indigo-700 transition-all"
            >
                {{ form.processing ? "Saving..." : submitLabel }}
            </button>
        </div>
    </form>
</template>
