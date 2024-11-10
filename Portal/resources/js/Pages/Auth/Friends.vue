<script setup>

import { useForm } from '@inertiajs/vue3';
import ConfirmButton from '../Components/ConfirmButton.vue';
import FilterInput from '../Components/FilterInput.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import VerticalSeparator from '../Components/VerticalSeparator.vue';

const form = useForm({
    Name: ""
})

const props = defineProps({
    users: Array
})

const submit = () => {
    console.log(form.Name)
    form.post(route('friends.findUser'))
}

</script>

<template>

<Head>
    <title> | Lista znajomych</title>
</Head>

    <PageFloatContainer>
        <div class="flex flex-row justify-between items-center">
            <p class="text-lg">Lista znajomych</p>
            <form @submit.prevent="submit" class="flex flex-row space-x-2">
                <FilterInput label="Wyszukaj po nazwie użytkownika" type="text" v-model="form.Name" name="Username"></FilterInput>
                <ConfirmButton>Szukaj</ConfirmButton>
            </form>
        </div>
        <VerticalSeparator></VerticalSeparator>
        <table class="table-fixed border-separate w-full">

            <tr v-for="user in props.users">
                <td>Image</td>
                <td>{{ user.name }}</td>
                <td>Usuń</td>
            </tr>
        </table>
    </PageFloatContainer>

</template>
