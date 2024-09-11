<script setup>
import { defineEmits, defineProps } from "vue";

const props = defineProps({
    modelValue: {
        type: Number,
        required: true,
    },
    min: {
        type: Number,
        default: 0,
    },
    max: {
        type: Number,
        default: 100,
    },
    step: {
        type: Number,
        default: 1,
    },
});

const emit = defineEmits(["update:modelValue"]);

const handleInput = (event) => {
    const value = Number(event.target.value);
    emit("update:modelValue", value);
};
</script>

<template>
    <input
        class="block w-full py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none"
        type="range"
        :value="modelValue"
        :min="min"
        :max="max"
        :step="step"
        @input="handleInput"
    />
</template>
