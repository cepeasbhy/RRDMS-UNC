<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    @yield('css-link')
    <title>RRDM-UNC</title>
</head>
<body>
    <header class="p-3">
        <div class="row w-75 mx-auto">
            <div class="col d-flex align-items-center">
                <img src="{{asset('/img/unc-logo.png')}}" width="50px" height="50px">
                <h2 class="ms-2 pt-2">RRDMS-UNC</h2>
            </div>
            <div class="col">

            </div>
        </div>
    </header>
    <div id="container">
        @yield('content')
    </div>
</body>
</html>