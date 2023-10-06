@extends('layouts.app')

@section('content')
    <section class="register">
        <a href="{{ route('admin.viewAccounts') }}"><i class="bi bi-arrow-bar-left"></i>
            BACK
        </a>
        <h1>{{ __('ACCOUNT REGISTRATION') }}</h1>
        <div class="register__contents">
            <h2>Create Account</h2>
            <span style="margin-left: 1rem" class="badge bg-success mb-2">{{ session('msg') }}</span>
            <form class="register__contents--form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="accountRole">{{ __('Account Type') }}</label>
                    <select class="@error('accountRole') is-invalid @enderror"
                        name="account_role" id="accountRole" required>
                        <option value="">Choose...</option>
                        <option value="admin">Admin</option>
                        <option value="rec_assoc">Record Associate</option>
                        <option value="cic">College In Charge</option>
                    </select>
                    @error('accountRole')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="picture">{{ __('Picture') }}</label>
                    <input id="picture" type="file"
                        class="form-control @error('picture') is-invalid @enderror" name="picture"
                        value="{{ old('picture') }}" required>
                    @error('picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="userID">{{ __('User ID') }}</label>

                    <input id="userID" type="text"
                        class="@error('user_id') is-invalid @enderror" name="user_id"
                        value="{{ old('user_id') }}" required placeholder="ID">

                    @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="firstName">{{ __('First Name') }}</label>

                    <input id="firstName" type="text"
                        class="@error('firstName') is-invalid @enderror" name="first_name"
                        value="{{ old('first_name') }}" required placeholder="First Name">

                    @error('firstName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lastName">{{ __('Last Name') }}</label>

                    <input id="lastName" type="text"
                        class="@error('lastName') is-invalid @enderror" name="last_name"
                        value="{{ old('last_name') }}" required placeholder="Last Name">

                    @error('lastName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="middleName">{{ __('Middle Name') }}</label>

                    <input id="middleName" type="text"
                        class=" @error('middleName') is-invalid @enderror"
                        name="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name">

                    @error('middleName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('Department') }}</label>

                    <select name="assigned_dept">
                        <option value="">Choose...</option>
                        <option value="001">Arts and Science</option>
                        <option value="002">Business and Accountancy</option>
                        <option value="003">Computer Studies</option>
                        <option value="004">Criminal Justice Education</option>
                        <option value="005">Education</option>
                        <option value="006">Engineering and Architecture</option>
                        <option value="007">Nursing</option>
                        <option value="008">Graduate Studies</option>
                        <option value="009">School of Law</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">{{ __('Phone Number') }}</label>
                    <input id="phoneNumber" type="text"
                        class="@error('phoneNumber') is-invalid @enderror"
                        name="phone_number" value="{{ old('phone_number') }}" required placeholder="Phone Number">

                    @error('phoneNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email"
                        class="@error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required placeholder="Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit">
                    {{ __('Register') }}
                </button>
            </form>
        </div>
    </section>
@endsection
