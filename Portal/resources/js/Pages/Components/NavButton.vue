<script setup>
    defineProps({
        routeName: String,
        text: String,
        method: String,
    })
</script>

<template>
    <Link :href="route(routeName)" :method="method ? (method) : ''" preserve-scroll
        class="text-center ring-1 ring-amber-800 w-32 p-2 rounded-lg shadow-lg hover:bg-orange-800 hover:ring-amber-600"
        :class="{ 'bg-orange-800': $page.component === text }">
    {{text}}
    </Link>
</template>
