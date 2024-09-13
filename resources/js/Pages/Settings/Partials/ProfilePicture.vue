<script setup>
import { useForm } from "@inertiajs/vue3";
import { IconUpload } from "@tabler/icons-vue";
import { ref } from "vue";

const fileInput = ref(null);
const loading = ref(false);

const form = useForm({
    profile_photo: null,
});

const handleFileChange = (event) => {
    form.profile_photo = event.target.files[0];

    form.post(route("settings.profile.update.photo"), {
        onStart: () => {
            loading.value = true;
        },
        onSuccess: () => form.reset(),
        onFinish: () => {
            loading.value = false;
        },
    });
};
</script>

<template>
    <div>
        <div class="grid grid-cols-3 gap-6">
            <div>
                <p class="font-bold">Your picture</p>
                <p class="text-zinc-400 text-sm">
                    This will be displayed on your profile.
                </p>
            </div>

            <div class="col-span-2">
                <div class="flex items-start space-x-6">
                    <img
                        :src="$page.props.auth.user.profile_photo_url"
                        alt="Profile picture"
                        class="rounded-2xl size-24"
                        :class="{
                            'opacity-60': loading,
                        }"
                    />

                    <div
                        class="relative cursor-pointer flex-1 ring-2 ring-white/10 flex flex-col items-center rounded-2xl p-6 group hover:ring-indigo-500"
                        @click="fileInput.click()"
                        :class="{
                            'pointer-events-none opacity-60': loading,
                        }"
                    >
                        <div
                            class="ring-1 ring-white/10 p-2.5 flex justify-center items-center rounded-xl mb-4 group-hover:bg-white/5 group-hover:ring-white/20"
                        >
                            <IconUpload class="size-6" />
                        </div>

                        <p class="text-zinc-400">
                            <b>Click to upload</b> or drag and drop
                        </p>
                        <p class="text-zinc-400 text-sm">
                            SVG, PNG or JPG (max. 500x500px)
                        </p>

                        <input
                            type="file"
                            ref="fileInput"
                            class="h-0 absolute left-0 bottom-0"
                            @change="handleFileChange"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
