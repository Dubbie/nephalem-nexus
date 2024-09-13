<script setup>
import "@/quill-accordion";
import "@/quill-icons";
import "../../css/quill-accordion.css";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { onMounted } from "vue";

const model = defineModel();

// const toolbarOptions = [
//     ["bold", "italic", "underline"],
//     ["accordion"], // Custom button for accordion
// ];

const toolbarOptions = [
    [{ header: [1, 2, false] }],
    ["bold", "italic", "underline"],
    [{ color: [] }, { background: [] }],
    [{ align: [] }],
    ["accordion", "link"],
];

const editorOptions = {
    modules: {
        toolbar: {
            container: toolbarOptions,
            handlers: {
                accordion: function () {
                    const accordionContent = {
                        title: "Accordion Title",
                        content: "Accordion Content",
                    };

                    const range = this.quill.getSelection();
                    this.quill.insertEmbed(
                        range.index,
                        "accordion",
                        accordionContent
                    );
                },
            },
        },
    },
};

function bindQuillAccordion() {
    document.addEventListener("click", (event) => {
        if (event.target.classList.contains("accordion-title")) {
            const accordion = event.target.parentNode;
            accordion.classList.toggle("open");
        }
    });
}

onMounted(() => {
    bindQuillAccordion();
});
</script>

<template>
    <div class="diablo-editor">
        <QuillEditor
            theme="snow"
            v-model:content="model"
            content-type="html"
            :options="editorOptions"
        />
    </div>
</template>

<style>
.diablo-editor .ql-editor {
    overflow-wrap: anywhere;
}

/* Customize toolbar */
.diablo-editor .ql-toolbar.ql-snow {
    border: none;
    @apply bg-transparent rounded-xl border-none p-0;
}

.diablo-editor .ql-toolbar.ql-snow .ql-formats {
    @apply bg-zinc-700 rounded-lg p-1 inline-flex items-center;
}

.diablo-editor .ql-snow .ql-picker {
    @apply text-white;
}

.diablo-editor .ql-toolbar .ql-picker-label::before {
    @apply text-white;
}

.diablo-editor .ql-toolbar .ql-picker-label {
    @apply rounded-md;
}

.diablo-editor .ql-toolbar .ql-picker-label:hover {
    @apply bg-white/15;
}

/* Customize icons */
.diablo-editor .ql-snow .ql-stroke {
    @apply stroke-white;
}

.diablo-editor .ql-snow .ql-color-picker .ql-picker-label,
.diablo-editor .ql-snow .ql-icon-picker .ql-picker-label {
    @apply flex items-center justify-center p-1;
}

.diablo-editor .ql-snow .ql-color-picker,
.diablo-editor .ql-snow .ql-icon-picker {
    @apply h-auto w-auto;
}

.diablo-editor .ql-snow .ql-color-picker svg,
.diablo-editor .ql-snow .ql-icon-picker svg {
    @apply size-5;
}

.diablo-editor .ql-snow.ql-toolbar button,
.diablo-editor .ql-snow .ql-toolbar button {
    @apply rounded-md hover:bg-zinc-600 p-1 flex justify-center items-center w-auto h-auto;
}

.diablo-editor .ql-snow.ql-toolbar button svg,
.diablo-editor .ql-snow .ql-toolbar button svg {
    @apply size-5;
}

.diablo-editor .ql-icon-picker .ql-picker-item {
    @apply w-auto h-auto p-1;
}

.diablo-editor .ql-icon-picker .ql-picker-item svg {
    @apply size-5;
}

/* Customize content */
.diablo-editor .ql-container {
    @apply border-none;
}

.diablo-editor .ql-editor {
    @apply bg-zinc-900 ring-1 ring-white/15 rounded-lg mt-3 hover:ring-white/30;
}

/* Customize tooltips */
.diablo-editor .ql-tooltip {
    @apply bg-zinc-800 border-none ring-1 ring-white/30 shadow shadow-black rounded-xl;
}

.diablo-editor .ql-tooltip::before {
    @apply text-zinc-400;
}

.diablo-editor .ql-snow .ql-picker-options {
    @apply bg-zinc-800 rounded-lg border-0 ring-1 ring-white/30;
}

.diablo-editor .ql-snow .ql-icon-picker .ql-picker-item {
    @apply rounded-md hover:bg-white/15;
}
</style>
