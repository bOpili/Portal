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
        <PageFloatContainer>
            <p>{{ $page.props.flash.message ? ($page.props.flash.message + ' ' + $page.props.auth.user.name):('')}}</p>
            <h1>Strona główna</h1>
            <EventCalendar :events="events ? events : []"></EventCalendar>
        </PageFloatContainer>
    </div>
</template>
