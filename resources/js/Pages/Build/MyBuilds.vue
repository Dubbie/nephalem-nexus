<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditSidebar from "./Partials/EditSidebar.vue";
import { Head } from "@inertiajs/vue3";
import MyBuildsTable from "./Partials/MyBuildsTable.vue";

const props = defineProps({
    builds: Array,
});
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
        </div>
    </AuthenticatedLayout>
</template>
