<script setup>
import { inject } from "vue";
import AppItem from "./AppItem.vue";

const emitter = inject("emitter");
const props = defineProps({
    larm: Object,
    rarm: Object,
    helm: Object,
    boot: Object,
    tors: Object,
    belt: Object,
    glov: Object,
    amul: Object,
    lrin: Object,
    rrin: Object,
});

const itemPositions = {
    larm: {
        top: "12%",
        left: "7%",
        width: "16.5%",
        height: "29%",
    },
    rarm: {
        top: "12%",
        left: "79%",
        width: "16.5%",
        height: "29%",
    },
    helm: {
        top: "1%",
        left: "42.5%",
        width: "16.5%",
        height: "14.5%",
    },
    tors: {
        top: "19.5%",
        left: "42.5%",
        width: "16.5%",
        height: "22%",
    },
    glov: {
        top: "46%",
        left: "7%",
        width: "16.5%",
        height: "14.5%",
    },
    boot: {
        top: "46%",
        left: "79%",
        width: "16.5%",
        height: "14.5%",
    },
    belt: {
        top: "46%",
        left: "42.5%",
        width: "16.5%",
        height: "6.75%",
    },
    lrin: {
        top: "46.5%",
        left: "29.5%",
        width: "24px",
        height: "24px",
    },
    rrin: {
        top: "46.5%",
        left: "65%",
        width: "24px",
        height: "24px",
    },
    amul: {
        top: "8.5%",
        left: "65%",
        width: "24px",
        height: "24px",
    },
};

const elements = [
    "larm",
    "rarm",
    "helm",
    "tors",
    "glov",
    "boot",
    "belt",
    "lrin",
    "rrin",
    "amul",
];

const handleUneqip = ($event, slot) => {
    $event.preventDefault();
    emitter.emit("unequip-item", slot);
};
</script>

<template>
    <div class="relative">
        <img src="/img/invchar.png" alt="" class="block rounded-xl" />

        <div
            v-for="element in elements"
            :key="element"
            class="absolute flex justify-center items-center"
            :style="itemPositions[element]"
        >
            <AppItem
                v-if="props[element]"
                :item="props[element]"
                @click.right="handleUneqip($event, element)"
            />
        </div>
    </div>
</template>
