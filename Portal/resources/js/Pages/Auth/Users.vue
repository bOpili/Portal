<script setup>

import { useForm } from '@inertiajs/vue3';
import ConfirmButton from '../Components/ConfirmButton.vue';
import FilterInput from '../Components/FilterInput.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import HorizontalSeparator from '../Components/HorizontalSeparator.vue';

const form = useForm({
    Name: ""
})

const props = defineProps({
    users: Array
})

const submit = () => {
    console.log(form.Name)
    form.post(route('users.findUser'))
}

</script>

<template>

<Head>
    <title> | Lista użytkowników</title>
</Head>

    <PageFloatContainer>
        <div class="flex flex-row justify-between items-center">
            <p class="text-lg">Lista użytkowników</p>
            <form @submit.prevent="submit" class="flex flex-row space-x-2">
                <FilterInput label="Wyszukaj po nazwie użytkownika" type="text" v-model="form.Name" name="Username"></FilterInput>
                <ConfirmButton>Szukaj</ConfirmButton>
            </form>
        </div>
        <HorizontalSeparator></HorizontalSeparator>
        <table class="table-auto border-separate border-spacing-4">
            <tr v-for="user in props.users" >
                <td><img class="object-fill ring-1 ring-amber-800 size-11 rounded-full shadow-lg "
                    :src="'storage/' + user.profilepic" alt="Current user profile picture" /></td>
                <td>{{ user.name }}</td>
                <td>Akcja buttons</td>
            </tr>
        </table>
    </PageFloatContainer>

</template>
