<script setup>
import AppButton from "@/Components/AppButton.vue";
import EmptyState from "@/Components/EmptyState.vue";
import { usePage } from "@inertiajs/vue3";
import { IconExclamationMark } from "@tabler/icons-vue";
import { inject } from "vue";

const build = inject("build");
const props = defineProps({
    hideButton: {
        type: Boolean,
        default: false,
    },
});
const isAuthor = usePage().props.auth.user?.id === build.user_id;
</script>

<template>
    <div id="Introduction">
        <template v-if="build.introduction">
            <div
                v-html="build.introduction"
                class="guide-section-content prose prose-invert prose-zinc w-full"
            ></div>

            <div v-if="isAuthor && !hideButton" class="flex justify-end mt-6">
                <AppButton
                    outline
                    color="white"
                    size="xs"
                    :href="route('build.edit.introduction', build.id)"
                    >Edit Introduction</AppButton
                >
            </div>
        </template>
        <div v-else class="bg-white/5 p-6 rounded-2xl">
            <EmptyState
                title="No Introduction"
                description="Please add an introduction to your guide."
                :icon="IconExclamationMark"
            >
                <template #action>
                    <AppButton
                        outline
                        :href="route('build.edit.introduction', build.id)"
                        >Edit Introduction</AppButton
                    >
                </template>
            </EmptyState>
        </div>
    </div>
</template>
