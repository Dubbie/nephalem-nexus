<script setup>
// Import necessary libraries and components
import { ref, watch } from "vue";
import CKEditorInput from "@/Components/CKEditorInput.vue";
import TextInput from "@/Components/TextInput.vue";
import {
    IconCheck,
    IconChevronDown,
    IconDotsVertical,
    IconTrashFilled,
    IconX,
} from "@tabler/icons-vue";
import AppButton from "@/Components/AppButton.vue";

// Define props for receiving section data from parent
const props = defineProps({
    section: Object,
});

// Define the remove event to emit when deleting the section
const emit = defineEmits(["remove"]);

// Local reactive states
const show = ref(false);
const editingTitle = ref(false);
const title = ref(props.section.title); // Local title binding

// Watch title changes to sync with the section
watch(title, (newTitle) => {
    props.section.title = newTitle; // Update section title
});

// Update title function
const updateTitle = () => {
    editingTitle.value = false;
};
</script>

<template>
    <div class="ring-1 ring-white/15 rounded-xl p-3">
        <div class="flex space-x-2">
            <!-- Handle for sorting -->
            <div class="mt-1">
                <div class="handle p-1 cursor-grab hover:text-white">
                    <IconDotsVertical class="size-5" />
                </div>
            </div>

            <!-- Title and Actions -->
            <div class="w-full max-w-full">
                <div
                    class="flex items-center space-x-6 justify-between group"
                    v-if="!editingTitle"
                >
                    <h3
                        class="w-full text-xl/9 pl-3 font-bold text-white select-none cursor-pointer rounded-xl hover:bg-white/5"
                        @click="editingTitle = true"
                    >
                        {{ title }}
                        <!-- Display title -->
                    </h3>

                    <!-- Actions: Delete and Expand -->
                    <div class="flex space-x-3">
                        <!-- Delete Button -->
                        <AppButton
                            plain
                            square
                            size="xs"
                            @click="$emit('remove')"
                        >
                            <IconTrashFilled class="size-6" />
                        </AppButton>

                        <!-- Toggle content visibility -->
                        <AppButton
                            plain
                            square
                            size="xs"
                            @click.stop="show = !show"
                        >
                            <IconChevronDown
                                class="size-6 transform transition-transform"
                                :class="{
                                    'rotate-180': show,
                                }"
                            />
                        </AppButton>
                    </div>
                </div>

                <!-- Title Editing Mode -->
                <div v-else class="flex justify-between items-center space-x-2">
                    <TextInput
                        v-model="title"
                        class="w-full text-sm"
                        autofocus
                    />

                    <div class="flex space-x-1">
                        <AppButton
                            plain
                            square
                            size="xs"
                            @click="editingTitle = false"
                        >
                            <IconX class="size-6" />
                        </AppButton>
                        <AppButton plain square size="xs" @click="updateTitle">
                            <IconCheck class="size-6" />
                        </AppButton>
                    </div>
                </div>

                <!-- Content Area -->
                <div v-show="show" class="max-w-full">
                    <hr class="border-none h-px bg-white/10 mb-3 mt-2" />
                    <CKEditorInput v-model="section.content" />
                </div>
            </div>
        </div>
    </div>
</template>
