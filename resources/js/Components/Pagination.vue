<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: Array,
});
</script>

<template>
    <div v-if="links.length > 3" class="flex flex-wrap gap-1">
        <Link
            v-for="(link, k) in links"
            :key="k"
            :href="link.url || ''"
            v-html="link.label"
            class="px-4 py-2 text-sm rounded-lg border transition-all"
            :class="{
                'bg-indigo-600 text-white border-indigo-600': link.active,
                'bg-white text-gray-600 border-gray-200 hover:bg-gray-50':
                    !link.active,
                'opacity-50 pointer-events-none': !link.url,
            }"
        />
    </div>
</template>
