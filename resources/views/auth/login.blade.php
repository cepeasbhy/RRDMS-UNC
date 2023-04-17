@extends('layouts.app')

@section('content')
    <article class="view-container">
        <div class="unc-logo">
            <img src="{{ asset('/img/unc-logo.png') }}" height="100%" width="100px">
        </div>
        <h2>Registrar Records and Document Management System</h2>

        <section class="form-group">
            <div class="form-group-header">
                <h5>ACCOUNT LOGIN</h5>
            </div>

            <div class="form-content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="user_id">User ID</label>
                    <div class="input-container">
                        <span class="input-icon">
                            <i class="bi bi-person-circle"></i>
                        </span>
                        <input id="user_id" type="text"
                            class="input-box form-control @error('user_id') is-invalid @enderror" name="user_id"
                            value="{{ old('user_id') }}" required>
                        @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="password" class="">{{ __('Password') }}</label>
                    <div class="input-container">
                        <span class="input-icon">
                            <i class="bi bi-key-fill"></i>
                        </span>
                        <input id="password" type="password"
                            class="input-box form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-button-container">
                        <button type="submit" class="form-button">
                            {{ __('Login') }}
                        </button>
                    </div>
            </div>



            </form>
            </div>
        </section>

    </article>
@endsection
