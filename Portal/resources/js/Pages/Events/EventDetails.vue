<script setup>
import { useForm } from '@inertiajs/vue3';
import ConfirmButton from '../Components/ConfirmButton.vue';
import HorizontalSeparator from '../Components/HorizontalSeparator.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import moment from 'moment';
import PopupMessage from '../Components/PopupMessage.vue';


const props = defineProps({
    event: Object,
    users: Array,
    joinMessage: String,
})


const form = useForm({
    eventId: props.event.id,
})

const formattedDate = moment(String(props.event.date)).format('hh:mm DD.MM.YYYY')

const submit = () => {
    form.post(route('event.join'))
}

// Function to reset the message and hide the popup
const resetMessage = () => {
  location.reload();
};

</script>

<template>

    <Head>
        <title> | {{ event.title }}</title>
        <meta head-key="description" name="description" content="Szczegóły wydarzenia" />
    </Head>

    <PageFloatContainer>

        <div class="grid grid-cols-2 space-y-4">
            <h1 class="self-end text-2xl font-bold">{{ event.title }}</h1>
            <h1 class="justify-self-end">Data wydarzenia: {{ formattedDate }}</h1>
            <HorizontalSeparator class="col-span-2"></HorizontalSeparator>
            <img v-if="event.image" :src="'/storage/' + event.image" alt="Event Image" class="object-cover rounded justify-self-center col-span-2 w-1/3"/>
            <HorizontalSeparator class="col-span-2"></HorizontalSeparator>
            <p class="col-span-2">
                <span v-for="tag in event.tags.split(',')" :key="tag"
                    class="inline-block px-2 py-1 rounded-full mr-2 text-sm text-white bg-orange-500  dark:bg-orange-700 border border-orange-700  dark:border-orange-800">
                    {{ tag }}
                </span>
            </p>
            <p class="col-span-2">
                {{ event.description }}
            </p>
            <p class="col-span-2">
                <strong>Gra:</strong> {{ event.game }}
            </p>

            <p>
                <strong>Sloty:</strong> {{ event.users_count + '/' + event.slots }}
            </p>
            <div class="mt-4 justify-self-end">
                <form @submit.prevent="submit">
                    <ConfirmButton>Dołącz</ConfirmButton>
                </form>
            </div>

            <HorizontalSeparator class="col-span-2"></HorizontalSeparator>
            <h1>Uczestnicy:</h1>
                <table class="table-auto border-separate border-spacing-4">
                    <tr v-for="user in props.users" >
                        <td><img class="object-fill ring-1 ring-amber-800 size-11 rounded-full shadow-lg "
                            :src="'/storage/' + user.profilepic" alt="Current user profile picture" /></td>
                        <td>{{ user.name }}</td>
                    </tr>
                </table>

            <PopupMessage @closed="resetMessage" v-if="$page.props.flash.message" :message="$page.props.flash.message"></PopupMessage>
        </div>

    </PageFloatContainer>


</template>
