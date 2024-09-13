<script setup>
import { computed, inject } from "vue";
import AppButton from "./AppButton.vue";
import { router, usePage } from "@inertiajs/vue3";

const emitter = inject("emitter");
const loggedIn = computed(() => usePage().props.auth.user !== null);

const handleNewGuide = () => {
    // If not logged in, redirect to login
    if (!loggedIn.value) {
        router.get(route("login"));
    } else {
        emitter.emit("open-new-guide-modal");
    }
};
</script>

<template>
    <div
        class="relative rounded-xl px-8 pt-64 pb-8 bg-[url('/img/hero.jpg')] bg-cover overflow-hidden"
    >
        <div
            class="pointer-events-none bg-gradient-to-tr from-black via-black/40 to-transparent absolute inset-0"
        ></div>

        <div class="relative z-20 flex">
            <div
                class="p-8 bg-white/5 rounded-xl backdrop-blur ring-1 ring-white/10"
            >
                <h1 class="text-3xl font-bold">Forge Your Path in Sanctuary</h1>

                <p class="text-white/60 mt-1">
                    Discover, create, and master powerful builds in the world of
                    Project Diablo II.
                </p>

                <div class="flex space-x-4 mt-8">
                    <AppButton
                        size="lg"
                        color="blue"
                        :href="route('build.index')"
                        >Explore Guides</AppButton
                    >
                    <AppButton
                        size="lg"
                        color="white"
                        outline
                        @click="handleNewGuide"
                        >Create a Guide</AppButton
                    >
                </div>
            </div>
        </div>
    </div>
</template>
