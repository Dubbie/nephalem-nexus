<script setup>
import { computed, onMounted, reactive, ref, watch } from "vue";
import AppSkill from "@/Components/AppSkill.vue";
import { IconCircleFilled } from "@tabler/icons-vue";
import SliderInput from "@/Components/SliderInput.vue";
import AppButton from "./AppButton.vue";

const props = defineProps({
    classData: Object,
    stackData: Array,
    readonly: {
        type: Boolean,
        default: false,
    },
});
const pointsFromQuests = 12;
const recording = ref(false);
const stack = ref(props.stackData);
const tempStack = ref([]);
const currentStep = ref(1);
const snapshot = ref(null);
const sliderKey = ref(0);

// Create a local copy of classData
const localClassData = reactive(JSON.parse(JSON.stringify(props.classData)));

const currentStack = computed(() => {
    if (!stack.value.length || !currentStep.value) {
        return localClassData;
    }

    // Create a snapshot of localClassData to modify
    let stackData = JSON.parse(JSON.stringify(localClassData));
    if (snapshot.value) {
        stackData = JSON.parse(JSON.stringify(snapshot.value));
    }

    // if Current step is 0, return the snapshot
    if (currentStep.value === 1) {
        return stackData;
    }

    // else if higher, go through each step and add up
    for (let i = 0; i <= currentStep.value - 2; i++) {
        const currentStackStep = stack.value[i];

        stackData.skill_categories.forEach((category) => {
            category.skills.forEach((skill) => {
                if (skill.id === currentStackStep.id) {
                    skill.level = currentStackStep.level;
                }
            });
        });
    }

    return stackData;
});

const skillCategories = computed(() => currentStack.value.skill_categories);

const maxPoints = computed(() => {
    const maxPointsByLevel = 98;

    return maxPointsByLevel + pointsFromQuests;
});

const pointsAllocated = computed(() => {
    let points = 0;

    skillCategories.value.forEach((category) => {
        category.skills.forEach((skill) => {
            if (skill.level) {
                points += skill.level;
            }
        });
    });

    return points;
});

const remainingPoints = computed(() => maxPoints.value - pointsAllocated.value);

const requiredLevel = computed(() => {
    let level = 1;

    skillCategories.value.forEach((category) => {
        category.skills.forEach((skill) => {
            if (skill.required_level > level && skill.level > 0) {
                level = skill.required_level;
            }
        });
    });

    // Compare level with points
    const freePoints = pointsFromQuests;
    const allocated = pointsAllocated.value;
    const allocatedWithoutFree = allocated - freePoints + 1;

    if (allocatedWithoutFree > level) {
        level = allocatedWithoutFree;
    }

    return level;
});

const maxRows = 6;
const maxCols = 3;
const bgImage = computed(() => ({
    backgroundImage: `url('/img/skills/${currentStack.value.name.toLowerCase()}/bg.png')`,
}));

