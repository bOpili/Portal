<script setup>
    defineProps({
        routeName: String,
        method: String,
        pageComp: String,
    })
</script>

<template>
    <Link :href="route(routeName)" :method="method ? (method) : ''" preserve-scroll
        class="text-center text-nowrap ring-1 ring-amber-800 min-w-32 p-2 rounded-lg shadow-lg bg-orange-500 hover:bg-orange-700 dark:bg-orange-700 dark:hover:bg-orange-800 hover:ring-amber-400 dark:hover:ring-amber-600 text-white"
        :class="{ 'bg-orange-600 dark:bg-orange-800': $page.component.includes(pageComp) }">
        <slot />
    </Link>
</template>
