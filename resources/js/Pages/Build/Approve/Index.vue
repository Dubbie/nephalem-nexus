<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import AppAlert from "@/Components/AppAlert.vue";
import { inject } from "vue";
import ApproveList from "./Partials/ApproveList.vue";
import EmptyState from "@/Components/EmptyState.vue";
import { IconCheck } from "@tabler/icons-vue";

const props = defineProps({
    builds: Array,
});

const emitter = inject("emitter");
</script>

<template>
    <Head title="Waiting for Approval" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Waiting for Approval
            </h2>
        </template>

        <div>
            <div v-if="props.builds.length">
                <ApproveList :builds="props.builds" />
            </div>
            <div v-else>
                <EmptyState
                    :icon="IconCheck"
                    title="No guides waiting for approval"
                    description="There are no guides waiting for approval."
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
