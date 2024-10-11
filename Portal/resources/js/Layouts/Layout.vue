<script setup>

import { route } from '../../../vendor/tightenco/ziggy/src/js';

</script>

<template>
    <Head>
        <meta head-key="description" name="description" content="Opis domyślny"/>
    </Head>
    <div>
        <header class="bg-orange-600 text-white text-lg">
            <nav class="flex items-center justify-between p-4">
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
