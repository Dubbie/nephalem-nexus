<script setup>
import SidebarLink from "@/Components/SidebarLink.vue";

const props = defineProps({
    build: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div>
        <SidebarLink
            :href="route('build.edit', props.build.id)"
            :active="route().current('build.edit')"
            label="Basics"
        />

        <SidebarLink
            :href="route('build.edit.introduction', props.build.id)"
            :active="route().current('build.edit.introduction')"
            label="Introduction"
        />
        <SidebarLink
            :href="route('build.edit.gear', props.build.id)"
            :active="route().current('build.edit.gear')"
            label="Gear & Charms"
        />
        <SidebarLink
            :href="route('build.edit.skill-tree', props.build.id)"
            :active="route().current('build.edit.skill-tree')"
            label="Skill tree"
        />

        <SidebarLink
            :href="route('build.edit.sections', props.build.id)"
            :active="route().current('build.edit.sections')"
            label="Sections"
        />
    </div>
</template>
