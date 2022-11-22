@extends('layouts.app')

@section('content')
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="col-7 d-flex align-items-center">
            <div class="row">
                <h1>
                    404 - PAGE NOT FOUND
                </h1>
                <h6>
                    Uh oh! We can't seem to find the page you are looking for. Are you sure
                    you have entered the correct URL? Try going back to previous page.
                </h6>
                <div class="col">
                    <button class="btn btn-sm btn-outline-success" onclick="history.back()">Go Back</button>
                </div>
            </div>
        </div>
        <div class="col-4">
            <img class="img-fluid"src="{{asset('/img/404.jpg')}}" alt="">
        </div>
    </div>
@endsection