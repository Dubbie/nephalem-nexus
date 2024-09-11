<script setup>
const model = defineModel();

const classData = [
    {
        name: "Amazon",
        id: 1,
        left: "left-[6.6%]",
        disabled: false,
    },
    {
        name: "Assassin",
        id: 2,
        left: "left-[19.5%]",
        disabled: false,
    },
    {
        name: "Necromancer",
        id: 5,
        left: "left-[31.5%]",
        disabled: false,
    },
    {
        name: "Barbarian",
        id: 3,
        left: "left-[45%]",
        disabled: false,
    },
    {
        name: "Paladin",
        id: 6,
        left: "left-[60%]",
        disabled: false,
    },
    {
        name: "Sorceress",
        id: 7,
        left: "left-[71.5%]",
        disabled: false,
    },
    {
        name: "Druid",
        id: 4,
        left: "left-[84%]",
        disabled: false,
    },
];

const handleUpdate = (id) => {
    const diabloClass = classData.find((c) => c.id === id);
    if (diabloClass.disabled) {
        return;
    }
    model.value = id;
};
</script>

<template>
    <div class="relative">
        <img src="/img/classes.jpeg" alt="" class="block rounded-xl" />

        <div
            v-for="diabloClass in classData"
            :key="diabloClass.id"
            class="absolute top-[16%] h-3/4 w-24 px-3 cursor-pointer group"
            :class="diabloClass.left"
            @click="handleUpdate(diabloClass.id)"
        >
            <div
                class="absolute top-12 bottom-6 inset-x-0 z-0 blur-xl"
                :class="{
                    'bg-black/50 transition mix-blend-soft-light group-hover:bg-white/50':
                        model !== diabloClass.id && !diabloClass.disabled,
                    'bg-black mix-blend-hard-light':
                        model !== diabloClass.id && diabloClass.disabled,
                    'bg-white/20 mix-blend-soft-light':
                        model === diabloClass.id,
                }"
            ></div>
            <div
                class="absolute top-0 inset-x-0 bg-black/60 flex flex-col items-center mx-2"
                :class="{
                    'transition group-hover:bg-yellow-800/50':
                        model !== diabloClass.id && !diabloClass.disabled,
                    'text-white/20':
                        model !== diabloClass.id && diabloClass.disabled,
                    'text-lime-500': model === diabloClass.id,
                }"
            >
                <p class="font-bold text-sm text-center transition">
                    {{ diabloClass.name }}
                </p>
                <p
                    class="text-xs text-white/50"
                    v-if="model === diabloClass.id"
                >
                    (Selected)
                </p>
                <p
                    class="text-xs text-red-500/50"
                    v-if="model !== diabloClass.id && diabloClass.disabled"
                >
                    (Disabled)
                </p>
            </div>
        </div>
    </div>
</template>
