@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="homepage">
        <h1>Registrar Records and Document Management System</h1>
        <div class="homepage__tools">
            <a href="/stud_cred_mngmnt">
                <img draggable="false" src="{{ asset('img/option1.jpg') }}" width="250px" height="250px">
            </a>
            @if (Auth::user()->account_role == 'rec_assoc')
                <a href="/archived_records">
                    <img draggable="false" src="{{ asset('img/option3.jpg') }}" width="250px" height="250px">
                </a>
            @endif
            @if (Auth::user()->account_role == 'cic')
                <a href="{{ route('cic.request') }}">
                    <img draggable="false" src="{{ asset('img/option2.jpg') }}" width="250px" height="250px">
                </a>
            @endif
        </div>
    </section>
@endsection
