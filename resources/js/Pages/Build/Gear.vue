<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditSidebar from "./Partials/EditSidebar.vue";
import { Head, useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { IconBackhoe } from "@tabler/icons-vue";
import InputError from "@/Components/InputError.vue";
import AppButton from "@/Components/AppButton.vue";
import EditHeader from "./Partials/EditHeader.vue";

const props = defineProps({
    build: Object,
});

const form = useForm({
    search: "",
});
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
                <h3 class="text-xl font-bold mb-1">Gear & Charms</h3>
                <p class="text-sm text-zinc-400 mb-6">
                    You can choose which items the character uses, including the
                    required charms.
                </p>

                <div class="relative">
                    <div
                        class="absolute inset-0 bg-white/10 text-white rounded-xl flex flex-col justify-center items-center z-20"
                    >
                        <div
                            class="bg-yellow-500/40 text-yellow-400 p-4 rounded-3xl mb-4"
                        >
                            <IconBackhoe class="size-10" stroke-width="1.5" />
                        </div>
                        <p class="text-2xl font-bold">
                            This area is currently under development.
                        </p>
                        <p class="text-white/60">
                            This feature is in the oven, let it cook.
                        </p>
                    </div>

                    <div class="flex space-x-4 relative">
                        <div class="flex-1 space-y-4 blur-sm">
                            <div>
                                <InputLabel
                                    for="introduction"
                                    value="Introduction text"
                                    class="mb-1"
                                />
                                <TextInput
                                    id="search"
                                    v-model="form.search"
                                    class="mt-1 block w-full"
                                    placeholder="Search for items..."
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.search"
                                />
                            </div>
                        </div>

                        <div class="shrink-0 blur-sm">
                            <p class="text-sm font-semibold text-zinc-400 mb-1">
                                Inventory
                            </p>
                            <img src="/img/invchar.png" alt="" />
                        </div>
                    </div>

                    <div class="mt-4 blur-sm">
                        <AppButton color="white">Save gear section</AppButton>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
