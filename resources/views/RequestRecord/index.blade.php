@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center mb-3">
            <div class="col-2">
                <img src="{{asset('/img/unc-logo.png')}}" alt="" width="100px" height="100px">
            </div>
            <div class="col-8 border-start border-danger border-4">
                <h1 class="ms-3">ONLINE REQUEST FOR SCHOOL RECORDS</h1>
            </div>
        </div>
        <div class="d-flex justify-content-center w-100">
           <form id="searchRequestForm" class="p-2 w-50"action="">
                <input class="form-control" type="text">
           </form>
           <div class="p-2">
                <button class="btn btn-success w-100">SEARCH</button>
           </div>
           <div class="p-2">
                <a href="{{route('makeRequest')}}" class="btn btn-danger w-100">REQUEST</a>
           </div>
        </div>
    </div>

@endsection