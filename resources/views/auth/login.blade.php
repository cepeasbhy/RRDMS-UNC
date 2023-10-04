@extends('layouts.app')

@section('content')
    <section class="login">
        <img src="{{ asset('/img/unc-logo.png') }}" height="100%" width="100px">
        <h1>Registrar Records and Document Management System</h1>

        <section class="login__content">
            <h2>Account Login</h2>

            <form method="POST" class="login__content--form" action="{{ route('login') }}">
                @csrf
                <label for="user_id">User ID</label>
                <div class="login__content--form-group">
                    <span class="icon">
                        <i class="bi bi-person-circle"></i>
                    </span>
                    <input id="user_id" type="text"
                        class="@error('user_id') is-invalid @enderror" name="user_id"
                        value="{{ old('user_id') }}" required placeholder="ID">
                    @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <label for="password" class="password-label">{{ __('Password') }}</label>
                <div class="login__content--form-group">
                    <span class="icon">
                        <i class="bi bi-key-fill"></i>
                    </span>
                    <input id="password" type="password"
                        class="@error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit">
                    {{ __('Login') }}
                </button>
            </form>
        </section>

    </section>
@endsection
