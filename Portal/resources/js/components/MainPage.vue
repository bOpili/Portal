<template>
    <div class="d-flex flex-column">
        <div class="d-flex flex-row flex-nowrap ">
            <div class="flex-grow-1"><h1 id="header">Wspólne Latanie</h1></div>
            <div class=" align-content-center border"><button type="button" class="btn btn-primary">Zaloguj się</button></div>
        </div>
        <div class="d-flex flex-row flex-nowrap flex-grow-1">
            <div class=""><h1>Lewo</h1></div>
            <div class="flex-grow-1"><h1>Środek</h1></div>
            <div class=""><h1>Prawo</h1></div>
        </div>
        <div class="d-flex flex-row flex-nowrap ">
            <div class="flex-fill"><h1 id="header">Stopisko</h1></div>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component MainPage mounted.')
        }
    }
</script>
