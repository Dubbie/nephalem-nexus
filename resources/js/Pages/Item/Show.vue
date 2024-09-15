<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
});

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
    <Head title="Items" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Item details
            </h2>
        </template>

        <div>
            <div class="flex items-start space-x-3">
                <img
                    :src="`/data/global/png/${item.gfx}.png`"
                    :alt="item.name"
                />
                <div class="bg-black text-sm text-center p-3">
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
                        class="font-bold"
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

                    <ul class="mt-2">
                        <li v-for="stat in item.stats" class="text-blue-400">
                            {{ stat }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <code>
            <pre>{{ item }}</pre>
        </code>
    </AuthenticatedLayout>
</template>
