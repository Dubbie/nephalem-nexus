<script setup>
import AppAlert from "@/Components/AppAlert.vue";
import AppButton from "@/Components/AppButton.vue";
import AppItem from "@/Components/AppItem.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { IconCheck, IconExclamationCircleFilled } from "@tabler/icons-vue";
import { onMounted, ref, watch } from "vue";

const items = ref([]);
const loading = ref(true);
let timer = null;

const filter = useForm({
    name: "",
});

const fetchItems = () => {
    loading.value = true;

    axios
        .get(route("api.item.fetch"), {
            params: filter,
        })
        .then((response) => {
            items.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            loading.value = false;
        });
};

const handleUpdate = () => {
    if (timer) {
        clearTimeout(timer);
    }

    timer = setTimeout(fetchItems, 500);
};

onMounted(() => {
    fetchItems();
});

watch(filter, () => {
    handleUpdate();
});
</script>

<template>
    <Head title="Items" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Items
            </h2>
        </template>

        <AppAlert color="yellow" class="mb-6">
            <IconExclamationCircleFilled class="size-5" />
            <div class="text-sm">
                <p>
                    This is a list of all the currently supported items in the
                    database.
                </p>
                <p>
                    I'm working towards full support for all items. This process
                    takes a while so stay tuned for any updates regarding this
                    feature.
                </p>

                <p class="mt-4 mb-2">My planned route:</p>
                <div class="space-y-3">
                    <div class="flex items-center space-x-2">
                        <div
                            class="p-1 bg-yellow-400 ring-2 ring-yellow-400 rounded-md flex items-center justify-center"
                        >
                            <IconCheck
                                class="text-yellow-900 size-3"
                                stroke-width="5"
                            />
                        </div>
                        <p class="line-through">Affixes</p>
                        <p class="text-white">Added all affixes.</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="p-1 bg-yellow-400 ring-2 ring-yellow-400 rounded-md flex items-center justify-center"
                        >
                            <IconCheck
                                class="text-yellow-900 size-3"
                                stroke-width="5"
                            />
                        </div>
                        <p class="line-through">Base Weapons</p>
                        <p class="text-white">Added all spawnable weapons.</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="p-1 ring-2 ring-yellow-400 rounded-md flex items-center justify-center"
                        >
                            <div class="size-3"></div>
                        </div>
                        <p>Base Armors</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="p-1 ring-2 ring-yellow-400 rounded-md flex items-center justify-center"
                        >
                            <div class="size-3"></div>
                        </div>
                        <p>Unique Items</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="p-1 ring-2 ring-yellow-400 rounded-md flex items-center justify-center"
                        >
                            <div class="size-3"></div>
                        </div>
                        <p>Set Items</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="p-1 ring-2 ring-yellow-400 rounded-md flex items-center justify-center"
                        >
                            <div class="size-3"></div>
                        </div>
                        <p>Craft Items</p>
                    </div>
                </div>
            </div>
        </AppAlert>

        <div class="mb-6">
            <p class="font-semibold text-sm mb-1">Filter</p>

            <div class="flex">
                <div class="flex-1">
                    <TextInput
                        v-model="filter.name"
                        class="w-full text-sm"
                        aria-placeholder="Search items"
                        placeholder="Search here..."
                    />
                </div>
            </div>
        </div>

        <div>
            <div v-if="loading">
                <div class="grid grid-cols-10 gap-6">
                    <div v-for="i in 20" :key="i">
                        <div
                            class="bg-zinc-800 rounded-xl h-36 animate-pulse"
                        ></div>
                    </div>
                </div>
            </div>

            <div v-else-if="items.length === 0">
                <div class="bg-zinc-800 text-zinc-500 p-8 rounded-xl">
                    <div>
                        <p class="text-3xl font-bold text-white">
                            No results found
                        </p>
                        <p class="text-sm">
                            We could not find any items matching your search.
                        </p>

                        <AppButton
                            color="white"
                            class="mt-6"
                            @click="filter.reset()"
                            >Reset filters</AppButton
                        >
                    </div>
                </div>
            </div>

            <div v-else>
                <div class="grid grid-cols-10 gap-6">
                    <AppItem
                        v-for="item in items"
                        :key="item.id"
                        :item="item"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
