<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditSidebar from "./Partials/EditSidebar.vue";
import { Head, useForm } from "@inertiajs/vue3";
import AppBuilder from "@/Components/AppBuilder.vue";
import AppButton from "@/Components/AppButton.vue";
import { onBeforeMount } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import EditHeader from "./Partials/EditHeader.vue";
import EditorInput from "@/Components/EditorInput.vue";

const props = defineProps({
    build: Object,
    classData: {
        type: Object,
        required: true,
    },
    skillTrees: {
        type: Array,
        default: [],
    },
});

const form = useForm({
    description: "",
    base_tree: props.classData,
    stack: [],
});

const handleClassDataUpdate = (data) => {
    form.base_tree = data;
};

const handleStackUpdate = (data) => {
    form.stack = data;
};

const submit = () => {
    form.post(route("build.update.skill-tree", props.build.id), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => form.reset(),
    });
};

const findObjectById = (arr, id) => {
    return arr.find((obj) => obj.id === id);
};

onBeforeMount(() => {
    // Check for build skill tree
    if (props.build.skill_trees.length > 0) {
        const skillTreeData = props.build.skill_trees[0];
        const baseSkillData = skillTreeData.base_skills;

        // Load the notes section
        form.description = skillTreeData.description;

        // Load tree
        form.base_tree = props.classData;

        // Add skills
        form.base_tree.skill_categories.map((category) => {
            category.skills.map((skill) => {
                const baseSkill = findObjectById(baseSkillData, skill.id);

                if (baseSkill) {
                    skill.level = baseSkill.level;
                }
            });
        });

        // Load stack
        form.stack = skillTreeData.skill_changes.map((skill) => {
            return {
                id: skill.skill_id,
                level: skill.level,
            };
        });
    }
});
</script>

<template>
    <Head title="Edit Build" />

    <AuthenticatedLayout>
        <template #header>
            <EditHeader :build="props.build" />
        </template>

        <div class="grid grid-cols-4">
            <EditSidebar :build="props.build" />

            <div class="col-span-3 space-y-3">
                <div>
                    <h3 class="text-xl font-bold mb-1">Skill tree</h3>
                    <p class="text-sm text-zinc-400 mb-6">
                        Edit the skill tree progression the users can follow.
                    </p>
                </div>

                <div class="bg-zinc-950 py-4 rounded-lg">
                    <AppBuilder
                        class="mx-auto"
                        :class-data="form.base_tree"
                        :stack-data="form.stack"
                        @update:class-data="handleClassDataUpdate"
                        @update:stack="handleStackUpdate"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="skill_notes" value="Skill notes" />
                    <EditorInput
                        id="skill_notes"
                        v-model="form.description"
                        class="mt-1 block w-full"
                    />
                </div>

                <div class="mt-4">
                    <AppButton
                        color="white"
                        @click="submit"
                        :disabled="form.processing"
                        >Save Skill Tree & Notes</AppButton
                    >
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
