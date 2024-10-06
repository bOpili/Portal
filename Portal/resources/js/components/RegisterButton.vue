<template>
    <button @click="login" class="btn btn-primary text-center">Zarejestruj się</button>
</template>

<script setup>
    function login(){
        // alert('Hello');
        window.location = 'register-form';
    }
</script>
