<script setup></script>

<template>
    <div class="grid grid-cols-4 gap-6">
        <div v-for="i in 6" :key="i" class="ring-2 rounded-xl ring-transparent">
            <div class="bg-zinc-800 rounded-xl px-4 py-6 select-none">
                <p class="text-lg font-bold opacity-0">b</p>
                <div class="flex items-center justify-between">
                    <p class="text-sm text-zinc-400 font-semibold opacity-0">
                        c
                    </p>
                    <div class="flex space-x-2 items-center">
                        <p
                            class="text-xs text-zinc-500 font-semibold opacity-0"
                        >
                            a
                        </p>
                        <div class="size-4 rounded-md" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
