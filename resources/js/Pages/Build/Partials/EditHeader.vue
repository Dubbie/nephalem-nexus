<script setup>
import AppButton from "@/Components/AppButton.vue";
import { useForm } from "@inertiajs/vue3";
import { inject } from "vue";

const props = defineProps({
    build: Object,
});

const form = useForm({
    active: props.build.active,
});

const emitter = inject("emitter");

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
        <h2
            class="font-semibold text-xl text-white leading-tight flex space-x-2 items-center"
        >
            <span>Guide editing</span>
            <span class="text-zinc-600">/</span>
            <span>{{ props.build.name }}</span>
        </h2>

        <div class="flex">
            <AppButton
                plain
                color="red"
                class="mr-1"
                @click="emitter.emit('open-delete-guide-modal', props.build)"
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
