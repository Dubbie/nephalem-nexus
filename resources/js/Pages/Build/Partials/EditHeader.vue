<script setup>
import AppButton from "@/Components/AppButton.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { computed, inject, ref } from "vue";

const props = defineProps({
    build: {
        type: Object,
        required: true,
    },
});

const form = useForm({});
const showingInstructions = ref(false);
const emitter = inject("emitter");

const buttonLabel = computed(() => {
    switch (props.build.status) {
        case "draft":
        case "declined":
            return "Send for Approval";
        case "pending":
            return "Waiting for Approval";
        case "approved":
            return "Hide Build Guide";
        default:
            return "Unknown status (" + props.build.status + ")";
    }
});

const updateStatus = () => {
    form.post(route("build.update.status", props.build.id), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => form.reset(),
    });
};

const hasIntroduction = computed(() => {
    return props.build.introduction ? true : false;
});

const hasSkillTree = computed(() => {
    return props.build.skill_trees[0] ? true : false;
});

const btnDisabled = computed(() => {
    return !props.build.is_complete || props.build.status === "pending";
});

const btnColor = computed(() => {
    return props.build.status !== "approved" ? "green" : "blue";
});
</script>

<template>
    <div>
        <div class="flex justify-between">
            <h2
                class="font-semibold text-xl text-white leading-tight flex space-x-2 items-center"
            >
                <Link :href="route('build.own.index')">My Guides</Link>
                <span class="text-zinc-600">/</span>
                <span>Edit</span>
                <span class="text-zinc-600">/</span>
                <span>{{ props.build.name }}</span>
            </h2>

            <div class="flex">
                <AppButton
                    plain
                    color="red"
                    class="mr-1"
                    @click="
                        emitter.emit('open-delete-guide-modal', props.build)
                    "
                    >Delete</AppButton
                >
                <AppButton
                    outline
                    color="white"
                    class="mr-4"
                    :href="route('build.preview', props.build.id)"
                    >Preview</AppButton
                >
                <div class="relative">
                    <div
                        @mouseenter="showingInstructions = true"
                        @mouseleave="showingInstructions = false"
                    >
                        <AppButton
                            :color="btnColor"
                            :disabled="btnDisabled"
                            @click="updateStatus"
                            >{{ buttonLabel }}</AppButton
                        >
                    </div>

                    <transition
                        enter-active-class="transition transform origin-top-right ease-out duration-200"
                        enter-from-class="opacity-0 scale-90"
                        enter-to-class="opacity-100 scale-100"
                        leave-active-class="transition transform origin-top-right ease-in duration-150"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-90"
                    >
                        <div
                            v-if="!hasIntroduction || !hasSkillTree"
                            class="absolute top-full mt-2 right-0 bg-black/60 p-3 rounded-xl min-w-64"
                            v-show="showingInstructions"
                        >
                            <p class="text-xs mb-3">
                                In order to publish your build guide, you need
                                to fill out the following sections:
                            </p>
                            <p class="flex justify-between space-x-2 text-xs">
                                <span class="text-zinc-400">Introduction:</span>
                                <span
                                    class="text-right"
                                    :class="
                                        hasIntroduction
                                            ? 'text-green-500'
                                            : 'text-red-500'
                                    "
                                    >{{
                                        hasIntroduction ? "Complete" : "Missing"
                                    }}</span
                                >
                            </p>
                            <p class="flex justify-between space-x-2 text-xs">
                                <span class="text-zinc-400">Skill Tree:</span>
                                <span
                                    class="text-right"
                                    :class="
                                        hasSkillTree
                                            ? 'text-green-500'
                                            : 'text-red-500'
                                    "
                                    >{{
                                        hasSkillTree ? "Complete" : "Missing"
                                    }}</span
                                >
                            </p>
                        </div>
                    </transition>
                </div>
            </div>
        </div>

        <div v-if="build.status === 'declined'" class="mt-3 text-red-400">
            <p class="text-sm">This build has been declined.</p>
            <p class="text-sm">
                Reason: <b>{{ build.decline_reason }}</b>
            </p>
        </div>
    </div>
</template>
