<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    build: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="route('build.show', build)"
        class="block relative bg-zinc-900 rounded-xl p-4 ring-1 ring-white/10 hover:ring-2 hover:ring-blue-500 overflow-hidden"
    >
        <img
            :src="`/img/${build.diablo_class.name.toLowerCase()}.png`"
            :alt="build.diablo_class.name"
            class="absolute top-0 right-0 opacity-40 transform transition-all ease-in-out group-hover:opacity-70 group-hover:scale-105"
        />

        <div class="relative">
            <p class="font-bold text-sm truncate mb-1">
                {{ build.name }}
            </p>

            <p class="text-white/50 font-semibold text-xs">
                {{ build.diablo_class.name }}
            </p>
        </div>
    </Link>
</template>
