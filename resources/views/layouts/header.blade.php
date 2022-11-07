<header class="mb-2">
    <nav class="navbar navbar-expand">
        <div class="container w-75">
            <div class="navbar-brand d-flex align-items-center">
                <a 
                @if(Auth::user()->account_role == 'admin')
                    href="{{route('adminHome')}}"
                @elseif(Auth::user()->account_role == 'student')
                    href="{{route('StudRequest')}}"
                @else
                    href="{{route('home')}}"
                @endif
                >
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
                            <a class="dropdown-item" href="{{route('accountHome')}}">Manage Account</a>

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