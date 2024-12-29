<script setup>

import { useForm } from '@inertiajs/vue3';
import ConfirmButton from '../Components/ConfirmButton.vue';
import FilterInput from '../Components/FilterInput.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import HorizontalSeparator from '../Components/HorizontalSeparator.vue';
import PopupMessage from '../Components/PopupMessage.vue';

const form = useForm({
    Name: ""
})

const requestSend = useForm({
    id: null
})

const friendRemove = useForm({
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
    requestSend.post(route('friend.sendRequest', id));
}
const acceptRequest = (id) => {
    requestSend.post(route('friend.accept', id));
}
const rejectRequest = (id) => {
    requestSend.post(route('friend.reject', id));
}

const removeFriend = (id) => {
    form.post(route('friend.remove', id));
}

const resetMessage = () => {
    location.reload();
};

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
                <td v-if="!props.friends.some(e => e.id === user.id) && user.id != $page.props.auth.user.id"><button @click.prevent="sendRequest(user.id)"
                    class="text-white bg-orange-500 hover:bg-orange-700 dark:bg-orange-700 dark:hover:bg-orange-800 py-2 px-4 border border-orange-700  dark:border-orange-800 rounded">
                    Send Friend Request
                </button></td>
                <td v-else-if="props.friends.some(e => e.id === user.id) && user.id != $page.props.auth.user.id"><button @click.prevent="removeFriend(user.id)"
                    class="text-white bg-orange-500 hover:bg-orange-700 dark:bg-orange-700 dark:hover:bg-orange-800 py-2 px-4 border border-orange-700  dark:border-orange-800 rounded">
                    Remove friend
                </button></td>
                <td v-else-if="user.id == $page.props.auth.user.id">It's you</td>
            </tr>
        </table>
    </PageFloatContainer>
    <PopupMessage @closed="resetMessage" v-if="$page.props.flash.message" :message="$page.props.flash.message">
    </PopupMessage>

</template>
