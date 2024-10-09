<script setup>

import { route } from '../../../vendor/tightenco/ziggy/src/js';

</script>

<template>
    <Head>
        <meta head-key="description" name="description" content="Opis domyślny"/>
    </Head>
    <div>
        <header class="bg-indigo-500 text-white">
            <nav class="flex items-center justify-between p-4 max-w-screen-lg mx-auto">
                <div class="space-x-6">
                    <Link :href="route('home')" preserve-scroll>Home</Link>
                    <Link :href="route('register')" preserve-scroll>Register</Link>
                </div>
            </nav>
        </header>
        <main class="p-4">
            <slot />
        </main>
    </div>
</template>
