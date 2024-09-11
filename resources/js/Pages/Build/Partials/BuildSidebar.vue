<script setup>
import { Link } from "@inertiajs/vue3";
import { computed, inject } from "vue";

const props = defineProps({
    active: String,
});

const build = inject("build");

const sections = computed(() => {
    // Base sections
    const sections = ["Introduction", "Skill Tree"];

    // Add more sections based on build
    const extras = build.sections.map((section) => section.title);

    return sections.concat(extras);
});
</script>

<template>
    <aside class="fixed bg-zinc-800 rounded-xl" style="width: 200px">
        <nav class="p-2">
            <!-- Author -->
            <div class="p-2">
                <Link
                    href="#!"
                    class="flex items-center space-x-3 p-2 rounded-xl -m-2 hover:bg-white/10"
                >
                    <img
                        :src="build.author.profile_photo_url"
                        alt="Avatar"
                        class="size-8 rounded-lg ring-1 ring-white/30"
                    />

                    <div class="overflow-hidden">
                        <p class="text-xs text-zinc-500 leading-none">
                            Created by
                        </p>
                        <p class="text-sm font-bold truncate">
                            {{ build.author.name }}
                        </p>
                    </div>
                </Link>
            </div>
            <!-- Sections -->
            <ul class="mt-3">
                <li v-for="section in sections" :key="section">
                    <a
                        :href="'#' + section"
                        class="border-l-2 text-sm font-medium block -mx-2 pl-4 py-0.5 pr-2"
                        :class="{
                            'border-white text-white': active === section,
                            'border-transparent text-zinc-400 hover:text-white':
                                active !== section,
                        }"
                        >{{ section }}</a
                    >
                </li>
            </ul>
        </nav>
    </aside>
</template>
