<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import MyBuildsTable from "./Partials/MyBuildsTable.vue";
import AppAlert from "@/Components/AppAlert.vue";
import AppButton from "@/Components/AppButton.vue";
import { inject } from "vue";

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
                <AppAlert>
                    <div class="text-sm">
                        <p class="text-white text-3xl font-bold mb-6">
                            You have no guides yet.
                        </p>
                        <p class="mb-2">
                            Would you like to make a new one now?
                        </p>
                        <AppButton
                            color="blue"
                            @click="emitter.emit('open-new-guide-modal')"
                        >
                            New Guide
                        </AppButton>
                    </div>
                </AppAlert>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
