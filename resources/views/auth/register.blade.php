@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3 mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('ACCOUNT REGISTRATION') }}
                    <br>
                    <span class="badge bg-success mb-2">{{ session('msg') }}</span>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <label for="accountRole" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('Account Type') }}</label>

                            <div class="col-md-6">
                               <select class="form-select form-select-sm @error('accountRole') is-invalid @enderror" name="account_role" id="accountRole" required>
                                    <option value="">Choose...</option>
                                    <option value="ADMIN">Admin</option>
                                    <option value="RECORD_ASSOCIATE">Record Associate</option>
                                    <option value="CIC">College In Charge</option>
                               </select>
                                @error('accountRole')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="userID" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('Picture') }}</label>
                            <div class="col-md-6">
                                <input id="picture" type="file" class="form-control form-control-sm @error('picture') is-invalid @enderror" name="picture" value="{{ old('picture') }}" required>
                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="userID" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('User ID') }}</label>

                            <div class="col-md-6">
                                <input id="userID" type="text" class="form-control form-control-sm @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required>

                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="firstName" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control form-control-sm @error('firstName') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required>

                                @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="lastName" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lastName" type="text" class="form-control form-control-sm @error('lastName') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>

                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="middleName" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input id="middleName" type="text" class="form-control form-control-sm @error('middleName') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}">

                                @error('middleName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="email" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('Assigned Department') }}</label>

                            <div class="col-md-6">
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
                        </div>
                        <div class="row mb-2">
                            <label for="phoneNumber" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input id="phoneNumber" type="text" class="form-control form-control-sm @error('phoneNumber') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required>

                                @error('phoneNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="email" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="password" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="password-confirm" class="col-md-4 col-form-label col-form-label-sm text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-danger btn-sm w-50">
                                    {{ __('Register') }}
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
