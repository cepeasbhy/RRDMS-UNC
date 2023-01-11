@extends('layouts.app')

@section('content')
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="row d-flex align-items-center">
            <div class="row">
                <h3>
                    404 - PAGE NOT FOUND
                </h3>
                <h6>
                    Uh oh! We can't seem to find the page you are looking for. Are you sure
                    you have entered the correct URL? Try going back to previous page.
                </h6>
                <div class="col">
                    <a class="btn btn-sm btn-outline-success"
                        @if(Auth::user()->account_role == 'admin')
                            href="{{route('admin.home')}}"
                        @elseif(Auth::user()->account_role == 'student')
                            href="{{route('stud.request')}}"
                        @else
                            href="{{route('home')}}"
                        @endif
                    >
                        Go Back Home
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <img class="img-fluid"src="{{asset('/img/404.jpg')}}" alt="">
        </div>
    </div>
@endsection