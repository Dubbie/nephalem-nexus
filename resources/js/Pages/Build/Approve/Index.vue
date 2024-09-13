<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import AppAlert from "@/Components/AppAlert.vue";
import { inject } from "vue";
import ApproveList from "./Partials/ApproveList.vue";

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
                <AppAlert>
                    <div class="text-sm">
                        <p class="text-white text-3xl font-bold mb-6">
                            You have no guides waiting to approve!
                        </p>
                        <p class="mb-2">
                            You did good. Be sure to check back later.
                        </p>
                    </div>
                </AppAlert>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
