<script setup>
import Modal from "@/Components/Modal.vue";
import AppButton from "@/Components/AppButton.vue";
import { inject, onMounted, onUnmounted, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextareaInput from "./TextareaInput.vue";

const show = ref(false);
const build = ref(null);
const emitter = inject("emitter");

const form = useForm({
    reason: "",
});

const hideModal = () => {
    show.value = false;
    build.value = null;
};

const submit = () => {
    form.post(route("build.decline", build.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            hideModal();
            form.reset();
        },
    });
};

onMounted(() => {
    emitter.on("close-decline-guide-modal", () => {
        hideModal();
    });

    emitter.on("open-decline-guide-modal", (_build) => {
        show.value = true;
        build.value = _build;
        form.reason = "";
    });
});

onUnmounted(() => {
    emitter.off("close-decline-guide-modal");
    emitter.off("open-decline-guide-modal");
});
</script>

<template>
    <Modal :show="show" max-width="md">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-white mb-3">Decline Guide</h2>
            <p class="text-sm font-medium text-zinc-500 mb-1">
                Tell us why you are declining this guide.
            </p>

            <TextareaInput class="text-sm w-full" v-model="form.reason" />

            <div class="flex justify-end items-center space-x-1 mt-6">
                <AppButton plain @click="hideModal"> Cancel </AppButton>
                <AppButton color="red" @click="submit"> Decline </AppButton>
            </div>
        </div>
    </Modal>
</template>
