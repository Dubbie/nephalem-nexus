<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});
</script>

<template>
    <span class="relative">
        <span
            class="absolute inset-x-2 -bottom-2 5 h-0.5 rounded-full bg-white"
            :class="{
                'opacity-0': !active,
                'opacity-100': active,
            }"
        ></span>
        <Link
            :href="href"
            class="rleative flex min-w-0 items-center gap-3 rounded-lg p-2 text-white text-left text-base/6 font-medium hover:bg-white/5"
            :class="{
                '': active,
            }"
        >
            <slot />
        </Link>
    </span>
</template>
