@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="{{asset('/css/home.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="title-block">
            <img src="{{asset('/img/unc-logo.png')}}" width="100px" height="100px">
            <h2 id="home-title">REGISTRAR RECORS AND DOCUMENT MANAGEMENT SYSTEM</h2>
        </div>
    </div>
    <div class="transaction-block">
        <div class="transac-item">
            <a href="#">
                <img src="{{asset('img/option1.jpg')}}" width="250px" height="250px">
            </a>
        </div>
        <div class="transac-item">
            <a href="#">
                <img src="{{asset('img/option3.jpg')}}" width="250px" height="250px">
            </a>
        </div>
        <div class="transac-item">
            <a href="#">
                <img src="{{asset('img/option2.jpg')}}" width="250px" height="250px">
            </a>
        </div>
    </div>
@endsection
