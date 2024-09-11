<script setup>
const props = defineProps({
    title: String,
});
</script>

<template>
    <h3 :id="title" class="text-2xl font-bold mb-6">{{ title }}</h3>
</template>
