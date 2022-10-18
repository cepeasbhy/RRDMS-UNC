@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">REGISTRAR RECORS AND DOCUMENT MANAGEMENT SYSTEM</h2>
    </div>
    <div class="row">
        <div class="col">
            <a href="/stud_cred_mngmnt">
                <img src="{{ asset('img/option1.jpg') }}" width="250px" height="250px">
            </a>
        </div>
        <div class="col">
            <a href="/archived_records">
                <img src="{{ asset('img/option3.jpg') }}" width="250px" height="250px">
            </a>
        </div>
        <div class="col">
            <a href="#">
                <img src="{{ asset('img/option2.jpg') }}" width="250px" height="250px">
            </a>
        </div>
    </div>
@endsection
