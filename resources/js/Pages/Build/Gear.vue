<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditSidebar from "./Partials/EditSidebar.vue";
import { Head, useForm } from "@inertiajs/vue3";
import EditHeader from "./Partials/EditHeader.vue";
import ItemFinder from "@/Components/ItemFinder.vue";
import { inject, onMounted, onUnmounted } from "vue";
import AppInventory from "@/Components/AppInventory.vue";
import AppAlert from "@/Components/AppAlert.vue";
import { IconExclamationCircleFilled } from "@tabler/icons-vue";

const props = defineProps({
    build: Object,
});

const form = useForm({
    larm: null,
    rarm: null,
    tors: null,
    helm: null,
    boot: null,
    belt: null,
    glov: null,
    lrin: null,
    rrin: null,
    amul: null,
});

const emitter = inject("emitter");

onMounted(() => {
    emitter.on("item-selected", (item) => {
        console.log(item);
        // Check which slot the item should be in
        if (item.weapon) {
            // Check 1 hander
            if (item.weapon.damage_type === "One-Hand Damage") {
                // If we have equipped a two-handed weapon, remove it
                if (
                    form.larm &&
                    form.larm.weapon.damage_type === "Two-Hand Damage"
                ) {
                    form.larm = null;
                    form.rarm = null;
                }

                // If left hand is occupied, put it in the right hand
                if (form.larm) {
                    form.rarm = item;
                } else {
                    form.larm = item;
                }
            }

            // Check 2 hander
            if (item.weapon.damage_type === "Two-Hand Damage") {
                form.larm = item;
                form.rarm = item;
            }
        }

        if (item.armor) {
            // Shield
            if (item.type === "shie") {
                // Check if 2 hander in left hand
                if (
                    form.larm &&
                    form.larm.weapon.damage_type === "Two-Hand Damage"
                ) {
                    form.larm = null;
                    form.rarm = null;
                }

                form.rarm = item;
            }
            // Torso
            if (item.type === "tors") {
                form.tors = item;
            }

            // Helmet
            if (item.type === "helm") {
                form.helm = item;
            }

            // Boots
            if (item.type === "boot") {
                form.boot = item;
            }

            // Belt
            if (item.type === "belt") {
                form.belt = item;
            }

            // Gloves
            if (item.type === "glov") {
                form.glov = item;
            }
        }
    });

    emitter.on("unequip-item", (itemSlot) => {
        console.log("Uneqipping item in slot: " + itemSlot);

        form[itemSlot] = null;
    });
});

onUnmounted(() => {
    emitter.off("item-selected");
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
                <AppAlert
                    color="yellow"
                    :icon="IconExclamationCircleFilled"
                    class="mb-6"
                >
                    <div class="text-sm">
                        <p class="mb-2">
                            This is currently just a showcase, it's not ready
                            for real world use.
                        </p>
                        <p class="mb-2">
                            The end goal is to be able to handle all modifiers
                            on each item, with the use of the game's files. This
                            would allow for importing uniques, set items as well
                            as creating your desired crafted items.
                        </p>
                        <p>
                            If you know how the game handles the properties,
                            stats using the .mpq files and would like to
                            help,<br />
                            please message me on discord:
                            <span
                                class="text-white bg-black/30 px-1 py-0.5 rounded-md"
                                >subesz#subesz</span
                            >
                        </p>
                    </div>
                </AppAlert>

                <h3 class="text-xl font-bold mb-1">Gear</h3>
                <p class="text-sm text-zinc-400 mb-6">
                    Search for the items needed for the build to function.
                </p>

                <div class="flex gap-x-12">
                    <div class="flex-1">
                        <ItemFinder />
                    </div>

                    <div class="shrink-0">
                        <AppInventory
                            :larm="form.larm"
                            :rarm="form.rarm"
                            :tors="form.tors"
                            :helm="form.helm"
                            :boot="form.boot"
                            :belt="form.belt"
                            :glov="form.glov"
                            :lrin="form.lrin"
                            :rrin="form.rrin"
                            :amul="form.amul"
                        />

                        <p class="text-xs text-zinc-400 mt-2 text-center">
                            Yes, I know this is the wrong inventory image.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
