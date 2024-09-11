<script setup>
import AppAlert from "@/Components/AppAlert.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { IconSearch } from "@tabler/icons-vue";
import { onMounted, ref } from "vue";

const builds = ref([]);
const loading = ref(false);

const filter = useForm({
    name: "",
    class_id: null,
});

const classOptions = [{ value: null, label: "Any class" }].concat(
    usePage().props.classes.map((c) => {
        return { value: c.id.toString(), label: c.name };
    })
);

const getBuilds = () => {
    loading.value = true;
    axios.get(route("api.build.fetch")).then((response) => {
        builds.value = response.data.data;
        loading.value = false;
    });
};

onMounted(() => {
    getBuilds();
});
</script>

<template>
    <Head title="Edit Build" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Guides
            </h2>
        </template>

        <div>
            <div v-if="loading">
                <p>Loading guides...</p>
            </div>
            <div v-else>
                <div class="mb-12">
                    <p class="font-semibold text-sm mb-1">Filter</p>

                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-2">
                            <TextInput
                                v-model="filter.name"
                                class="w-full text-sm"
                            />
                        </div>

                        <div class="col-span-1">
                            <SelectInput
                                v-model="filter.class_id"
                                :options="classOptions"
                            />
                        </div>
                    </div>
                </div>

                <div v-if="builds.length > 0" class="grid grid-cols-3 gap-6">
                    <Link
                        :href="route('build.show', build)"
                        v-for="build in builds"
                        :key="build.id"
                        class="ring-2 rounded-xl ring-transparent hover:ring-blue-500"
                    >
                        <div class="bg-zinc-800 rounded-xl p-4">
                            <p class="text-lg font-bold">{{ build.name }}</p>
                            <p class="text-sm text-zinc-400 font-semibold">
                                {{ build.diablo_class.name }}
                            </p>
                        </div>
                    </Link>
                </div>
                <div v-else>
                    <AppAlert>
                        <div
                            class="flex-1 flex flex-col items-center text-center py-6"
                        >
                            <div
                                class="bg-blue-400/15 text-blue-400 p-4 rounded-full mb-6"
                            >
                                <IconSearch class="size-8" stroke-width="2" />
                            </div>

                            <h3 class="text-2xl font-bold text-white">
                                No guides published
                            </h3>
                            <p class="text-zinc-500">
                                Seems like nobody created any guides yet.
                            </p>
                        </div>
                    </AppAlert>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
