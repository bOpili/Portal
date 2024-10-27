<script setup>

const model = defineModel();

defineProps({
    id: String,
})

</script>

<template>
    <div class="flex items-center gap-2">
        <input class="rounded-md" type="checkbox" :id="id" v-model="model">
        <label :for="id"><slot /></label>
    </div>
</template>
