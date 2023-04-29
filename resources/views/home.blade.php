@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="view-container">
        <h2 class="text-center">REGISTRAR RECORS AND DOCUMENT MANAGEMENT SYSTEM</h2>
        <div class="grid-container admin-view">
            <div>
                <a href="/stud_cred_mngmnt">
                    <img src="{{ asset('img/option1.jpg') }}" width="250px" height="250px">
                </a>
            </div>
            @if (Auth::user()->account_role == 'rec_assoc')
                <div>
                    <a href="/archived_records">
                        <img src="{{ asset('img/option3.jpg') }}" width="250px" height="250px">
                    </a>
                </div>
            @endif
            @if (Auth::user()->account_role == 'cic')
                <div>
                    <a href="{{ route('cic.request') }}">
                        <img src="{{ asset('img/option2.jpg') }}" width="250px" height="250px">
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
