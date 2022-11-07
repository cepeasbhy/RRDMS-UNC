@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="col mb-4">
                <h2 class="text-center">Online Request for School Records</h2>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <form id="searchRequest" action="" method="post">
                        <input class="form-control form-control-sm"type="text" name="search" id="" required>
                    </form>
                </div>
                <div class="col-6">
                    <div class="row justify-content-center">
                        <div class="col-7">
                            <button class="btn btn-success btn-sm w-100" form="searchRequest">SEARCH REQUEST</button>
                        </div>
                        <div class="col-5">
                            <a href="{{route('stud.makeRequest')}}" class="btn btn-danger btn-sm w-100">REQUEST</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row">
                <div class="col-6">
                    <div class="row border-start border-danger border-4">
                        <h5 class="my-auto">PREVIOUS TRANSACTIONS</h5>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row border-start border-danger border-4">
                        <h5 class="my-auto">PENDING TRANSACTIONS</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection