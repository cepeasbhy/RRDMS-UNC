@extends('layouts.app')
@extends('layouts.header')

@section('content')
<div class="mt-3">
    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-header fw-bold">
                    ACCOUNT SETUP
                    <br>
                    <span class="badge bg-danger mb-2">{{ session('msg') }}</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('stud.finishSetup')}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Current Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" name="address" required>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone-number" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" value="{{old('phoneNumber')}}" name="phoneNumber" required>

                                @error('phoneNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="confirm-password" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="confirm-password" type="password" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">

                                @error('password_confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-danger fw-bold btn-sm w-100">
                                    {{ __('Finish Account Setup') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection