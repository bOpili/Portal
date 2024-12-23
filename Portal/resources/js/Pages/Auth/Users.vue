<script setup>

import { useForm } from '@inertiajs/vue3';
import ConfirmButton from '../Components/ConfirmButton.vue';
import FilterInput from '../Components/FilterInput.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import HorizontalSeparator from '../Components/HorizontalSeparator.vue';

const form = useForm({
    Name: ""
})

const requestSend = useForm({
    id: null
})

const props = defineProps({
    users: Array,
    requests: Array,
    friends: Array,
})

const submit = () => {
    form.post(route('users.findUser'))
}

const sendRequest = (id) => {
    requestSend.post(route('friend.sendRequest',id));
}
const acceptRequest = (id) => {
    requestSend.post(route('friend.accept',id));
}
const rejectRequest = (id) => {
    requestSend.post(route('friend.reject',id));
}

console.log(props.friends)

</script>

<template>

    <Head>
        <title> | Lista użytkowników</title>
    </Head>

    <PageFloatContainer>
        <div class="flex flex-row justify-between items-center">
            <p class="text-lg">Friends list</p>
            <form @submit.prevent="submit" class="flex flex-row space-x-2">
                <FilterInput label="Find user by name" type="text" v-model="form.Name" name="Username">
                </FilterInput>
                <ConfirmButton>Search</ConfirmButton>
            </form>
        </div>
        <HorizontalSeparator v-if="props.requests"></HorizontalSeparator>
        <table class="table-auto border-separate border-spacing-4">
            <tr v-for="request in props.requests">
                <td><img class="object-fill ring-1 ring-amber-800 size-11 rounded-full shadow-lg "
                        :src="'storage/' + request.sender.profilepic" alt="Request sneder profile picture" /></td>
                <td>{{ request.sender.name }}</td>
                <td>
                    <button @click="acceptRequest(request.id)">Accept</button>

                </td>
                <td><button @click="rejectRequest(request.id)">Reject</button></td>
            </tr>
        </table>
        <HorizontalSeparator></HorizontalSeparator>
        <table class="table-auto border-separate border-spacing-4">
            <tr v-for="user in props.users">
                <td><img class="object-fill ring-1 ring-amber-800 size-11 rounded-full shadow-lg "
                        :src="'storage/' + user.profilepic" alt="Current user profile picture" /></td>
                <td>{{ user.name }}</td>
                <td>
            <tr><button @click.prevent="sendRequest(user.id)" v-if="!props.friends.some(e => e.id === user.id)">
                    Send Friend Request
                </button>
            </tr>
            </td>
            </tr>
        </table>
    </PageFloatContainer>

</template>
