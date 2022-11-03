@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <div class="container">
        <h2 class="text-center">REGISTRAR RECORS AND DOCUMENT MANAGEMENT SYSTEM</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <a href="/stud_cred_mngmnt">
                <img src="{{ asset('img/option1.jpg') }}" width="250px" height="250px">
            </a>
        </div>
        @if (Auth::user()->account_role == 'RECORD_ASSOCIATE')
            <div class="col-4">
                <a href="/archived_records">
                    <img src="{{ asset('img/option3.jpg') }}" width="250px" height="250px">
                </a>
            </div>
        @endif
        @if (Auth::user()->account_role == 'CIC')
            <div class="col-4">
                <a href="/request">
                    <img src="{{ asset('img/option2.jpg') }}" width="250px" height="250px">
                </a>
            </div>
        @endif
    </div>
@endsection
