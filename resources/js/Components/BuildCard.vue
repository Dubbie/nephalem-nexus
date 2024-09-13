<script setup>
import { Link } from "@inertiajs/vue3";
import { IconEye, IconEyeFilled, IconHeartFilled } from "@tabler/icons-vue";

const props = defineProps({
    build: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="route('build.show', build)"
        class="relative overflow-hidden bg-zinc-900 ring-1 ring-white/10 rounded-xl px-4 py-6 group hover:ring-2 hover:ring-blue-500"
    >
        <img
            :src="`/img/${build.diablo_class.name.toLowerCase()}.png`"
            :alt="build.diablo_class.name"
            class="absolute top-1/2 -translate-y-1/2 right-0 opacity-40 transform transition-all ease-in-out group-hover:opacity-70 group-hover:scale-105"
        />

        <div class="relative">
            <p class="font-bold">{{ build.name }}</p>
            <p class="text-zinc-500 text-sm font-semibold">
                {{ build.diablo_class.name }}
            </p>

            <div class="flex space-x-3 mt-3">
                <div
                    v-if="build.likes_count"
                    class="flex space-x-2 items-center"
                >
                    <IconHeartFilled
                        class="text-zinc-600 size-4"
                        stroke-width="2"
                    />
                    <p class="text-sm text-zinc-400 font-bold">
                        {{ build.likes_count }}
                    </p>
                </div>
                <div
                    v-if="build.view_count"
                    class="flex space-x-2 items-center"
                >
                    <IconEyeFilled
                        class="text-zinc-600 size-4"
                        stroke-width="2"
                    />
                    <p class="text-sm text-zinc-400 font-bold">
                        {{ build.view_count }}
                    </p>
                </div>

                <div class="flex-1 flex space-x-2 items-center justify-end">
                    <p class="text-xs text-zinc-300 font-semibold">
                        {{ build.author.name }}
                    </p>
                    <img
                        :src="build.author.profile_photo_url"
                        class="size-4 rounded-md"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </Link>
</template>
