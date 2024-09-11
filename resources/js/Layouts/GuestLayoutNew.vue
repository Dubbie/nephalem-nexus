<script setup>
import { IconMicrowaveFilled } from "@tabler/icons-vue";
</script>

<template>
    <div
        class="min-h-svh grid grid-cols-2 items-center pt-6 sm:pt-0 bg-zinc-900"
    >
        <div class="bg-teal-900 h-full"></div>

        <div class="w-full max-w-sm mx-auto px-6 text-zinc-400">
            <div class="flex items-center space-x-6 mb-12">
                <div
                    class="size-12 bg-gradient-to-r from-zinc-800 to-teal-800 rounded-full flex justify-center items-center"
                >
                    <IconMicrowaveFilled
                        stroke-width="2"
                        class="size-6 text-teal-400"
                    />
                </div>
                <p class="text-center text-white text-3xl tracking-tighter">
                    <span class="font-semibold">Nephalem</span>
                    <span class="font-black text-teal-400">Nexus</span>
                </p>
            </div>

            <slot />
        </div>
    </div>
</template>
