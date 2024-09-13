<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditSidebar from "./Partials/EditSidebar.vue";
import { Head, useForm } from "@inertiajs/vue3";
import AppButton from "@/Components/AppButton.vue";
import draggable from "vuedraggable";
import EditHeader from "./Partials/EditHeader.vue";
import SectionBlock from "./Partials/SectionBlock.vue";
import { IconPlus } from "@tabler/icons-vue";

const props = defineProps({
    build: Object,
    sections: Array,
});

const form = useForm({
    sections: props.sections ?? [],
});

// Add section function
const addSection = () => {
    form.sections.push({
        id: Date.now(),
        title: "Section title",
        content: "Your section content goes here.",
        type: "App\\Models\\ContentSection",
        is_new: true,
    });
};

// Remove section function
const removeSection = (index) => {
    form.sections.splice(index, 1); // Remove section by index
};

// Submit form
const submit = () => {
    form.post(route("build.update.sections", props.build.id), {
        preserveScroll: true,
        preserveState: false,
        onSuccess: () => {},
        onError: () => {},
    });
};
</script>

<template>
    <Head title="Edit Sections" />

    <AuthenticatedLayout>
        <template #header>
            <EditHeader :build="props.build" />
        </template>

        <div class="grid grid-cols-4">
            <EditSidebar :build="props.build" />

            <div class="col-span-3 space-y-6">
                <div>
                    <h3 class="text-xl font-bold mb-1 text-white">Sections</h3>
                    <p class="text-sm text-zinc-400">
                        Add custom sections, explaining the build in as much
                        detail as you would like. (e.g. farming spots, crafting,
                        mechanics, etc.)
                    </p>
                </div>

                <div
                    class="bg-zinc-800 text-zinc-400 text-sm p-4 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="flex justify-between">
                        <p class="font-bold mb-3 text-white">
                            Additional sections
                        </p>
                        <div>
                            <AppButton
                                plain
                                size="xs"
                                v-show="form.isDirty"
                                @click="form.reset()"
                                >Reset sections</AppButton
                            >
                        </div>
                    </div>

                    <div>
                        <template v-if="form.sections.length > 0">
                            <draggable
                                class="space-y-3"
                                handle=".handle"
                                :list="form.sections"
                                item-key="id"
                            >
                                <template #item="{ element, index }">
                                    <SectionBlock
                                        :section="element"
                                        :key="element.id"
                                        @remove="removeSection(index)"
                                    />
                                </template>
                            </draggable>
                        </template>

                        <div v-else>
                            <p>You have not added any sections yet.</p>
                        </div>

                        <AppButton plain @click="addSection" class="mt-3">
                            <IconPlus class="size-4" />
                            <span>Add section</span>
                        </AppButton>
                    </div>

                    <div class="mt-6">
                        <AppButton
                            color="white"
                            @click="submit"
                            :disabled="!form.isDirty"
                            >Save sections</AppButton
                        >
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
