<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full rounded-lg px-3 py-1.5 text-start text-sm font-bold leading-5 text-white hover:bg-indigo-600 focus:outline-none focus:bg-zinc-700"
    >
        <slot />
    </Link>
</template>
