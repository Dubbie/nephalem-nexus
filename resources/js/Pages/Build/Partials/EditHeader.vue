<script setup>
import AppButton from "@/Components/AppButton.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { computed, inject } from "vue";

const props = defineProps({
    build: {
        type: Object,
        required: true,
    },
});

const form = useForm({});

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
                <div class="flex items-center space-x-6">
                    <AppButton
                        @click="updateStatus"
                        :color="
                            props.build.status === 'approved' ? 'blue' : 'green'
                        "
                        :disabled="
                            !props.build.is_complete ||
                            props.build.status === 'pending'
                        "
                        >{{ buttonLabel }}</AppButton
                    >
                    <div v-if="!hasIntroduction || !hasSkillTree">
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
