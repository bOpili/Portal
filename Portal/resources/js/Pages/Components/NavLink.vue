<script setup>
    defineProps({
        routeName: String,
    })

</script>
<template>
    <a :href="route(routeName)" class="text-orange-500 font-bold"><slot /></a>
</template>
