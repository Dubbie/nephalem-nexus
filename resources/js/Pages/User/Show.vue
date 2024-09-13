<script setup>
import AppBadge from "@/Components/AppBadge.vue";
import AppDivider from "@/Components/AppDivider.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UserGuides from "./Partials/UserGuides.vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const getFormattedDate = (isoDate) => {
    const date = new Date(isoDate);

    // Format the date parts
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0"); // Months are zero-indexed
    const day = String(date.getDate()).padStart(2, "0");

    // Combine into the desired format
    return `${year}.${month}.${day}`;
};

const toTitleCase = (str) => {
    return str.replace(
        /\w\S*/g,
        (text) => text.charAt(0).toUpperCase() + text.substring(1).toLowerCase()
    );
};
</script>

<template>
    <AuthenticatedLayout :title="user.name">
        <div>
            <div class="flex space-x-4 items-start">
                <div>
                    <img
                        :src="user.profile_photo_url"
                        alt=""
                        class="size-12 rounded-lg"
                    />
                </div>
                <div>
                    <div class="flex space-x-2 items-center">
                        <p class="text-2xl font-bold">{{ user.name }}</p>
                        <AppBadge v-if="user.role !== 'USER'" color="green">{{
                            toTitleCase(user.role)
                        }}</AppBadge>
                    </div>
                    <p class="text-zinc-500 text-xs font-semibold">
                        Member since {{ getFormattedDate(user.created_at) }}
                    </p>
                </div>
            </div>
            <AppDivider class="my-6" />

            <UserGuides :builds="user.approved_builds" />
        </div>
    </AuthenticatedLayout>
</template>
