<script setup>
import { ref, computed } from "vue";
import AppSkill from "@/Components/AppSkill.vue";

const { amazon } = defineProps(["amazon"]);
const skillCategories = amazon.skill_categories;
const maxRows = 6;
const maxCols = 3;

const grids = computed(() => {
    const _grids = {};

    for (const category of skillCategories) {
        const categoryArray = [];

        for (let row = 0; row < maxRows; row++) {
            for (let col = 0; col < maxCols; col++) {
                const skill = findSkillByCategoryAndPosition(
                    category.id,
                    row,
                    col
                );

                categoryArray.push({
                    row,
                    col,
                    isSkill: !!skill,
                    skill,
                });
            }
        }

        _grids[category.id] = categoryArray;
    }

    return _grids;
});

const getGridPosition = (cell) => {
    return {
        "grid-row": cell.row + 1,
        "grid-column": cell.col + 1,
    };
};

const characterLevel = computed(() => {
    let points = 1;

    skillCategories.forEach((category) => {
        category.skills.forEach((skill) => {
            if (skill.level) {
                points += skill.level;
            }
        });
    });

    return points;
});

const addPointTo = (skill) => {
    if (skill.required_level <= characterLevel.value) {
        if (!skill.level) {
            skill.level = 1;
        } else {
            skill.level += 1;
        }
    }
};

const removePointFrom = (event, skill) => {
    event.preventDefault();

    if (skill.level && skill.level > 0) {
        skill.level -= 1;
    } else {
        skill.level = 0;
    }
};

const findSkillById = (id) => {
    return skillCategories
        .flatMap((category) => category.skills)
        .find((skill) => skill.id === id);
};

const findSkillByCategoryAndPosition = (categoryId, row, col) => {
    return skillCategories
        .find((category) => category.id === categoryId)
        .skills.find((skill) => skill.row === row && skill.col === col);
};

function canAllocateSkill(skill, characterLevel) {
    // Early return if skill is not defined
    if (!skill) return false;

    // Check if the character's level meets the skill's level requirement
    if (skill.required_level > characterLevel.value) return false;

    // Recursively check prerequisites
    return checkPrerequisites(skill);
}

function checkPrerequisites(skill) {
    // No prerequisites, so the skill can be allocated
    if (!skill.prerequisites || skill.prerequisites.length === 0) return true;

    // Check each prerequisite recursively
    return skill.prerequisites.every((pSkill) => {
        const prerequisite = findSkillById(pSkill.prerequisite_id);
        return prerequisite.level > 0 && checkPrerequisites(prerequisite);
    });
}
</script>

<template>
    <div class="bg-zinc-900 text-white min-h-svh">
        <div class="p-20">
            <div class="mb-10 text-center">
                <h1 class="text-4xl font-bold">Amazon Planner</h1>
                <p>
                    Character Level:
                    <span class="font-bold">{{ characterLevel }}</span>
                </p>
            </div>

            <div class="flex justify-center">
                <div class="grid grid-cols-3 gap-4">
                    <div
                        v-for="skillCategory in skillCategories"
                        :key="skillCategory.id"
                        class="bg-zinc-600 p-2 rounded-xl"
                    >
                        <p class="text-lg font-bold text-center mb-3">
                            {{ skillCategory.name }}
                        </p>

                        <div
                            class="grid grid-cols-3 auto-rows-min gap-4 relative"
                        >
                            <AppSkill
                                v-for="(cell, index) in grids[skillCategory.id]"
                                :key="index"
                                :skill="cell.skill"
                                :is-allocatable="
                                    canAllocateSkill(cell.skill, characterLevel)
                                "
                                @add="addPointTo(cell.skill)"
                                @remove="removePointFrom($event, cell.skill)"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
