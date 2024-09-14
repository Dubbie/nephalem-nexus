<script setup>
import { IconExclamationMark } from "@tabler/icons-vue";
import { inject, onBeforeMount, ref } from "vue";
import BuildSectionTitle from "./BuildSectionTitle.vue";
import AppButton from "@/Components/AppButton.vue";
import AppBuilder from "@/Components/AppBuilder.vue";
import EmptyState from "@/Components/EmptyState.vue";
import { usePage } from "@inertiajs/vue3";

const props = defineProps({
    hideButton: {
        type: Boolean,
        default: false,
    },
});
const build = inject("build");
const skillTree = ref(null);
const stack = ref([]);
const isAuthor = usePage().props.auth.user?.id === build.user_id;

const getSkillTreeData = () => {
    if (build.skill_trees.length === 0) {
        return null;
    }

    if (build.skill_trees.length > 0) {
        const skillTreeData = build.skill_trees[0];
        const baseSkillData = skillTreeData.base_skills;

        // Load tree
        skillTree.value = build.diablo_class;

        // Add skills
        skillTree.value.skill_categories.map((category) => {
            category.skills.map((skill) => {
                const baseSkill = findObjectById(baseSkillData, skill.id);

                if (baseSkill) {
                    skill.level = baseSkill.level;
                }
            });
        });

        // Load stack
        stack.value = skillTreeData.skill_changes.map((skill) => {
            return {
                id: skill.skill_id,
                level: skill.level,
            };
        });
    }
};

const findObjectById = (arr, id) => {
    return arr.find((obj) => obj.id === id);
};

onBeforeMount(() => {
    getSkillTreeData();
});
</script>

<template>
    <div id="Skill Tree">
        <BuildSectionTitle title="Skill Tree" />
        <div v-if="build.skill_trees.length > 0">
            <div class="w-full">
                <div class="p-4 bg-zinc-950 rounded-xl">
                    <AppBuilder
                        class="mx-auto"
                        readonly
                        :class-data="skillTree"
                        :stack-data="stack"
                    />
                </div>
                <p class="text-sm text-center text-zinc-500 mt-3">
                    Skill trees assume you have done all quests granting extra
                    skill points.
                </p>
            </div>

            <div
                v-html="build.skill_trees[0].description"
                class="guide-section-content prose prose-invert prose-zinc mt-6"
            ></div>

            <div v-if="isAuthor && !hideButton" class="flex justify-end mt-6">
                <AppButton
                    outline
                    color="white"
                    size="xs"
                    :href="route('build.edit.skill-tree', build.id)"
                    >Edit Skill Tree</AppButton
                >
            </div>
        </div>
        <div v-else class="bg-white/5 p-6 rounded-2xl">
            <EmptyState
                title="No skill Tree"
                description="Please set up a skill tree for your guide."
                :icon="IconExclamationMark"
            >
                <template #action>
                    <AppButton
                        outline
                        :href="route('build.edit.skill-tree', build.id)"
                        >Edit Skill Tree</AppButton
                    >
                </template>
            </EmptyState>
        </div>
    </div>
</template>
