<script setup>
import AppBadge from "@/Components/AppBadge.vue";
import { Link } from "@inertiajs/vue3";
import { IconMaximize, IconPencil, IconTrash } from "@tabler/icons-vue";
import { inject } from "vue";

const props = defineProps({
    builds: Array,
});

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

const getStatusColor = (active) => {
    return active ? "green" : "red";
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
                <th :class="thClasses"></th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="build in builds">
                <td class="text-left" :class="tdClasses">
                    <p class="font-semibold">{{ build.name }}</p>
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
                    <AppBadge :color="getStatusColor(build.active)">
                        {{ build.active ? "Published" : "Hidden" }}
                    </AppBadge>
                </td>

                <td class="flex justify-end space-x-1" :class="tdClasses">
                    <div
                        class="p-2 rounded-xl text-zinc-500 cursor-pointer hover:text-white hover:bg-white/10"
                        @click="emitter.emit('open-delete-guide-modal', build)"
                    >
                        <IconTrash class="size-6" stroke-width="2" />
                    </div>
                    <Link :href="route('build.edit', build.id)">
                        <div
                            class="p-2 rounded-xl text-zinc-500 cursor-pointer hover:text-white hover:bg-white/10"
                        >
                            <IconPencil class="size-6" stroke-width="2" />
                        </div>
                    </Link>
                    <Link :href="route('build.preview', build.id)">
                        <div
                            class="p-2 rounded-xl text-zinc-500 cursor-pointer hover:text-white hover:bg-white/10"
                        >
                            <IconMaximize class="size-6" stroke-width="2" />
                        </div>
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>
