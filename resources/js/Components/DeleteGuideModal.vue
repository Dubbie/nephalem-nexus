<script setup>
import Modal from "@/Components/Modal.vue";
import AppButton from "@/Components/AppButton.vue";
import { inject, onMounted, onUnmounted, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const show = ref(false);
const build = ref(null);
const emitter = inject("emitter");

const hideModal = () => {
    show.value = false;
    build.value = null;
};

const submit = () => {
    const form = useForm({
        build_id: build.value.id,
    });

    form.delete(route("build.destroy", build.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            hideModal();
        },
    });
};

onMounted(() => {
    emitter.on("close-delete-guide-modal", () => {
        hideModal();
    });

    emitter.on("open-delete-guide-modal", (_build) => {
        show.value = true;
        build.value = _build;
    });
});

onUnmounted(() => {
    emitter.off("close-delete-guide-modal");
    emitter.off("open-delete-guide-modal");
});
</script>

<template>
    <Modal :show="show" max-width="md">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-white mb-3">Delete Guide</h2>
            <p class="text-sm font-medium text-zinc-500 mb-1">
                Are you sure you want to delete this guide?
            </p>
            <p class="text-sm font-medium text-zinc-500 mb-6">
                This action is not reversible.
            </p>

            <div v-if="build" class="p-4 rounded-xl ring-2 ring-white/10">
                <p class="font-bold text-white">
                    {{ build.name }}
                </p>
                <p class="text-zinc-400 text-sm">
                    {{ build.diablo_class.name }}
                </p>
            </div>

            <div class="flex justify-end items-center space-x-1 mt-6">
                <AppButton plain @click="hideModal"> Cancel </AppButton>
                <AppButton color="red" @click="submit"> Delete </AppButton>
            </div>
        </div>
    </Modal>
</template>
