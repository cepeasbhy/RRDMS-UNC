@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="{{asset('/css/home.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="title-block">
            <img src="{{asset('/img/unc-logo.png')}}" width="100px" height="100px">
            <h1 id="home-title">REGISTRAR RECORS AND DOCUMENT MANAGEMENT SYSTEM</h1>
        </div>
    </div>
@endsection
