<script setup>
import { IconExclamationMark, IconInfoCircleFilled } from "@tabler/icons-vue";
import { inject, onBeforeMount, ref } from "vue";
import BuildSectionTitle from "./BuildSectionTitle.vue";
import AppButton from "@/Components/AppButton.vue";
import AppBuilder from "@/Components/AppBuilder.vue";
import AppAlert from "@/Components/AppAlert.vue";
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
        <div
            v-else
            class="flex flex-col items-center border-2 border-red-500/30 rounded-xl py-20"
        >
            <div class="p-2 bg-red-500/15 text-red-400 rounded-full mb-6">
                <IconExclamationMark class="size-12" stroke-width="2" />
            </div>
            <p class="text-2xl text-white font-bold mb-2">No skill tree</p>
            <p class="text-zinc-400">
                It seems like you have not yet added the skill tree.
            </p>
            <p class="text-zinc-400">
                To be able to activate your build guide, you need to add one.
            </p>

            <p class="text-zinc-500 text-sm mt-6 mb-1">
                Would you like to update it?
            </p>
            <AppButton
                color="white"
                :href="route('build.edit.skill-tree', build.id)"
                >Edit Skill Tree</AppButton
            >
        </div>
    </div>
</template>
