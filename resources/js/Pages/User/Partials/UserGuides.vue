<script setup>
import BuildCard from "@/Components/BuildCard.vue";
import EmptyState from "@/Components/EmptyState.vue";

const props = defineProps({
    builds: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div>
        <p class="text-xl font-bold mb-3">Created Guides</p>

        <div v-if="builds.length > 0" class="grid grid-cols-4 gap-6">
            <BuildCard :build="build" v-for="build in builds" :key="build.id" />
        </div>
        <div v-else>
            <EmptyState
                title="No guides found"
                description="The user has no published guide yet."
            />
        </div>
    </div>
</template>
