<script setup>
import BuildSectionTitle from "./BuildSectionTitle.vue";
import "ckeditor5/ckeditor5.css";

const props = defineProps({
    section: {
        type: Object,
        required: true,
    },
});

console.log(props.section);
</script>

<template>
    <div :id="section.title">
        <BuildSectionTitle :title="section.title" />

        <div
            v-html="section.sectionable.content"
            class="guide-section-content ck-content"
        ></div>
    </div>
</template>
