<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="author" content="rttn-Mango and Asbhy Cepe">
    <meta name="title" content="RRDMS-UNC">
    <meta name="description" content="Registrar Record and Document Management System for University of Nueva Caceres">
    <meta name="language" content="English">
    <meta name="robots" content="index, follow">

    {{-- og:image and og:site_name tba when system is deployed online --}}
    <meta property="og:title" content="RRDMS-UNC">
    <meta property="og:type" content="Website">
    <meta property="og:description" content="Registrar Record and Document Management System for University of Nueva Caceres">
    <meta property="og:locale" content="en_US">

    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('/styles/index.css') }}">
    <script src="{{ asset('/js/tabs.js') }}" defer></script>
    @yield('css-link')
    <title>RRDM-UNC</title>
</head>

<body>
    <main class="">
        <section class="content">
            @yield('content')
        </section>
        <section>
            @yield('request-content')
        </section>
    </main>

</body>

</html>
