<script setup>
import { IconExclamationCircleFilled } from "@tabler/icons-vue";
import AppAlert from "./AppAlert.vue";

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    reason: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <AppAlert color="red" :icon="IconExclamationCircleFilled">
        <div class="text-sm">
            <p class="font-bold">{{ name }} has declined your guide.</p>

            <p class="mt-3 text-xs">Reason:</p>
            <p>{{ reason }}</p>
        </div>
    </AppAlert>
</template>
