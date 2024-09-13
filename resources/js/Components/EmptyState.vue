<script setup>
import { IconSearch } from "@tabler/icons-vue";

const props = defineProps({
    title: {
        type: String,
        default: "Not found",
    },
    description: {
        type: String,
        default: "There seems to be nothing here.",
    },
    icon: {
        type: Function,
        default: IconSearch,
    },
});
</script>

<template>
    <div class="flex flex-col items-center">
        <div class="relative mb-4">
            <div class="ring-1 ring-white/15 rounded-xl p-2.5">
                <component :is="icon" class="size-6 text-zinc-400" />
            </div>
        </div>

        <p class="text-lg font-semibold">{{ title }}</p>
        <p class="text-sm text-zinc-400">{{ description }}</p>

        <div v-if="$slots.action" class="mt-6 flex justify-between space-x-2">
            <slot name="action" />
        </div>
    </div>
</template>
