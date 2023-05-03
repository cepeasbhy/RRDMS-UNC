@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="main-container" style="max-width: 50%; margin-top: 2rem">
        <button class="back view form-button" onclick="history.back()"><i class="bi bi-arrow-bar-left"></i>
            BACK</button>

        <div class="flex-container info-wrapper">
            <div style="width:100%">
                <h4 class="head-container request-head">ACCOUNT INFORMATION</h4>
                <span class="badge bg-success mb-2">{{ session('msg') }}</span>
                <div class="flex-container pic-direction" style="max-width: 70%">
                    <img class="profile-image view-request-val" src="{{ asset('storage/' . $picturePath->$columnName) }}">
                    <div class="user-info">
                        <p class="user-info__name">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</p>
                        <p style="margin-bottom: 0.25rem">{{ Auth::user()->user_id }}</p>
                        @if (Auth::user()->account_role != 'student')
                            @if (Auth::user()->account_role == 'cic')
                                <p style="margin-bottom: 0.25rem">College In Charge</p>
                                <br>
                                <p style="margin-bottom: 0.25rem">{{ $staffInfo['dept_name'] }}</p>
                            @elseif(Auth::user()->account_role == 'rec_assoc')
                                <p style="margin-bottom: 0.25rem">Records Associate</p>
                            @else()
                                <p style="margin-bottom: 0.25rem">Registrar</p>
                            @endif
                        @else
                            <p>Student</p>
                        @endif
                    </div>
                </div>
                <div>
                    <form id="accountUpdateForm" action="{{ route('accountUpdate', ['id' => Auth::user()->user_id]) }}"
                        method="post">
                        @csrf
                        <div class="form-pair">
                            <label class="col-form-label col-form-label-sm" for="email">Email</label>
                            <input id="email" name="email" type="email"
                                class="form-control form-control-sm @error('email') is-invalid @enderror" type="text"
                                value="{{ Auth::user()->email }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-pair">
                            <label class="col-form-label col-form-label-sm" for="phone_number">Phone Number</label>
                            <input id="phone_number" name="phoneNumber"
                                class="form-control form-control-sm @error('phoneNumber') is-invalid @enderror"
                                type="text" value="{{ Auth::user()->phone_number }}">
                            @error('phoneNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if (Auth::user()->account_role == 'student')
                            <div class="form-pair">
                                <label class="col-form-label col-form-label-sm" for="phone_number">Address</label>
                                <input id="address" name="address"
                                    class="form-control form-control-sm @error('address') is-invalid @enderror"
                                    type="text" value="{{ Auth::user()->address }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
                    </form>
                    <div class="flex-container form-button-container account-buttons">
                        <button class="print" style="padding-block: 0.15rem" form="accountUpdateForm">Update
                            Information</button>
                        <button id="clickButton" class="cancel" data-bs-toggle="modal"
                            data-bs-target="#change-pass-modal">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @extends('layouts.modals.changePassModal')

    @if ($errors->has('old_password') || $errors->has('new_password'))
        <script>
            window.onload = function() {
                document.getElementById('clickButton').click();
            }
        </script>
    @endif
@endsection
