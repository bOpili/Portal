<script setup>
    defineProps({
        routeName: String,
        method: String,
        pageComp: String,
    })
</script>

<template>
    <Link :href="route(routeName)" :method="method ? (method) : ''" preserve-scroll
        class="text-center text-nowrap ring-1 ring-amber-800 min-w-32 p-2 rounded-lg shadow-lg hover:bg-orange-600 dark:hover:bg-orange-800 hover:ring-amber-400 dark:hover:ring-amber-600"
        :class="{ 'bg-orange-600 dark:bg-orange-800': $page.component.includes(pageComp) }">
        <slot />
    </Link>
</template>
