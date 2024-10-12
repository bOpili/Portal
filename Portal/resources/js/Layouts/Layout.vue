<script setup>

import { route } from '../../../vendor/tightenco/ziggy/src/js';

</script>

<template>
    <Head>
        <meta head-key="description" name="description" content="Opis domyślny"/>
    </Head>
    <div>
        <header class="bg-orange-700  text-xl">
            <nav class="flex items-center justify-between p-4 mx-5 space-x-5">
                <div class="flex space-x-6">
                    <Link
                    :href="route('home')"
                    preserve-scroll
                    class="text-center ring-1 ring-amber-800 w-32 p-2 rounded-lg shadow-lg hover:bg-orange-800"
                    :class="{'bg-orange-800':$page.component === 'Home'}">
                        Home
                    </Link>
                </div>
                <div v-if="$page.props.auth.user" class="flex justify-between space-x-5">
                    <Link
                    :href="route('dashboard')"
                    preserve-scroll
                    class="text-center ring-1 ring-amber-800 w-32 p-2 rounded-lg shadow-lg hover:bg-orange-800"
                    :class="{'bg-orange-800':$page.component === 'Dashboard'}">
                        Profile
                    </Link>
                    <Link
                    :href="route('logout')"
                    method="post"
                    class="text-center ring-1 ring-amber-800 w-32 p-2 rounded-lg shadow-lg hover:bg-orange-800"
                    as="button"
                    type="button"
                    preserve-scroll>
                        Log out
                    </Link>
                </div>
                <div v-else class="flex space-x-6">
                    <Link
                    :href="route('register')"
                    preserve-scroll
                    class="text-center ring-1 ring-amber-800 w-32 p-2 rounded-lg shadow-lg hover:bg-orange-800"
                    :class="{'bg-orange-800':$page.component === 'Auth/Register'}">
                        Register
                    </Link>
                    <Link
                    :href="route('login')"
                    preserve-scroll
                    class="text-center ring-1 ring-amber-800 w-32 p-2 rounded-lg shadow-lg hover:bg-orange-800"
                    :class="{'bg-orange-800':$page.component === 'Auth/Login'}">
                        Login
                    </Link>
                </div>
            </nav>
        </header>
        <main class="p-4">
            <slot />
        </main>
    </div>
</template>
