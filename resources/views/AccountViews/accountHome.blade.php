@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <div class="row w-50">
        <div class="col">
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">ACCOUNT INFORMATION</h4>
            </div>
            <span class="badge bg-success mb-2">{{session('msg')}}</span>
            <div class="ms-3 mt-3">
                <div class="mb-3">
                    <div class="row align-items-center mb-3">
                        <img class="col-3 img-fluid rounded-circle student-pic" src="{{asset('storage/'.$picturePath->$columnName)}}">
                        <div class="col-9">
                            <span class="h4 fw-bold">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                            <br>
                            <span>{{Auth::user()->user_id}}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <form id="accountUpdateForm" action="{{route('accountUpdate', ['id' => Auth::user()->user_id])}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="col-form-label col-form-label-sm" for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" type="text" value="{{Auth::user()->email}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="col-form-label col-form-label-sm" for="phone_number">Phone Number</label>
                                <input id="phone_number" name="phoneNumber" class="form-control form-control-sm @error('phoneNumber') is-invalid @enderror" type="text" value="{{Auth::user()->phone_number}}">
                                @error('phoneNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </form>
                        <div class="mb-3 row gap-3">
                            <button class="col btn btn-success btn-sm" form="accountUpdateForm">Update Information</button>
                            <button class="col btn btn-danger btn-sm">Update Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
