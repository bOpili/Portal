<script setup>

import { Link } from '@inertiajs/vue3';
import { route } from '../../../vendor/tightenco/ziggy/src/js';
import { switchTheme } from '../theme';
import NavButton from '../Pages/Components/NavButton.vue';
import NavIcon from '../Pages/Components/NavIcon.vue';

</script>

<template>

    <Head>
        <meta head-key="description" name="description" content="Opis domyślny" />
    </Head>
    <div>
        <header class="bg-orange-500 dark:bg-orange-700  text-xl text-white">
            <nav class="flex flex-wrap items-center justify-between p-2 space-x-5">
                <div class="flex flex-wrap space-x-6">
                    <NavButton routeName="home" pageComp="Home">Strona główna</NavButton>
                    <button @click="switchTheme"
                        class="m-2 text-center ring-1 ring-amber-800 w-11 p-2 rounded-full shadow-lg hover:bg-orange-800 hover:ring-amber-600">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                </div>
                <div class="flex flex-wrap space-x-6">
                    <NavButton routeName="events" text="Wydarzenia" pageComp="Events">Wydarzenia</NavButton>
                </div>
                <div v-if="$page.props.auth.user" class="flex flex-wrap justify-between">
                    <Link :href="route('dashboard')" as="button" preserve-scroll class="content-center">
                    <img class=" m-2 object-fill ring-1 ring-amber-800 size-11 rounded-full hover:bg-orange-800 shadow-lg hover:ring-amber-600"
                        :src="'/storage/' + $page.props.auth.user.profilepic" alt="Current user profile picture" />
                    </Link>
                    <NavIcon routeName="users">
                        <i class="fa-solid fa-users"></i>
                    </NavIcon>
                    <NavButton routeName="logout" method="post">Wyloguj</NavButton>
                </div>
                <div v-else class="flex flex-wrap">
                    <!-- <NavButton routeName="register" text="Rejestracja" pageComp="Register">Rejestracja</NavButton> -->
                    <NavButton routeName="login" text="Logowanie" pageComp="Login">Logowanie</NavButton>
                </div>
            </nav>
        </header>
        <main class="p-4">
            <slot />
        </main>
    </div>
</template>
