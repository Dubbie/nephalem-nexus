<script setup>
import { computed, ref } from "vue";

const props = defineProps({
    item: Object,
});

const showTooltip = ref(false);

const speedClass = computed(() => {
    if (props.item.weapon) {
        const speed =
            props.item.weapon.speed !== null
                ? parseInt(props.item.weapon.speed)
                : 0;

        if (speed <= -20) {
            return "Very Fast Attack Speed";
        } else if (speed <= -10) {
            return "Fast Attack Speed";
        } else if (speed >= 0) {
            return "Normal Attack Speed";
        } else if (speed >= 10) {
            return "Slow Attack Speed";
        } else if (speed >= 20) {
            return "Very Slow Attack Speed";
        }
    }

    return null;
});
</script>

<template>
    <div class="relative flex justify-center items-center">
        <div class="relative group">
            <div
                class="absolute inset-0 bg-black/30 rounded-xl group-hover:bg-yellow-700/15"
            ></div>
            <img
                :src="item.images.base"
                :alt="item.name"
                class="relative z-10 py-2 px-1"
                @mouseenter="showTooltip = true"
                @mouseleave="showTooltip = false"
            />

            <div
                class="absolute top-full translate-y-2 left-1/2 -translate-x-1/2 z-20 bg-black rounded-xl p-2 whitespace-nowrap text-center"
                v-show="showTooltip"
            >
                <p class="font-bold">{{ item.name }}</p>
                <p class="text-zinc-400 text-sm" v-if="item.weapon">
                    {{ item.weapon.damage_type }}:
                    <span class="text-white">{{
                        item.weapon.damage_range
                    }}</span>
                </p>
                <p
                    class="text-zinc-400 text-sm"
                    v-show="item?.weapon.required_strength > 0"
                >
                    Required Strength:
                    <span class="text-white">{{
                        item.weapon.required_strength
                    }}</span>
                </p>
                <p
                    class="text-zinc-400 text-sm"
                    v-show="item?.weapon.required_dexterity > 0"
                >
                    Required Dexterity:
                    <span class="text-white">{{
                        item.weapon.required_dexterity
                    }}</span>
                </p>
                <p
                    class="text-zinc-400 text-sm"
                    v-show="item.level_requirement > 0"
                >
                    Required Level:
                    <span class="text-white">{{ item.level_requirement }}</span>
                </p>
                <p class="text-zinc-400 text-sm">
                    <span>{{ item.detailed_type }}</span>
                    <span v-if="speedClass"> - {{ speedClass }}</span>
                </p>
                <p v-if="item.max_sockets > 0" class="text-zinc-400 text-sm">
                    Maximum Sockets:
                    <span class="text-white">[{{ item.max_sockets }}]</span>
                </p>

                <p v-if="item?.weapon.has_splash" class="text-blue-400 text-sm">
                    Melee Attacks Deal Splash Damage
                </p>

                <ul>
                    <li
                        v-for="property in item.property_values"
                        :key="property.id"
                    >
                        {{ property.property_stat.stat }}:
                        {{ property.value }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
