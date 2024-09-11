<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        default: false,
    },
    label: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link :href="href">
        <p
            class="font-semibold text-sm py-0.5"
            :class="{
                'text-white': active,
                'text-zinc-500 hover:text-zinc-300': !active,
            }"
        >
            {{ label }}
        </p>
    </Link>
</template>
