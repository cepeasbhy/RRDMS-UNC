<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    @yield('css-link')
    <title>RRDM-UNC</title>
</head>
<body>
    <header>
        <div id="header-wrapper">
            <div id="header-logo">
                <img src="{{asset('/img/unc-logo.png')}}" width="50px" height="50px">
                <h2 id="word-logo">RRDMS-UNC</h2>
            </div>
            <div id="header-nav">

            </div>
        </div>
    </header>
    <div id="container">
        @yield('content')
    </div>
</body>
</html>