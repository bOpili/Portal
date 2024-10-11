<script setup>

import { useForm } from '@inertiajs/vue3';
import TextInput from '../Components/TextInput.vue';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})


const submit = () => {
        form.post(route('register'), {
            onError: () => form.reset("password", "password_confirmation"),
        })
    }
</script>

<template>
    <Head>
        <title> | {{ $page.component }}</title>
        <meta head-key="description" name="description" content="Strona rejestracji nowego użytkownika"/>
    </Head>
    <div>

        <div class="flex justify-start my-2 space-x-32">
            <div>
                <h1 class="mb-4 text-xl">Register new account</h1>
                <form @submit.prevent="submit">
                    <TextInput name="Username" v-model="form.name" :message="form.errors.name"></TextInput>
                    <TextInput name="Email" type="email" v-model="form.email" :message="form.errors.email"></TextInput>
                    <TextInput name="Password" type="password" v-model="form.password" :message="form.errors.password"></TextInput>
                    <TextInput name="Confirm password" type="password" v-model="form.password_confirmation"></TextInput>
                    <div class="mt-4">
                        <h1 class="mb-4">Already a user? <a href="" class="text-orange-500 font-bold">Login</a></h1>
                    </div>
                    <div class="mt-4">
                        <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 border border-orange-700 rounded" :disabled="form.processing">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>
