<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditSidebar from "./Partials/EditSidebar.vue";
import { Head, useForm } from "@inertiajs/vue3";
import EditHeader from "./Partials/EditHeader.vue";
import AppAlert from "@/Components/AppAlert.vue";
import { IconInfoCircle } from "@tabler/icons-vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AppButton from "@/Components/AppButton.vue";
import InputError from "@/Components/InputError.vue";
import ClassChooser from "./Partials/ClassChooser.vue";

const props = defineProps({
    build: Object,
});

const form = useForm({
    diablo_class_id: props.build.diablo_class_id,
    name: props.build.name,
});

const submit = () => {
    form.post(route("build.update", props.build.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Edit Build" />

    <AuthenticatedLayout>
        <template #header>
            <EditHeader :build="props.build" />
        </template>

        <div class="grid grid-cols-4">
            <EditSidebar :build="props.build" />

            <div class="col-span-3 text-sm">
                <h3 class="text-xl font-bold mb-6 text-white">Basics</h3>

                <AppAlert color="yellow" :icon="IconInfoCircle">
                    <div>
                        <p class="font-bold text-white">
                            The Gear & Charms section is not implemented yet.
                        </p>
                    </div>
                </AppAlert>

                <div class="space-y-3 mt-6">
                    <div>
                        <ClassChooser v-model="form.diablo_class_id" />
                    </div>

                    <div class="grid grid-cols-5 gap-6 mt-6">
                        <div class="col-span-3">
                            <InputLabel for="name" value="Title" />
                            <div class="relative">
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    class="mt-1 block w-full pr-32"
                                    @keydown="form.clearErrors('name')"
                                />
                            </div>

                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>
                        <div class="col-span-2 mt-6">
                            <AppAlert class="py-3">
                                <p class="text-xs">
                                    Describe the build and class chosen.
                                </p>
                            </AppAlert>
                        </div>
                    </div>

                    <div>
                        <AppButton
                            color="white"
                            :disabled="!form.isDirty || form.processing"
                            @click="submit"
                            >Save</AppButton
                        >
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
