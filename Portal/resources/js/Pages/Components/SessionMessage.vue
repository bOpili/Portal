<script setup>

defineProps ({
    status: String
})

</script>

<template>

    <p class="text-red-500 mt-1" v-if="status">{{ status }}</p>

</template>
