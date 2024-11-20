<script setup>

import { useForm } from '@inertiajs/vue3';
import TextInput from '../Components/TextInput.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import ConfirmButton from '../Components/ConfirmButton.vue';
import TextareaInput from '../Components/TextareaInput.vue';
import NumberInput from '../Components/NumberInput.vue';
import ImageInput from '../Components/ImageInput.vue';

const form = useForm({
    title: null,
    description: null,
    tags: null,
    slots: null,
    game: null,
    image: null,
    date: null,
})


const submit = () => {
    form.post(route('event.store'))
}


</script>

<template>

    <Head>
        <title> | Stwórz wydarzenie</title>
        <meta head-key="description" name="description" content="Strona rejestracji nowego użytkownika" />
    </Head>
    <PageFloatContainer>
        <div class="flex justify-center my-2 space-x-32 mx-14">
            <form @submit.prevent="submit" class="grid grid-cols-2 w-full gap-3">
                <h1 class="col-span-2 justify-self-center mb-4 text-xl">Stwórz wydarzenie</h1>
                <TextInput class="col-span-2" name="Title" v-model="form.title" :message="form.errors.title" label="Nazwa wydarzenia"></TextInput>
                <TextareaInput v-model="form.description" :message="form.errors.description" label="Opis"></TextareaInput>
                <ImageInput @image="(e) => form.image = e"></ImageInput>
                <TextInput name="Tags" type="text" v-model="form.tags" label="Wpisz tagi oddzielone przecinkiem"></TextInput>
                <TextInput name="Game" type="text" v-model="form.game" label="W jakiej grze odbywa się wydarzenie"></TextInput>
                <TextInput name="Date" type="datetime-local" v-model="form.date" label="Kiedy odbywa się wydarzenie"></TextInput>
                <NumberInput name="Slots" v-model="form.slots" :message="form.errors.slots" label="Liczba miejsc"></NumberInput>
                <div class="justify-self-center mt-4 col-span-2">
                    <ConfirmButton :disabled="form.processing">Potwierdź</ConfirmButton>
                </div>
            </form>
        </div>
    </PageFloatContainer>

</template>
