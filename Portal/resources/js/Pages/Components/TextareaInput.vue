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
    <div class="flex flex-col mt-4 min-w-40 h-96">
        <label :for="name" class="mb-1">{{ label }}</label>
        <textarea
            :class="(message) ? 'rounded-md ring-2 ring-red-500 pl-1 text-stone-700' : 'rounded-md ring-2 ring-stone-700 pl-1 text-stone-700'"
            :name="name" v-model="model" rows="24"/>
        <SessionMessage :status="message"></SessionMessage>
    </div>
</template>
