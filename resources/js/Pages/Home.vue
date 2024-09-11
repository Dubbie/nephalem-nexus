<script setup>
import AppButton from "@/Components/AppButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { IconFlame, IconNews, IconTrendingUp } from "@tabler/icons-vue";
import { ref } from "vue";

const props = defineProps({
    trending: {
        type: Array,
        default: () => [],
    },
    latest: {
        type: Array,
        default: () => [],
    },
});

const demoMode = ref(false);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="mb-6 flex items-center space-x-3">
            <div
                class="text-blue-500 bg-blue-400/15 flex items-center justify-center p-2 rounded-full"
            >
                <IconTrendingUp class="size-5" stroke-width="2" />
            </div>
            <h3 class="text-2xl font-bold">Trending</h3>
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
                <Link
                    v-for="build in trending"
                    :key="build.id"
                    :href="route('build.show', build)"
                    class="block bg-zinc-800 rounded-xl px-4 py-8 hover:ring-2 hover:ring-blue-500"
                >
                    <p class="font-bold">{{ build.name }}</p>
                    <p class="text-zinc-500 text-sm">
                        By {{ build.author.name }}
                    </p>
                </Link>
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

        <div class="grid grid-cols-4 gap-12 mt-12">
            <div class="col-span-3">
                <div class="mb-6 flex items-center space-x-3">
                    <div
                        class="text-red-500 bg-red-400/15 flex items-center justify-center p-2 rounded-full"
                    >
                        <IconNews class="size-4" stroke-width="2" />
                    </div>
                    <h3 class="text-xl font-bold">Recent News</h3>
                </div>

                <div class="space-y-6">
                    <div class="bg-zinc-800 rounded-xl h-96"></div>
                    <div class="bg-zinc-800 rounded-xl h-32"></div>
                    <div class="bg-zinc-800 rounded-xl h-32"></div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="mb-6 flex items-center space-x-3">
                    <div
                        class="text-yellow-500 bg-yellow-400/15 flex items-center justify-center p-2 rounded-full"
                    >
                        <IconFlame class="size-4" stroke-width="2" />
                    </div>
                    <h3 class="text-xl font-bold">Newest Guides</h3>
                </div>

                <div class="space-y-6" v-if="demoMode">
                    <div
                        v-for="i in 4"
                        :key="i"
                        class="bg-zinc-800 rounded-xl h-20"
                    ></div>
                </div>

                <div class="space-y-6" v-else>
                    <template v-if="latest.length">
                        <Link
                            v-for="build in latest"
                            :key="build.id"
                            :href="route('build.show', build)"
                            class="block bg-zinc-800 rounded-xl p-4 hover:ring-2 hover:ring-blue-500"
                        >
                            <p class="font-bold text-sm">{{ build.name }}</p>
                            <p class="text-zinc-500 text-xs">
                                By {{ build.author.name }}
                            </p>
                        </Link>
                    </template>
                    <template v-else>
                        <div
                            class="col-span-full bg-zinc-800 rounded-xl px-3 py-6"
                        >
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>
