<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        @yield('title')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
         @vite(['resources/js/app.js','resources/css/app.css'])

    </head>
    <body class="main" id="app">

        <div class="d-flex flex-column">
            <div class="d-flex flex-row flex-nowrap ">
                <div class="flex-grow-1"><h1 id="header">Wspólne Latanie</h1></div>
                <div class=" align-content-center border"><button type="button" class="btn btn-primary">Zaloguj się</button></div>
            </div>
            <div class="d-flex flex-row flex-nowrap flex-grow-1">
                @yield('body')
            </div>
            <div class="d-flex flex-row flex-nowrap ">
                <div class="flex-fill"><h1 id="header">Stopisko</h1></div>
            </div>

        </div>



    </body>
</html>
