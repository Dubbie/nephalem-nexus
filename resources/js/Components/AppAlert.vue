<script setup>
import { computed } from "vue";

const props = defineProps({
    color: {
        type: String,
        default: "zinc",
    },
    icon: {
        type: Function,
        default: null,
    },
});

const classes = computed(() => {
    return {
        blue: "bg-blue-500/15 text-blue-400",
        yellow: "bg-yellow-500/15 text-yellow-400",
        red: "bg-red-500/15 text-red-400",
        green: "bg-green-500/15 text-green-400",
        zinc: "bg-zinc-400/15 text-zinc-400",
    }[props.color];
});
</script>

<template>
    <div class="p-4 rounded-lg flex space-x-2" :class="classes">
        <div v-if="icon" class="shrink-0">
            <component :is="icon" class="size-5 shrink-0" />
        </div>
        <slot />
    </div>
</template>
