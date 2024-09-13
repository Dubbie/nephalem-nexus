<script setup>
import { computed, onMounted, ref, watch } from "vue";
import AppButton from "./AppButton.vue";
import { usePage } from "@inertiajs/vue3";
import {
    IconCheck,
    IconExclamationMark,
    IconInfoSquareRounded,
    IconX,
} from "@tabler/icons-vue";

const props = defineProps({
    minWidth: {
        type: String,
        default: "min-w-md",
    },
});

const show = ref(false);

const title = ref("");
const message = ref("");
const type = ref("info");

const resetToast = () => {
    show.value = false;
};

const icon = computed(() => {
    switch (type.value) {
        case "info":
            return IconInfoSquareRounded;
        case "success":
            return IconCheck;
        case "warning":
            return IconExclamationMark;
        case "error":
            return IconX;
    }
});

const iconClasses = computed(() => {
    switch (type.value) {
        case "info":
            return "bg-blue-400/15 text-blue-500";
        case "success":
            return "bg-green-400/15 text-green-500";
        case "warning":
            return "bg-yellow-400/15 text-yellow-500";
        case "error":
            return "bg-red-400/15 text-red-500";
    }
});

const showToast = () => {
    // Show the toast
    show.value = true;

    title.value = usePage().props.toast.title;
    message.value = usePage().props.toast.message;
    type.value = usePage().props.toast.type;

    // Reset the toast
    setTimeout(() => {
        resetToast();
    }, usePage().props.toast.duration);
};

watch(
    () => usePage().props.toast,
    (data) => {
        if (!data) {
            return;
        }

        showToast();
    }
);

onMounted(() => {
    // Check if toast data is there
    if (usePage().props.toast) {
        showToast();
    }
});
</script>

<template>
    <transition
        enter-active-class="transition transform ease-out duration-300"
        enter-from-class="translate-y-full opacity-0"
        enter-to-class="translate-y-0 opacity-100"
        leave-active-class="transition transform ease-in duration-500"
        leave-from-class="translate-x-0 opacity-100"
        leave-to-class="translate-x-full opacity-0"
    >
        <div class="fixed bottom-4 right-4 z-50" v-if="show">
            <div
                class="flex items-start gap-x-12 bg-zinc-800 p-4 rounded-xl ring-1 ring-white/15"
                :class="minWidth"
            >
                <div class="flex space-x-3 items-start">
                    <div
                        class="inline-flex p-1 items-center justify-center rounded-full"
                        :class="iconClasses"
                    >
                        <component :is="icon" class="size-3" stroke-width="3" />
                    </div>
                    <div class="text-sm">
                        <p class="text-white font-bold">{{ title }}</p>
                        <p class="text-zinc-400">{{ message }}</p>
                    </div>
                </div>
                <div>
                    <AppButton outline size="xs" @click="resetToast"
                        >Close</AppButton
                    >
                </div>
            </div>
        </div>
    </transition>
</template>
