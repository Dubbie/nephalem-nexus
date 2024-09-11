<script setup>
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import AppButton from "@/Components/AppButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { IconInfoCircle } from "@tabler/icons-vue";
import InputError from "@/Components/InputError.vue";
import SelectInput from "./SelectInput.vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});

const classOptions = usePage().props.classes.map((c) => {
    return { value: c.id.toString(), label: c.name };
});

const form = useForm({
    name: "",
    class_id: null,
});

const submit = () => {
    form.post(route("build.store"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Modal :show="show" @close="$emit('close')" max-width="md">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-white">New Guide</h2>
            <p class="text-sm font-mediu text-zinc-500 mb-6">
                Are you ready to show how it's done?
            </p>

            <div class="space-y-3">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 text-sm block w-full"
                        v-model="form.name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="class" value="Class" />
                    <SelectInput
                        class="mt-1"
                        v-model="form.class_id"
                        :options="classOptions"
                    />

                    <InputError class="mt-2" :message="form.errors.class_id" />
                </div>

                <div
                    class="p-2 bg-blue-500/15 text-blue-400 rounded-lg flex space-x-2"
                >
                    <div>
                        <IconInfoCircle class="size-5" />
                    </div>
                    <p class="text-sm font-medium">
                        The guide will be invisible until you publish it.
                    </p>
                </div>
            </div>

            <div class="flex justify-end space-x-2 mt-6">
                <AppButton
                    plain
                    color="white"
                    :disabled="form.processing"
                    @click="$emit('close')"
                    >Cancel</AppButton
                >
                <AppButton
                    color="white"
                    @click="submit"
                    :disabled="form.processing"
                    >Let's start</AppButton
                >
            </div>
        </div>
    </Modal>
</template>
