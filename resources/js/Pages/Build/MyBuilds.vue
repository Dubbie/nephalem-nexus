<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import MyBuildsTable from "./Partials/MyBuildsTable.vue";
import AppAlert from "@/Components/AppAlert.vue";
import AppButton from "@/Components/AppButton.vue";
import { inject } from "vue";
import EmptyState from "@/Components/EmptyState.vue";

const props = defineProps({
    builds: Array,
});

const emitter = inject("emitter");
</script>

<template>
    <Head title="My Guides" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                My Guides
            </h2>
        </template>

        <div>
            <div v-if="props.builds.length">
                <MyBuildsTable :builds="props.builds" />
            </div>
            <div v-else>
                <EmptyState
                    title="No guides found"
                    description="It seems like you don't have any guides yet."
                >
                    <template #action>
                        <AppButton
                            color="blue"
                            @click="emitter.emit('open-new-guide-modal')"
                            >Create Guide</AppButton
                        >
                    </template>
                </EmptyState>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
