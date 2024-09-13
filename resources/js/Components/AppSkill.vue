<script setup>
import { computed, ref } from "vue";

const showingTooltip = ref(false);

const props = defineProps({
    skill: {
        type: Object,
        default: null,
    },
    row: {
        type: Number,
        required: true,
    },
    col: {
        type: Number,
        required: true,
    },
    className: {
        type: String,
        required: true,
    },
    isAllocatable: {
        type: Boolean,
        required: true,
    },
    readOnly: {
        type: Boolean,
        default: false,
    },
});

const isSkill = computed(() => {
    return props.skill !== null;
});

const getSpacing = () => {
    let spacing = {};

    switch (props.col) {
        case 0:
            spacing["margin-left"] = `0px`;
            break;
        case 1:
            spacing["margin-left"] = `21px`;
            break;
        case 2:
            spacing["margin-left"] = `21px`;
            break;
        default:
            break;
    }

    switch (props.row) {
        case 0:
            spacing["margin-top"] = `0px`;
            break;
        case 1:
            spacing["margin-top"] = `20px`;
            break;
        case 2:
            spacing["margin-top"] = `20px`;
            break;
        case 3:
            spacing["margin-top"] = `20px`;
            break;
        case 4:
            spacing["margin-top"] = `20px`;
            break;
        case 5:
            spacing["margin-top"] = `20px`;
            break;
        default:
            break;
    }

    return spacing;
};

const emit = defineEmits(["add", "remove"]);
</script>

<template>
    <div class="relative flex-none">
        <div
            v-if="isSkill"
            class="skill select-none"
            @click.left="$emit('add')"
            @click.right="$emit('remove', $event)"
            @mouseleave="showingTooltip = false"
            :style="getSpacing()"
        >
            <img
                :src="`/img/skills/${className.toLowerCase()}/${
                    skill.name
                }.png`"
                :alt="`${skill.name} icon`"
                :class="{
                    'opacity-0': showingTooltip || !isAllocatable,
                }"
                @mouseenter="showingTooltip = true"
            />

            <div
                v-show="showingTooltip"
                class="absolute inset-0 opacity-100 mix-blend-overlay"
                :class="{
                    'bg-red-500': !isAllocatable,
                    'bg-blue-500': isAllocatable,
                }"
                :style="getSpacing()"
            ></div>

            <transition
                enter-active-class="transition-all ease-out duration-100"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-all ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    class="p-3 absolute top-full translate-y-3 left-1/2 -translate-x-1/2 min-w-32 bg-black text-white z-20"
                    v-show="showingTooltip"
                >
                    <p
                        class="text-sm text-green-500 font-bold tracking-tighter"
                    >
                        {{ skill.name }}
                    </p>
                    <p class="text-sm">
                        Req. level: {{ skill.required_level }}
                    </p>
                </div>
            </transition>

            <div
                class="skill-level font-bold text-sm absolute bottom-0 right-0 text-white flex rounded-lg size-5 justify-center"
                v-if="skill.level && skill.level > 0"
            >
                <p :class="!isAllocatable ? 'text-red-500' : ''">
                    {{ skill.level }}
                </p>
            </div>
        </div>
        <div v-else class="empty-skill" :style="getSpacing()"></div>
    </div>
</template>

<style scoped>
.skill {
    transition: transform 0.2s;
    max-height: 48px;
    max-width: 48px;
    min-height: 48px;
    min-width: 48px;
}

.empty-skill {
    min-height: 48px;
    min-width: 48px;
    max-width: 48px;
    max-height: 48px;
}

.skill-level {
    transform: translate(16px, 15px);
}
</style>
