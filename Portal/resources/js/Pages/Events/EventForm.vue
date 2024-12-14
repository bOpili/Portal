<script setup>
import { ref } from 'vue';

import { useForm } from '@inertiajs/vue3';
import TextInput from '../Components/TextInput.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import ConfirmButton from '../Components/ConfirmButton.vue';
import TextareaInput from '../Components/TextareaInput.vue';
import NumberInput from '../Components/NumberInput.vue';
import ImageInput from '../Components/ImageInput.vue';
import SelectInput from '../Components/SelectInput.vue';
import TagSelector from '../Components/TagSelector.vue';
import EventDateSelector from '../Components/EventDateSelector.vue';

const form = useForm({
    title: null,
    description: null,
    tags: null,
    slots: null,
    game_id: null,
    image: null,
    date: null,
})

const selectedPeriod = ref(null)

const submit = () => {
    form.post(route('event.store'))
}

const handleTagSubmit = (selectedTags) => {
    form.tags = selectedTags;
}

const handleSelectedPeriod = (period) => {
    selectedPeriod.value = period;
    console.log('Selected Period:', period);
};


defineProps({
    games: {
        type: Array
    },
    tags: {
        type: Array
    },
})

</script>

<template>

    <Head>
        <title> | Stwórz wydarzenie</title>
        <meta head-key="description" name="description" content="Strona rejestracji nowego użytkownika" />
    </Head>
    <PageFloatContainer>
        <div class="flex justify-center my-2 space-x-32 mx-14">
            <form @submit.prevent="submit" class="grid grid-cols-3 w-full gap-3">
                <h1 class="col-span-3 justify-self-center mb-4 text-xl">Stwórz wydarzenie</h1>
                <TextInput class="col-span-3" name="Title" v-model="form.title" :message="form.errors.title"
                    label="Nazwa wydarzenia"></TextInput>
                <TextareaInput class="col-span-2" name="Opis" v-model="form.description"
                    :message="form.errors.description" label="Opis"></TextareaInput>
                <ImageInput @image="(e) => form.image = e"></ImageInput>
                <TagSelector label="Wybierz tagi" :tags="tags" @confirmTags="handleTagSubmit"></TagSelector>
                <SelectInput name="Game" :options="games" v-model="form.game_id"
                    label="W jakiej grze odbywa się wydarzenie"></SelectInput>
                <NumberInput name="Slots" v-model="form.slots" :message="form.errors.slots" label="Liczba miejsc">
                </NumberInput>
                <!-- <TextInput name="Date" type="datetime-local" v-model="form.date" label="Kiedy odbywa się wydarzenie"></TextInput> -->
                <EventDateSelector class="col-span-3" @selected-period="handleSelectedPeriod"></EventDateSelector>
                <div v-if="selectedPeriod" class="mt-4 p-4 border rounded bg-gray-100">
                    <h2 class="font-semibold">Selected Period:</h2>
                    <p>
                        <strong>Start:</strong> {{ selectedPeriod.startDate }}
                    </p>
                    <p>
                        <strong>End:</strong> {{ selectedPeriod.endDate }}
                    </p>
                    <p>
                        <strong>Duration:</strong> {{ selectedPeriod.duration }} minutes
                    </p>
                </div>
                <div class="justify-self-center mt-4 col-span-3">
                    <ConfirmButton :disabled="form.processing">Potwierdź</ConfirmButton>
                </div>
            </form>
        </div>
    </PageFloatContainer>

</template>
