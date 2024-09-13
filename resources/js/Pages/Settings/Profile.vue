<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ProfilePicture from "./Partials/ProfilePicture.vue";
</script>

<template>
    <AuthenticatedLayout title="Profile Settings">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Profile Settings
            </h2>
        </template>

        <div>
            <ProfilePicture />
        </div>
    </AuthenticatedLayout>
</template>
