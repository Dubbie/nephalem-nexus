<script setup>
import AppButton from "@/Components/AppButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    build: Object,
});

const form = useForm({
    active: props.build.active,
});

const updateBuildStatus = () => {
    form.active = !props.build.active;

    form.post(route("build.update.status", props.build.id), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => form.reset(),
    });
};
</script>

<template>
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Guide editing
        </h2>

        <div class="flex">
            <AppButton
                plain
                color="red"
                class="mr-1"
                :href="route('build.preview', props.build.id)"
                >Delete</AppButton
            >
            <AppButton
                outline
                color="white"
                class="mr-4"
                :href="route('build.preview', props.build.id)"
                >Preview</AppButton
            >
            <AppButton
                @click="updateBuildStatus"
                :color="props.build.active ? 'red' : 'green'"
                :disabled="!props.build.is_complete"
                >{{
                    props.build.active ? "Hide Build Guide" : "Publish"
                }}</AppButton
            >
        </div>
    </div>
</template>
