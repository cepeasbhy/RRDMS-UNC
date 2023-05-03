@extends('layouts.app')

@section('content')
    <section class="main-container" style="max-width: 80%; margin-top: 5rem">
        <div class="form-block" style="width: 100%">
            <div class="form-block-header">
                {{ __('ACCOUNT REGISTRATION') }}
                <br>
                <span class="badge bg-success mb-2">{{ session('msg') }}</span>
            </div>
            <div class="form-content" style="padding: 1rem 0 1rem 0">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex-container pic-direction" style="gap: 0.25rem">
                        <label style="width: 25ch; font-size: 0.85rem" for="accountRole">{{ __('Account Type') }}</label>
                        <select class="form-select form-select-sm @error('accountRole') is-invalid @enderror"
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
                    <div class="flex-container pic-direction" style="margin-top: 1rem; gap: 0.25rem">
                        <label style="width: 25ch; font-size: 0.85rem" for="userID">{{ __('Picture') }}</label>
                        <input id="picture" type="file"
                            class="form-control form-control-sm @error('picture') is-invalid @enderror" name="picture"
                            value="{{ old('picture') }}" required>
                        @error('picture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex-container pic-direction" style="margin-top: 1rem; gap: 0.25rem">
                        <label style="width: 25ch; font-size: 0.85rem" for="userID">{{ __('User ID') }}</label>

                        <input id="userID" type="text"
                            class="form-control form-control-sm @error('user_id') is-invalid @enderror" name="user_id"
                            value="{{ old('user_id') }}" required>

                        @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex-container pic-direction" style="margin-top: 1rem; gap: 0.25rem">
                        <label style="width: 25ch; font-size: 0.85rem" for="firstName">{{ __('First Name') }}</label>

                        <input id="firstName" type="text"
                            class="form-control form-control-sm @error('firstName') is-invalid @enderror" name="first_name"
                            value="{{ old('first_name') }}" required>

                        @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex-container pic-direction" style="margin-top: 1rem; gap: 0.25rem">
                        <label style="width: 25ch; font-size: 0.85rem" for="lastName">{{ __('Last Name') }}</label>

                        <input id="lastName" type="text"
                            class="form-control form-control-sm @error('lastName') is-invalid @enderror" name="last_name"
                            value="{{ old('last_name') }}" required>

                        @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex-container pic-direction" style="margin-top: 1rem; gap: 0.25rem">
                        <label style="width: 25ch; font-size: 0.85rem" for="middleName">{{ __('Middle Name') }}</label>

                        <input id="middleName" type="text"
                            class="form-control form-control-sm @error('middleName') is-invalid @enderror"
                            name="middle_name" value="{{ old('middle_name') }}">

                        @error('middleName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex-container pic-direction" style="margin-top: 1rem; gap: 0.25rem">
                        <label style="width: 25ch; font-size: 0.85rem">{{ __('Assigned Department') }}</label>

                        <select class="form-select form-select-sm " name="assigned_dept">
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
                    <div class="flex-container pic-direction" style="margin-top: 1rem; gap: 0.25rem">
                        <label style="width: 25ch; font-size: 0.85rem" for="phoneNumber">{{ __('Phone Number') }}</label>
                        <input id="phoneNumber" type="text"
                            class="form-control form-control-sm @error('phoneNumber') is-invalid @enderror"
                            name="phone_number" value="{{ old('phone_number') }}" required>

                        @error('phoneNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex-container pic-direction" style="margin-top: 1rem; gap: 0.25rem">
                        <label style="width: 25ch; font-size: 0.85rem" for="email">{{ __('Email') }}</label>
                        <input id="email" type="email"
                            class="form-control form-control-sm @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div style="margin-top: 1rem; text-align: center">
                        <button type="submit" class="form-button login">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
