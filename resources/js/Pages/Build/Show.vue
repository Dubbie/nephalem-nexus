<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { onMounted, provide, ref } from "vue";
import BuildSidebar from "./Partials/BuildSidebar.vue";
import BuildIntroduction from "./Partials/BuildIntroduction.vue";
import BuildSkillTree from "./Partials/BuildSkillTree.vue";
import AppDivider from "@/Components/AppDivider.vue";
import AppButton from "@/Components/AppButton.vue";
import BuildContextSection from "./Partials/BuildContextSection.vue";
import { IconHeart, IconPencil } from "@tabler/icons-vue";
import LikeIcon from "@/Components/LikeIcon.vue";

const props = defineProps({
    build: Object,
    isAuthor: {
        type: Boolean,
        default: false,
    },
});

provide("build", props.build);
const activeSection = ref(null);

const setupScrollSpy = () => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    activeSection.value = entry.target.getAttribute("id");
                }
            });
        },
        {
            threshold: [0.4],
        }
    );

    const elements = document.querySelectorAll(".guide-section");
    elements.forEach((element) => {
        observer.observe(element);
    });

    checkLastSections();
};

const checkLastSections = () => {
    // Example logic to manually check last sections visibility
    const sections = Array.from(document.querySelectorAll(".guide-section"));
    if (sections.length) {
        const lastSection = sections[sections.length - 1];
        const rect = lastSection.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            activeSection.value = lastSection.getAttribute("id");
        }
    }
};

const getFormattedDate = (isoDate) => {
    const date = new Date(isoDate);

    // Format the date parts
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0"); // Months are zero-indexed
    const day = String(date.getDate()).padStart(2, "0");

    // Combine into the desired format
    return `${year}.${month}.${day}`;
};

onMounted(() => {
    setupScrollSpy();
});
</script>

<template>
    <Head title="Preview" />

    <AuthenticatedLayout>
        <div class="">
            <BuildSidebar :active="activeSection" />

            <div class="ml-60">
                <div class="flex justify-between">
                    <div class="mb-6">
                        <h1
                            class="flex items-center space-x-2 text-4xl font-bold mb-1"
                        >
                            <span
                                >{{ build.name }}
                                {{ build.diablo_class.name }} Guide</span
                            >
                            <LikeIcon
                                :build="build"
                                v-if="$page.props.auth.user"
                            />
                        </h1>
                        <p class="text-zinc-500 font-medium text-sm">
                            Last updated:
                            {{ getFormattedDate(build.updated_at) }}
                        </p>
                    </div>

                    <div>
                        <AppButton
                            outline
                            :href="route('build.edit', build)"
                            v-if="isAuthor"
                        >
                            <IconPencil class="size-4" stroke-width="2" />
                            <span>Edit guide</span></AppButton
                        >
                    </div>
                </div>
                <div class="space-y-8">
                    <BuildIntroduction
                        class="guide-section"
                        :hide-button="true"
                    />
                    <AppDivider />
                    <BuildSkillTree class="guide-section" :hide-button="true" />
                    <template
                        v-for="section in build.sections"
                        :key="section.id"
                    >
                        <AppDivider />
                        <BuildContextSection
                            class="guide-section"
                            :section="section"
                        />
                    </template>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
