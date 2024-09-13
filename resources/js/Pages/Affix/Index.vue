<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    affixes: Array,
});

console.log(props.affixes[0]);
</script>

<template>
    <Head title="Items" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Affixes
            </h2>
        </template>

        <div class="space-y-6">
            <div
                v-for="affix in affixes"
                :key="affix.id"
                class="grid grid-cols-2 gap-6"
            >
                <div>
                    <p>{{ affix.name }}</p>
                </div>
                <div>
                    <p v-for="line in affix.display_values" :key="line">
                        {{ line }}
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
