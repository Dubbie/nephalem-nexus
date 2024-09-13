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
        class="block relative bg-zinc-800 rounded-xl p-4 hover:ring-2 hover:ring-blue-500"
    >
        <p class="font-bold text-sm truncate">{{ build.name }}</p>

        <div class="flex items-center justify-between">
            <p class="text-zinc-500 font-semibold text-xs">
                {{ build.diablo_class.name }}
            </p>
            <p class="text-zinc-500 text-xs">By {{ build.author.name }}</p>
        </div>
    </Link>
</template>