const grids = computed(() => {
    const _grids = {};

    for (const category of skillCategories.value) {
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

const addPointTo = (skill) => {
    // Disable interaction if readonly
    if (props.readonly) {
        return;
    }

    const isAllocatable = canAllocateSkill(skill);
    const maxPointsReached = pointsAllocated.value >= maxPoints.value; // TODO: Check if max points reached

    if (isAllocatable && !maxPointsReached) {
        skill.level = (skill.level || 0) + 1;

        // Update the stack if recording
        if (recording.value) {
            addChangeToTempStack(skill);
        } else {
            // Check if recorded stack is not empty, if so, reset
            if (stack.value.length) {
                resetStack();
            }
        }
    }

    updateClassData();
};

const updateClassData = () => {
    emit("update:class-data", currentStack.value);
};

const removePointFrom = (event, skill) => {
    event.preventDefault();

    // Disable interaction if readonly
    if (props.readonly || recording.value) {
        return;
    }

    if (skill.level && skill.level > 0) {
        skill.level -= 1;
    }

    // Update the stack if recording
    if (recording.value) {
        addChangeToTempStack(skill);
    } else {
        // Check if recorded stack is not empty, if so, reset
        if (stack.value.length) {
            resetStack();
        }
    }

    updateClassData();
};

const findSkillById = (id) => {
    return skillCategories.value
        .flatMap((category) => category.skills)
        .find((skill) => skill.id === id);
};

const findSkillByCategoryAndPosition = (categoryId, row, col) => {
    return skillCategories.value
        .find((category) => category.id === categoryId)
        ?.skills.find((skill) => skill.row === row && skill.col === col);
};

const canAllocateSkill = (skill, ignoreMax = false) => {
    if (!skill) return false;

    // Check if skill has max already
    if (!ignoreMax && skill.level >= skill.max_level) return false;

    return checkPrerequisites(skill);
};

const checkPrerequisites = (skill) => {
    if (!skill.prerequisites || skill.prerequisites.length === 0) return true;
    return skill.prerequisites.every((pSkill) => {
        const prerequisite = findSkillById(pSkill.prerequisite_id);
        return prerequisite.level > 0 && checkPrerequisites(prerequisite);
    });
};

const startRecording = () => {
    recording.value = true;
    snapshot.value = JSON.parse(JSON.stringify(currentStack.value));
    tempStack.value = [];
    stack.value = [];
    currentStep.value = 1;
    Object.assign(localClassData, JSON.parse(JSON.stringify(snapshot.value)));
};

const stopRecording = () => {
    recording.value = false;
    currentStep.value = tempStack.value.length + 1;

    sendStackUpdate();
};

const addChangeToTempStack = (skill) => {
    tempStack.value.push({
        id: skill.id,
        level: skill.level,
    });
};

const sendStackUpdate = () => {
    if (tempStack.value.length) {
        stack.value = [...tempStack.value];

        // Notify parent
        emit("update:class-data", snapshot.value);
        emit("update:stack", stack.value);
    }
};

const toggleRecording = () => {
    // Disable interaction if readonly
    if (props.readonly) {
        return;
    }

    if (!recording.value) {
        startRecording();
    } else {
        stopRecording();
    }
};

// Handle changes when scrolling through stages
const resetStack = () => {
    Object.assign(
        localClassData,
        JSON.parse(JSON.stringify(currentStack.value))
    );
    snapshot.value = null;
    stack.value = [];
    tempStack.value = [];

    emit("update:stack", stack.value);
    emit("update:class-data", currentStack.value);
};

const resetTree = () => {
    let blank = localClassData;

    blank.skill_categories.forEach((category) => {
        category.skills.forEach((skill) => {
            skill.level = 0;
        });
    });

    Object.assign(localClassData, JSON.parse(JSON.stringify(blank)));
    stack.value = [];
    recording.value = false;
    snapshot.value = null;
    currentStep.value = 1;
};

const updateSliderKey = () => {
    sliderKey.value += 1;
};

const emit = defineEmits(["update:class-data", "update:stack"]);

// Update sliderKey when currentStep changes
watch(
    () => recording.value,
    () => {
        if (!recording.value) {
            updateSliderKey();
        }
    }
);

// Check if on mount we already have a stack
onMounted(() => {
    if (stack.value.length) {
        currentStep.value = stack.value.length + 1;
    }
});
</script>

<template>
    <div class="text-white builder-width">
        <div class="flex flex-col items-center">
            <div class="grid grid-cols-3">
                <div
                    v-for="skillCategory in skillCategories"
                    :key="skillCategory.id"
                    style="width: 231px"
                >
                    <p class="font-bold text-sm text-center mb-1">
                        {{ skillCategory.name }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-3" :style="bgImage">
                <div
                    v-for="skillCategory in skillCategories"
                    :key="skillCategory.id"
                >
                    <div class="flex flex-wrap relative skills-column">
                        <AppSkill
                            v-for="(cell, index) in grids[skillCategory.id]"
                            :key="index"
                            :skill="cell.skill"
                            :is-allocatable="canAllocateSkill(cell.skill, true)"
                            :class-name="currentStack.name"
                            :row="cell.row"
                            :col="cell.col"
                            @add="addPointTo(cell.skill)"
                            @remove="removePointFrom($event, cell.skill)"
                        />
                    </div>
                </div>
            </div>

            <div class="w-full flex items-center mt-2">
                <div
                    class="flex mr-6 items-center group cursor-pointer"
                    v-show="!readonly"
                >
                    <div
                        class="p-2 bg-transparent transition rounded-full group-hover:bg-red-500/30"
                    >
                        <IconCircleFilled class="size-4 text-red-500" />
                    </div>
                    <p class="text-sm font-bold" @click="toggleRecording">
                        {{
                            recording
                                ? "Stop recording"
                                : "Record skill progression"
                        }}
                    </p>
                </div>

                <div class="flex-1" v-show="!recording && stack.length">
                    <SliderInput
                        class="w-full"
                        v-model="currentStep"
                        :min="1"
                        :max="stack.length + 1"
                        :key="sliderKey"
                    />
                </div>
            </div>

            <div class="flex flex-col items-center mt-3">
                <p>
                    Remaining points: <b>{{ remainingPoints }}</b>
                </p>
                <p>
                    Required level: <b>{{ requiredLevel }}</b>
                </p>

                <AppButton
                    plain
                    @click="resetTree"
                    v-show="pointsAllocated > 1 && !readonly"
                    >Reset tree</AppButton
                >
            </div>
        </div>
    </div>
</template>

<style scoped>
.skills-column {
    margin: 16px 31px 28px 14px;
    width: 186px;
}

.builder-width {
    max-width: 693px;
}
</style>
