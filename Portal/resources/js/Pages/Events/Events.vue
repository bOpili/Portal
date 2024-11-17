<script setup>

import EventCard from '../Components/EventCard.vue';
import NavButton from '../Components/NavButton.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import PopupMessage from '../Components/PopupMessage.vue';
import VerticalSeparator from '../Components/VerticalSeparator.vue';


defineProps({
    events: Object,
    joinMessage: String,
})



// Function to reset the message and hide the popup
const resetMessage = () => {
  location.reload();
};

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
        <div class="flex flex-row flex-wrap grow-0 gap-4 justify-around justify-items-center">
            <div v-if="events.data.length > 0" v-for="event in events.data" :key="event.id">
                <EventCard :event="event"></EventCard>
            </div>
            <div v-else class="grid grid-cols-1 text-center">
                <p>Brak wydarzeń</p>
            </div>
        </div>

        <PopupMessage @closed="resetMessage" v-if="joinMessage" :message="joinMessage"></PopupMessage>


    </PageFloatContainer>


</template>
