<script setup>

import { useForm } from '@inertiajs/vue3';
import TextInput from '../Components/TextInput.vue';

const form = useForm({
    email: null,
    password: null,
    remember: null,
})


const submit = () => {
        form.post(route('login'), {
            onError: () => form.reset("password", "remember"),
        })
    }
</script>

<template>
    <Head>
        <title> | Login</title>
        <meta head-key="description" name="description" content="Strona logowania użytkownika"/>
    </Head>
        <div class="flex justify-start my-2 space-x-32">
            <form @submit.prevent="submit" class="w-1/3">
                <h1 class="mb-4 text-xl">Login to an existing account</h1>
                <TextInput name="Email" type="email" v-model="form.email" :message="form.errors.email"></TextInput>
                <TextInput name="Password" type="password" v-model="form.password" :message="form.errors.password"></TextInput>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="remember" v-model="form.remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <p>Already a user? <a :href="route('register')" class="text-orange-500 font-bold">Register</a></p>
                </div>
                <div class="mt-4">
                    <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 border border-orange-700 rounded" :disabled="form.processing">Login</button>
                </div>
            </form>
        </div>
</template>
