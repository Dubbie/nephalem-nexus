<script setup>
import AppBadge from "@/Components/AppBadge.vue";
import AppButton from "@/Components/AppButton.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { inject } from "vue";

const props = defineProps({
    builds: Array,
});

const form = useForm({});
const emitter = inject("emitter");

const thClasses =
    "px-4 py-2 border-b border-white/10 text-sm/6 font-medium first:pl-0 last:pr-0";
const tdClasses =
    "px-4 py-2 border-b border-white/5 text-sm/6 first:pl-0 last:pr-0";

const getFormattedDate = (isoDate) => {
    const date = new Date(isoDate);

    // Format the date parts
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0"); // Months are zero-indexed
    const day = String(date.getDate()).padStart(2, "0");

    // Format the time parts
    const hours = String(date.getHours()).padStart(2, "0");
    const minutes = String(date.getMinutes()).padStart(2, "0");
    const seconds = String(date.getSeconds()).padStart(2, "0");

    // Combine into the desired format
    return `${year}.${month}.${day} ${hours}:${minutes}:${seconds}`;
};

const approve = (build) => {
    const form = useForm({});

    form.post(route("build.approve", build));
};

const getStatusColor = (status) => {
    switch (status) {
        case "draft":
            return "zinc";
        case "pending":
            return "blue";
        case "approved":
            return "green";
        case "declined":
            return "red";
        default:
            return "zinc";
    }
};

const toTitleCase = (str) => {
    return str.replace(
        /\w\S*/g,
        (text) => text.charAt(0).toUpperCase() + text.substring(1).toLowerCase()
    );
};
</script>

<template>
    <table class="w-full">
        <thead class="text-zinc-400">
            <tr>
                <th class="text-left" :class="thClasses">Name</th>
                <th class="text-left" :class="thClasses">Class</th>
                <th class="text-center" :class="thClasses">Updated at</th>
                <th class="text-center" :class="thClasses">Status</th>
                <th class="text-center" :class="thClasses">Author</th>
                <th :class="thClasses"></th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="build in builds">
                <td class="text-left" :class="tdClasses">
                    <Link :href="route('build.show', build)">
                        <p class="font-semibold">{{ build.name }}</p>
                    </Link>
                </td>

                <td class="text-left" :class="tdClasses">
                    <p>{{ build.diablo_class.name }}</p>
                </td>

                <td class="text-center" :class="tdClasses">
                    <p class="text-zinc-500">
                        {{ getFormattedDate(build.updated_at) }}
                    </p>
                </td>

                <td class="text-center" :class="tdClasses">
                    <AppBadge :color="getStatusColor(build.status)">
                        {{ toTitleCase(build.status) }}
                    </AppBadge>
                </td>

                <td class="text-center" :class="tdClasses">
                    <p>{{ build.author.name }}</p>
                </td>

                <td class="flex justify-end space-x-3" :class="tdClasses">
                    <AppButton
                        outline
                        color="red"
                        :disabled="form.processing"
                        @click="emitter.emit('open-decline-guide-modal', build)"
                        >Decline</AppButton
                    >
                    <AppButton
                        color="green"
                        @click="approve(build)"
                        :disabled="form.processing"
                        >Approve</AppButton
                    >
                </td>
            </tr>
        </tbody>
    </table>
</template>
