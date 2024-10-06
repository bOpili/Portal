<template>
    <button @click="login" class="btn btn-primary">Zaloguj się</button>
</template>

<script setup>
    function login(){
        // alert('Hello');
        window.location = 'login-form';
    }
</script>
