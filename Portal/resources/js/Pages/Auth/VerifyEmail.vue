<script setup>

import { useForm } from '@inertiajs/vue3';
import ConfirmButton from '../Components/ConfirmButton.vue';
import PageFloatContainer from '../Components/PageFloatContainer.vue';

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'))
}

defineProps({
    email: String,
    status: String,
})

</script>

<template>

    <Head>
        <title> | Weryfikacja maila</title>
        <meta head-key="description" name="description" content="Strona z informacją o weryfikacji maila" />
    </Head>
    <PageFloatContainer class="text-center">
        <div>
            <p>W celu uzyskania dostępu do tej treści zweryfikuj swój adres email.</p>
            <p class="text-orange-500">{{ $page.props.status }}</p>
        </div>
        <div class="mt-4">
            <form @submit.prevent="submit">
                <ConfirmButton :disabled="form.processing">Wyślij ponownie</ConfirmButton>
            </form>
        </div>
    </PageFloatContainer>

</template>
