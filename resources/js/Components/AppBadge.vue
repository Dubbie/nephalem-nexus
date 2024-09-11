<script setup>
import { computed } from "vue";

const props = defineProps({
    color: {
        type: String,
        default: "blue",
    },
});

const colorClasses = computed(() => {
    return {
        blue: "bg-blue-400/15 text-blue-300",
        red: "bg-red-500/10 text-red-400",
        green: "bg-lime-400/15 text-green-300",
    }[props.color];
});
</script>

<template>
    <span
        class="inline-flex items-center gap-x-1.5 rounded-md px-1.5 py-0.5 text-sm/5 font-medium"
        :class="colorClasses"
    >
        <slot />
    </span>
</template>
