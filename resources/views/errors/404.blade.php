@extends('layouts.app')

@section('content')
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="row d-flex align-items-center">
            <div class="row">
                <h1>
                    404 - PAGE NOT FOUND
                </h1>
                <h2>
                    Uh oh! We can't seem to find the page you are looking for. Are you sure
                    you have entered the correct URL?
                </h2>
                <div class="col">
                    <a class="btn btn-sm btn-outline-success" href="/login">Go Back Home</a>
                </div>
            </div>
        </div>
        <div class="row">
            <img class="img-fluid"src="{{asset('/img/404.jpg')}}" alt="">
        </div>
    </div>
@endsection
