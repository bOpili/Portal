<script setup>

import NavButton from '../Components/NavButton.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import VerticalSeparator from '../Components/VerticalSeparator.vue';

defineProps ({
    events: Object,
})

</script>

<template>

    <Head>
        <title> | Wydarzenia</title>
        <meta head-key="description" name="description" content="Strona z wydarzeniami" />
    </Head>

    <PageFloatContainer>
        <div class="flex flex-row justify-between items-center">
            <p class="text-lg">Strona Wydarzenia</p>
            <NavButton routeName="event.create">Stwórz wydarzenie</NavButton>
        </div>
        <VerticalSeparator></VerticalSeparator>
        <div v-if="events.data.length > 0" v-for="events in events.data" :key="event.id">
            {{ events.title }}
        </div>
        <div v-else class="grid grid-cols-1 text-center"><p>Brak wydarzeń</p></div>
    </PageFloatContainer>


</template>
