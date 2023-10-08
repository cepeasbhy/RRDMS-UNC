@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="acc-setup">
        <h1>Account Setup</h1>
        <span style="margin-left: 1rem" class="badge bg-danger mb-2">{{ session('msg') }}</span>

        <form method="POST" action="{{ route('stud.finishSetup') }}">
            <h2>Secure your Account</h2>
            @csrf
            <div class="acc-setup__wrapper">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email"
                        class="@error('email') is-invalid @enderror"
                        value="{{ old('email') }}" name="email" required placeholder="user@email.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Current Address</label>
                    <input id="address" type="text"
                        class="@error('address') is-invalid @enderror"
                        value="{{ old('address') }}" name="address" required placeholder="Jacob Street, ...">

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Phone Number</label>
                    <input id="phone-number" type="text"
                        class="@error('phoneNumber') is-invalid @enderror"
                        value="{{ old('phoneNumber') }}" name="phoneNumber" required placeholder="09...">

                    @error('phoneNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input id="password" type="password"
                        class="@error('password') is-invalid @enderror" name="password"
                        required placeholder="Valid password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="confirm-password">{{ __('Confirm Password') }}</label>
                    <input id="confirm-password" type="password"
                        class="@error('password_confirm') is-invalid @enderror"
                        name="password_confirmation" required autocomplete="current-password" placeholder="Confirm Password">

                    @error('password_confirm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit">
                    {{ __('Finish Account Setup') }}
                </button>
            </div>
        </form>

    </section>
@endsection
