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
import { IconChevronLeft } from "@tabler/icons-vue";
import DeclinedAlert from "@/Components/DeclinedAlert.vue";

const props = defineProps({
    build: Object,
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
                <DeclinedAlert
                    v-if="build.decline_reason"
                    :reason="build.decline_reason"
                    :name="build.declined_by.name"
                    class="mb-6"
                />

                <div class="flex justify-between">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold">
                            {{ build.name }} {{ build.diablo_class.name }} Guide
                        </h1>
                        <p class="text-zinc-500 font-medium text-sm">
                            Last updated:
                            {{ getFormattedDate(build.updated_at) }}
                        </p>
                    </div>

                    <div>
                        <AppButton outline :href="route('build.edit', build)">
                            <IconChevronLeft class="size-4" stroke-width="2" />
                            <span>Back to Edit</span></AppButton
                        >
                    </div>
                </div>
                <div class="space-y-8">
                    <BuildIntroduction class="guide-section" />
                    <AppDivider />
                    <BuildSkillTree class="guide-section" />
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
