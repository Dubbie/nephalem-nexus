<script setup>
import AppButton from "@/Components/AppButton.vue";
</script>

<template>
    <div class="flex items-center gap-3">
        <AppButton color="blue" :href="route('login')">Log In</AppButton>
    </div>
</template>
