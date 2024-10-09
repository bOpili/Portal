<script setup>

import { reactive } from 'vue';

const form = reactive({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})


const submit = () => {
        console.log(form);
    }

</script>

<template>
    <Head>
        <title> | {{ $page.component }}</title>
        <meta head-key="description" name="description" content="Strona rejestracji nowego użytkownika"/>
    </Head>
    <div>
        <h1>Register new account</h1>
        <div class="w-1/5 flex justify-start my-2">
            <form @submit.prevent="submit">
                <div class="flex mb-4">
                    <label for="username">Name</label>
                    <input class="border-2 border-opacity-25 mx-2 pl-1" id="username" type="text" placeholder="Username" v-model="form.name">
                </div>
                <div class="flex mb-4">
                    <label for="email">Email</label>
                    <input class="border-2 border-opacity-25 mx-2 pl-1" id="email" type="text" placeholder="example@email.com" v-model="form.email">
                </div>
                <div class="flex mb-4">
                    <label for="password">Password</label>
                    <input class="border-2 border-opacity-25 mx-2 pl-1" id="password" type="text" v-model="form.password">
                </div>
                <div class="flex mb-4">
                    <label for="confPassword">Confirm password</label>
                    <input class="border-2 border-opacity-25 mx-2 pl-1" id="confPassword" type="text" v-model="form.password_confirmation">
                </div>
                <div class="mb-4">
                    <p class="mb-2">Already a user? <a href="">Login</a></p>
                    <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 border border-orange-700 rounded">Register</button>
                </div>
            </form>
        </div>
    </div>
</template>
