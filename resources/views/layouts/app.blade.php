<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
    @yield('css-link')
    <title>RRDM-UNC</title>
</head>

<body>
    <header class="mb-2">
        <nav class="navbar navbar-expand">
            <div class="container w-75">
                <div class="navbar-brand d-flex align-items-center">
                    <a href="/">
                        <img src="{{ asset('img/unc-logo.png') }}" width="50px" height="50px">
                    </a>
                    <div>
                        <span class="h3 ms-2">UNC-RRDMS</span>
                    </div>
                </div>
                <ul class="navbar-nav list-unstyled">
                    @guest
                        <!---
                        <li class="nav-item ps-2">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('login') }}">LOGIN</a>
                        </li>
                        <li class="nav-item ps-2">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('register') }}">REGISTER</a>
                        </li>
                        --->
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    
                </ul>
            </div>
        </nav>
    </header>
    <div id="container">
        @yield('content')
    </div>
</body>

</html>
