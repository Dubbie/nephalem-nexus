<script setup>
import ItemDisplay from "@/Components/ItemDisplay.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    items: Array,
});
</script>

<template>
    <AuthenticatedLayout title="Unique Items">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Unique Items
            </h2>
        </template>

        <div class="grid grid-cols-6 gap-6">
            <ItemDisplay
                v-for="item in props.items"
                :key="item.id"
                :item="item"
            />
        </div>
    </AuthenticatedLayout>
</template>
