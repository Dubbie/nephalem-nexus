<script setup>
import { useForm } from "@inertiajs/vue3";
import InputLabel from "./InputLabel.vue";
import { computed, inject, ref, watch } from "vue";
import TextInput from "./TextInput.vue";
import AppItem from "./AppItem.vue";

const emitter = inject("emitter");
const items = ref([]);
const loading = ref(false);
let timer = null;

const visibleItems = computed(() => {
    // Only give back 12 items
    return items.value.slice(0, 12);
});

const form = useForm({
    name: "",
});

const fetchItems = () => {
    loading.value = true;

    axios
        .get(route("api.item.fetch"), {
            params: form,
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

watch(form, () => {
    handleUpdate();
});
</script>

<template>
    <div>
        <div class="mb-6">
            <InputLabel for="search" value="Search" />
            <TextInput
                id="search"
                type="text"
                v-model="form.name"
                class="w-full text-sm"
            />
        </div>

        <div v-if="loading">
            <p>Loading items...</p>
        </div>
        <div v-else>
            <div class="grid grid-cols-6 gap-6 max-h-72 items-center">
                <div
                    v-for="item in visibleItems"
                    :key="item.id"
                    @click="emitter.emit('item-selected', item)"
                >
                    <AppItem :item="item" />
                </div>
            </div>
            <p
                v-if="items.length > 12"
                class="text-sm mt-3 text-center text-zinc-400"
            >
                {{ items.length - visibleItems.length }} Results hidden
            </p>
        </div>
    </div>
</template>
