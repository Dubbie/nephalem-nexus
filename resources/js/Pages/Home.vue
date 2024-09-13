<script setup>
import AppButton from "@/Components/AppButton.vue";
import BuildCard from "@/Components/BuildCard.vue";
import BuildCardCompact from "@/Components/BuildCardCompact.vue";
import HeroSection from "@/Components/HeroSection.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { IconFlame, IconNews, IconTrendingUp } from "@tabler/icons-vue";
import { ref } from "vue";

const props = defineProps({
    trending: {
        type: Array,
        default: () => [],
    },
    recent: {
        type: Array,
        default: () => [],
    },
});

const demoMode = ref(false);
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <HeroSection class="mb-12" />

        <div class="mb-6 flex items-center space-x-3">
            <div
                class="text-blue-500 bg-blue-400/15 flex items-center justify-center p-2 rounded-full"
            >
                <IconTrendingUp class="size-5" stroke-width="2" />
            </div>
            <h3 class="text-2xl font-bold flex-1">Trending</h3>

            <Link
                :href="route('build.index')"
                class="text-sm font-bold text-blue-500 hover:text-blue-400"
            >
                Show all
            </Link>
        </div>

        <div class="grid grid-cols-4 gap-6" v-if="demoMode">
            <div
                v-for="i in 8"
                :key="i"
                class="bg-zinc-800 rounded-xl h-32"
            ></div>
        </div>
        <div class="grid grid-cols-4 gap-6" v-else>
            <template v-if="trending.length">
                <BuildCard
                    v-for="build in trending"
                    :key="build.id"
                    :build="build"
                />
            </template>

            <template v-else>
                <div class="col-span-full bg-zinc-800 rounded-xl px-4 py-8">
                    <div class="flex flex-col items-center">
                        <p class="text-2xl text-white font-bold mb-2">
                            No guides published
                        </p>
                        <p class="text-sm text-zinc-400 mb-2">
                            It seems like nobody published any guides yet.
                        </p>
                    </div>
                </div>
            </template>
        </div>

        <div class="mt-12 mb-6 flex items-center space-x-3">
            <div
                class="text-green-500 bg-green-400/15 flex items-center justify-center p-2 rounded-full"
            >
                <IconFlame class="size-4" stroke-width="2" />
            </div>
            <h3 class="text-xl font-bold flex-1">Recent guides</h3>
        </div>
        <div class="grid grid-cols-5 gap-6">
            <template v-if="recent.length">
                <BuildCardCompact
                    v-for="build in recent"
                    :key="build.id"
                    :build="build"
                />
            </template>
            <template v-else>
                <div class="col-span-full bg-zinc-800 rounded-xl px-3 py-6">
                    <div class="flex flex-col items-center text-center">
                        <p class="text-lg text-white font-bold mb-2">
                            No guides yet
                        </p>
                        <p class="text-sm text-zinc-400">
                            Check back later, once we have some
                        </p>
                    </div>
                </div>
            </template>
        </div>
    </AuthenticatedLayout>
</template>
