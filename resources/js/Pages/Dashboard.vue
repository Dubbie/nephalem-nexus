<script setup>
import PageTitle from "@/Components/PageTitle.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <PageTitle>Dashboard</PageTitle>
        </template>

        <p>You're logged in!</p>
    </AuthenticatedLayout>
</template>
