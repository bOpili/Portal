<script setup>

import SessionMessage from './SessionMessage.vue';
const model = defineModel({
    type: null,
    required: true,
});

defineProps({
    name: {
        type: String,
        required: true,
    },
    message: {
        type: String,
    },
    label: {
        type: String
    },
})
</script>

<template>
    <div class="flex flex-col mt-4">
        <label :for="name" class="mb-1">{{ label }}</label>
        <input
            class="max-w-16"
            :class="(message) ? 'rounded-md ring-2 ring-red-500 pl-1 text-stone-700' : 'rounded-md ring-2 ring-stone-700 pl-1 text-stone-700'"
            :name="name" type="number" v-model="model" min="1" step="1" max="999" value=1 placeholder="1">
        <SessionMessage :status="message"></SessionMessage>
    </div>
</template>
