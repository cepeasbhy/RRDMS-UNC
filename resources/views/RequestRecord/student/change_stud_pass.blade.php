@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="view-container">

        <div class="form-block">
            <div class="form-block-header">
                <h5>ACCOUNT SETUP</h5>
                <span class="badge bg-danger mb-2">{{ session('msg') }}</span>
            </div>

            <div class="form-content">
                <form method="POST" action="{{ route('stud.finishSetup') }}">
                    @csrf

                    <div class="input-group">
                        <label for="email">Email</label>
                        <div class="input-container">
                            <input id="email" type="email"
                                class="input-box form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" required placeholder="user@email.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="address">Current Address</label>
                        <div class="input-container">
                            <input id="address" type="text"
                                class="input-box form-control @error('address') is-invalid @enderror"
                                value="{{ old('address') }}" name="address" required placeholder="Jacob Street, ...">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="address">Phone Number</label>
                        <div class="input-container">
                            <input id="phone-number" type="text"
                                class="input-box form-control @error('phoneNumber') is-invalid @enderror"
                                value="{{ old('phoneNumber') }}" name="phoneNumber" required placeholder="09...">

                            @error('phoneNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="password">New Password</label>
                        <div class="input-container">
                            <input id="password" type="password"
                                class="input-box form-control @error('password') is-invalid @enderror" name="password"
                                required placeholder="valid password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="confirm-password">{{ __('Confirm Password') }}</label>
                        <div class="input-container">
                            <input id="confirm-password" type="password"
                                class="input-box form-control @error('password_confirm') is-invalid @enderror"
                                name="password_confirmation" required autocomplete="current-password">

                            @error('password_confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-button-container">
                        <button type="submit" class="login form-button">
                            {{ __('Finish Account Setup') }}
                        </button>
                    </div>

                </form>
            </div>

        </div>

    </section>
@endsection
