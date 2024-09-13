<script setup>
import AppButton from "@/Components/AppButton.vue";
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
        <div
            v-else
            class="flex flex-col items-center border-2 border-red-500/30 rounded-xl py-20"
        >
            <div class="p-2 bg-red-500/15 text-red-400 rounded-full mb-6">
                <IconExclamationMark class="size-12" stroke-width="2" />
            </div>
            <p class="text-2xl text-white font-bold mb-2">No Introduction</p>
            <p class="text-zinc-400">
                It seems like you have not yet added an introduction.
            </p>
            <p class="text-zinc-400">
                To be able to activate your build guide, you need to add one.
            </p>

            <p class="text-zinc-500 text-sm mt-6 mb-1">
                Would you like to update it?
            </p>
            <AppButton
                color="white"
                :href="route('build.edit.introduction', build.id)"
                >Edit Introduction</AppButton
            >
        </div>
    </div>
</template>
