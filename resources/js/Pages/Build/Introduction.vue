<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditSidebar from "./Partials/EditSidebar.vue";
import { Head, useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import EditHeader from "./Partials/EditHeader.vue";
import { IconInfoCircle } from "@tabler/icons-vue";
import InputError from "@/Components/InputError.vue";
import AppButton from "@/Components/AppButton.vue";
import EditorInput from "@/Components/EditorInput.vue";
import AppAlert from "@/Components/AppAlert.vue";

const props = defineProps({
    build: Object,
});

const form = useForm({
    introduction: props.build.introduction ?? "",
});

const submit = () => {
    form.post(route("build.update.introduction", props.build.id), {
        onSuccess: () => {},
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

            <div class="col-span-3">
                <div>
                    <h3 class="text-xl font-bold mb-1">Introduction</h3>
                    <p class="text-sm text-zinc-400 mb-6">
                        This is the first few lines users will see on the build
                        guide page.
                    </p>
                </div>

                <div class="flex space-x-12 max-w-full">
                    <div class="flex-1 space-y-4">
                        <div>
                            <InputLabel
                                for="introduction"
                                value="Content"
                                class="mb-1"
                            />
                            <EditorInput v-model="form.introduction" />

                            <InputError
                                class="mt-2"
                                :message="form.errors.introduction"
                            />
                        </div>

                        <AppAlert :icon="IconInfoCircle">
                            <p class="text-sm">
                                When complete, your introduction will be next to
                                the inventory.
                            </p>
                        </AppAlert>
                    </div>

                    <div class="shrink-0">
                        <p class="text-sm font-semibold text-zinc-400 mb-1">
                            Inventory
                        </p>
                        <div class="relative">
                            <div
                                class="absolute inset-0 text-white bg-white/10 flex flex-col justify-center items-center z-20"
                            >
                                <p class="text-2xl font-bold">
                                    Under Development
                                </p>
                                <p class="text-sm text-white/50">
                                    Will be added later.
                                </p>
                            </div>
                            <img
                                src="/img/invchar.png"
                                alt=""
                                class="blur-sm"
                            />
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <AppButton
                        color="white"
                        :disabled="!form.isDirty || form.processing"
                        @click="submit"
                        >Save Introduction</AppButton
                    >
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
