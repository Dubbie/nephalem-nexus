<script setup>
import AppAlert from "@/Components/AppAlert.vue";
import AppButton from "@/Components/AppButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { IconSearch } from "@tabler/icons-vue";
import { inject, onMounted, ref, watch } from "vue";

const builds = ref([]);
const loading = ref(false);
const emitter = inject("emitter");
let timer = null;

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

const handleInput = () => {
    if (timer) {
        clearTimeout(timer);
    }

    timer = setTimeout(() => {
        getBuilds();
    }, 300);
};

onMounted(() => {
    getBuilds();
});

watch(
    () => filter,
    () => {
        handleInput();
    },
    { deep: true }
);
</script>

<template>
    <Head title="Edit Build" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Guides
            </h2>
        </template>

        <div class="mb-6">
            <p class="font-semibold text-sm mb-1">Filter</p>

            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-2">
                    <TextInput v-model="filter.name" class="w-full text-sm" />
                </div>

                <div class="col-span-1">
                    <SelectInput
                        v-model="filter.class_id"
                        :options="classOptions"
                    />
                </div>
            </div>
        </div>

        <div>
            <transition
                enter-active-class="transition ease-out duration-200"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition ease-in duration-150"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
                mode="out-in"
            >
                <div v-if="loading">
                    <div class="grid grid-cols-3 gap-6">
                        <div
                            v-for="i in 6"
                            :key="i"
                            class="ring-2 rounded-xl ring-transparent"
                        >
                            <div class="bg-zinc-800 rounded-xl p-4 select-none">
                                <p class="text-lg font-bold opacity-0">b</p>
                                <div class="flex items-center justify-between">
                                    <p
                                        class="text-sm text-zinc-400 font-semibold opacity-0"
                                    >
                                        c
                                    </p>
                                    <div class="flex space-x-2 items-center">
                                        <p
                                            class="text-xs text-zinc-500 font-semibold opacity-0"
                                        >
                                            a
                                        </p>
                                        <div
                                            class="size-4 rounded-md"
                                            alt=""
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div
                        v-if="builds.length > 0"
                        class="grid grid-cols-3 gap-6"
                    >
                        <Link
                            :href="route('build.show', build)"
                            v-for="build in builds"
                            :key="build.id"
                            class="ring-2 rounded-xl ring-transparent hover:ring-blue-500"
                        >
                            <div class="bg-zinc-800 rounded-xl p-4">
                                <p class="text-lg font-bold">
                                    {{ build.name }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <p
                                        class="text-sm text-zinc-400 font-semibold"
                                    >
                                        {{ build.diablo_class.name }}
                                    </p>
                                    <div class="flex space-x-2 items-center">
                                        <p
                                            class="text-xs text-zinc-500 font-semibold"
                                        >
                                            {{ build.author.name }}
                                        </p>
                                        <img
                                            :src="
                                                build.author.profile_photo_url
                                            "
                                            class="size-4 rounded-md"
                                            alt=""
                                        />
                                    </div>
                                </div>
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
                                    <IconSearch
                                        class="size-8"
                                        stroke-width="2"
                                    />
                                </div>

                                <h3 class="text-2xl font-bold text-white">
                                    No guides published
                                </h3>
                                <p class="text-zinc-500 mb-3">
                                    Seems like nobody created any guides yet.
                                </p>

                                <p class="text-zinc-500 mb-1">
                                    Would you like to create one?
                                </p>
                                <AppButton
                                    color="blue"
                                    @click="
                                        emitter.emit('open-new-guide-modal')
                                    "
                                    >New Guide</AppButton
                                >
                            </div>
                        </AppAlert>
                    </div>
                </div>
            </transition>
        </div>
    </AuthenticatedLayout>
</template>
