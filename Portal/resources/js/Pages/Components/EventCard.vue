<script setup>
import { defineProps } from "vue";
import ConfirmButton from "./ConfirmButton.vue";
import { useForm } from "@inertiajs/vue3";



const submit = () => {
    form.post(route('event.join'))
}

const props = defineProps({
    joinMessage: String,
    event: Object,
});

const form = useForm({
    eventId: props.event.id,
})

const parsedTags = props.event.tags.split(",").map(tag => tag.trim());
</script>

<style scoped>
.event-card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.tags span {
    display: inline-block;
}
</style>


<template>
    <div class="event-card border-2 rounded-lg shadow-md p-4 border-orange-700  dark:border-orange-800 bg-zinc-100 dark:bg-stone-500 w-80 h-full">
        <!-- Event Image -->
        <div v-if="event.image" class="event-image mb-4">
            <img :src="'storage/' + event.image" alt="Event Image"
                class="w-full h-48 object-cover rounded-lg border border-black" />
        </div>

        <!-- Event Details -->
        <div class="grid grid-cols-1 event-details">
            <!-- Title -->
            <h2 class="text-2xl font-semibold mb-2">{{ event.title }}</h2>

            <!-- Tags -->
            <div class="tags flex flex-wrap gap-2 mb-4">
                <span v-for="(tag, index) in parsedTags" :key="index"
                    class="text-sm text-white bg-orange-500 hover:bg-orange-700 dark:bg-orange-700 dark:hover:bg-orange-800 border border-orange-700  dark:border-orange-800 px-2 py-1 rounded ">
                    {{ tag }}
                </span>
            </div>

            <!-- Slots and Game -->
            <div class="flex justify-between items-center ">
                <span><strong>Sloty:</strong> {{ event.users_count + '/' + event.slots }}</span>
                <span><strong>Gra:</strong> {{ event.game }}</span>
            </div>
            <div class="mt-4">
                <form @submit.prevent="submit">
                    <ConfirmButton>Dołącz</ConfirmButton>
                </form>
            </div>
        </div>
    </div>
</template>


