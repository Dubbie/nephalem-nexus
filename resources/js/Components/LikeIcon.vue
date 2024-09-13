<script setup>
import { useForm } from "@inertiajs/vue3";
import { IconHeart, IconHeartFilled } from "@tabler/icons-vue";
import { computed } from "vue";

const props = defineProps({
    build: Object,
});

const liked = computed(() => {
    return props.build.liked;
});

console.log("liked");
console.log(liked.value);

// TODO: Add like functionality
const submit = () => {
    const form = useForm({});
    form.post(route("build.like", props.build.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <div
        class="cursor-pointer p-2 rounded-xl hover:bg-white/10 inline-flex items-center justify-center"
        :class="{
            'text-zinc-400 hover:text-red-400': !liked,
            'text-red-400': liked,
        }"
        @click="submit"
    >
        <component
            :is="liked ? IconHeartFilled : IconHeart"
            class="size-5"
            stroke-width="2"
        />
    </div>
</template>
