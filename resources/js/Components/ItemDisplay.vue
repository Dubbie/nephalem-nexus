<script setup>
import { ref } from "vue";

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
});

const showingTooltip = ref(false);

const itemNameColor = () => {
    switch (props.item.rarity) {
        case "unique":
            return "rgb(199, 179, 119)";
        default:
            return "rgb(255, 255, 255)";
    }
};
</script>

<template>
    <div class="relative flex flex-col justify-center items-center">
        <img
            :src="`/data/global/png/${item.gfx}.png`"
            :alt="item.name"
            class="p-4"
            @mouseenter="showingTooltip = true"
            @mouseleave="showingTooltip = false"
        />
        <div
            class="bg-black text-sm text-center p-3 mt-2 absolute top-full left-1/2 -translate-x-1/2 z-20 backdrop-blur"
            :style="{
                minWidth: '200px',
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
            }"
            v-show="showingTooltip"
        >
            <div class="whitespace-nowrap">
                <p
                    class="font-bold"
                    :style="{
                        color: itemNameColor(),
                    }"
                    v-if="item.name"
                >
                    {{ item.name }}
                </p>
                <p
                    class="font-bold mb-1"
                    :style="{
                        color: itemNameColor(),
                    }"
                >
                    {{ item.base_name }}
                </p>
                <p v-if="item.min_ac">
                    Defense:
                    <span class="text-blue-400"
                        >{{ item.min_ac }} - {{ item.max_ac }}</span
                    >
                </p>
                <p v-if="item.level_requirement">
                    Required Level:
                    <span class="text-blue-400">{{
                        item.level_requirement
                    }}</span>
                </p>
                <p v-if="item.required_strength">
                    Required Strength:
                    <span class="text-blue-400">{{
                        item.required_strength
                    }}</span>
                </p>
                <p v-if="item.required_dexterity">
                    Required Dexterity:
                    <span class="text-blue-400">{{
                        item.required_dexterity
                    }}</span>
                </p>
            </div>

            <ul class="mt-2">
                <li v-for="stat in item.stats" class="text-blue-400">
                    {{ stat }}
                </li>
            </ul>
        </div>
    </div>
</template>
