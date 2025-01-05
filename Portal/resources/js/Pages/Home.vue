<script setup>

import EventCalendar from './Components/EventCalendar.vue';
import PageFloatContainer from './Components/PageFloatContainer.vue';

const props = defineProps({
    events: Array,
})
</script>

<template>
    <Head>
        <title> | Strona główna</title>
        <meta head-key="description" name="description" content="Strona główna portalu"/>
    </Head>
    <div>
        <PageFloatContainer v-if="$page.props.auth.user">
            <p v-if="$page.props.flash.message">{{ $page.props.flash.message ? ($page.props.flash.message):('')}}</p>
            <EventCalendar :events="events ? events : []"></EventCalendar>
        </PageFloatContainer>
        <PageFloatContainer v-else>
            <h1>Strona główna</h1>
        </PageFloatContainer>
    </div>
</template>
