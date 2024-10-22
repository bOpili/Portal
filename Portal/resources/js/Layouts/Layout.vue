<script setup>

import { Link } from '@inertiajs/vue3';
import { route } from '../../../vendor/tightenco/ziggy/src/js';
import { switchTheme } from '../theme';
import NavButton from '../Pages/Components/NavButton.vue';

</script>

<template>

    <Head>
        <meta head-key="description" name="description" content="Opis domyślny" />
    </Head>
    <div>
        <header class="bg-orange-700  text-xl text-zinc-200">
            <nav class="flex items-center justify-between p-4 mx-5 space-x-5">
                <div class="flex space-x-6">
                    <NavButton routeName="home" text="Home"></NavButton>
                    <button @click="switchTheme"
                        class="text-center ring-1 ring-amber-800 w-11 p-2 rounded-full shadow-lg hover:bg-orange-800 hover:ring-amber-600">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                </div>
                <div v-if="$page.props.auth.user" class="flex justify-between space-x-5">
                    <Link :href="route('dashboard')" preserve-scroll class="content-center ">
                    <img class="object-fill ring-1 ring-amber-800 size-11 rounded-full bg-orange-700 shadow-lg hover:ring-amber-600"
                        :src="'storage/' + $page.props.auth.user.profilepic" alt="Current user profile picture" />
                    </Link>
                    <NavButton routeName="logout" text="Logout" method="post"></NavButton>
                </div>
                <div v-else class="flex space-x-6">
                    <NavButton routeName="register" text="Register"></NavButton>
                    <NavButton routeName="login" text="Login"></NavButton>
                </div>
            </nav>
        </header>
        <main class="p-4">
            <slot />
        </main>
    </div>
</template>
