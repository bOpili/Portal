<script setup>
</script>

<template>
    <Head>
        <title> | Home page</title>
        <meta head-key="description" name="description" content="Strona główna portalu"/>
    </Head>
    <div>
        <p>{{ $page.props.flash.message ? ($page.props.flash.message + ' ' + $page.props.auth.user.name):('')}}</p>
        <h1>Home page</h1>
    </div>
</template>
