<script setup>
import AuthHeader from "@/Layouts/Partials/AuthHeader.vue";
import GuestHeader from "@/Layouts/Partials/GuestHeader.vue";
import NavLink from "@/Components/NavLink.vue";
import NewBuildModal from "@/Components/NewBuildModal.vue";
import AppFooter from "@/Layouts/Partials/AppFooter.vue";
import { inject, onMounted, onUnmounted, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import AppToast from "@/Components/AppToast.vue";

const emitter = inject("emitter");
const showingNewGuideModal = ref(false);

const setupAccordions = () => {
    const accordions = document.querySelectorAll(".accordion");

    accordions.forEach((accordion) => {
        const titleElement = accordion.querySelector(".accordion-title");
        const contentElement = accordion.querySelector(".accordion-content");

        // Don't open them by default
        contentElement.classList.add("hidden");

        titleElement.addEventListener("click", (event) => {
            contentElement.classList.toggle("hidden");
        });
    });
};

onMounted(() => {
    setupAccordions();

    emitter.on("open-new-guide-modal", () => {
        showingNewGuideModal.value = true;
    });
});

onUnmounted(() => {
    emitter.off("open-new-guide-modal");
});
</script>

<template>
    <div
        class="relative isolate flex min-h-svh w-full flex-col bg-zinc-900 lg:bg-zinc-950"
    >
        <AppToast />

        <header class="flex items-center px-4">
            <!-- <div class="py-2 5 lg:hidden"></div> -->

            <div class="min-w-0 flex-1">
                <nav class="flex flex-1 items-center gap-4 py-2.5">
                    <Link
                        :href="route('home')"
                        class="rounded-xl px-3 py-1 hover:bg-white/10"
                    >
                        <span class="max-lg:hidden relative">
                            <p class="font-black text-white">Nephalem Nexus</p>
                        </span>
                    </Link>
                    <div class="max-lg:hidden h-6 w-px bg-white/10"></div>
                    <div class="max-lg:hidden flex items-center gap-3">
                        <NavLink
                            :active="route().current('build.*')"
                            :href="route('build.index')"
                        >
                            Guides</NavLink
                        >
                        <NavLink
                            :active="route().current('item.*')"
                            :href="route('item.index')"
                            v-if="$page.props.auth.user.role === 'DEVELOPER'"
                        >
                            Items</NavLink
                        >
                    </div>
                    <div class="-ml-4 flex-1"></div>

                    <AuthHeader v-if="$page.props.auth.user" />
                    <GuestHeader v-else />
                </nav>
            </div>
        </header>

        <main id="main-content" class="flex flex-1 flex-col pb-2 lg:px-2">
            <div
                class="grow p-6 lg:rounded-lg lg:p-10 lg:shadow-sm lg:ring-1 lg:bg-zinc-900 lg:ring-white/10 text-white"
            >
                <div class="mx-auto max-w-6xl">
                    <div v-if="$slots.header" class="mb-6">
                        <slot name="header" />

                        <hr
                            class="mt-6 w-full border-t border-zinc-950/10 dark:border-white/10"
                            role="presentation"
                        />
                    </div>

                    <slot />
                </div>
            </div>
        </main>

        <AppFooter />

        <NewBuildModal
            :show="showingNewGuideModal"
            @close="showingNewGuideModal = false"
        />
    </div>
</template>

<style>
.guide-section-content {
    @apply leading-relaxed;
}

.guide-section-content a {
    @apply underline text-blue-500 hover:text-blue-400;
}

.guide-section-content .accordion {
    @apply border px-4 py-2 bg-transparent border-white/15  rounded-xl;
}

.guide-section-content .accordion-title {
    @apply cursor-pointer border-none font-bold text-lg text-zinc-400 hover:text-white;
}

.guide-section-content .accordion-content {
    @apply border-t border-x-0 border-b-0 border-t-white/15 mt-2 pt-2;
}
</style>
