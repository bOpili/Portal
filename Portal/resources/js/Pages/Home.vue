<script setup>

import EventDateSelector from './Components/EventDateSelector.vue';
import PageFloatContainer from './Components/PageFloatContainer.vue';
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
            <EventDateSelector></EventDateSelector>
        </PageFloatContainer>
    </div>
</template>
