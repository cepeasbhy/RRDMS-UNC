@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="account">
        <button onclick="history.back()"><i
                class="bi bi-arrow-bar-left"></i>
            BACK
        </button>

        <h1>Account Information</h4>
        <div class="account___details">
            <span style="margin-left: 1rem" class="badge bg-success mb-2">{{ session('msg') }}</span>
            <div class="account__details--user">
                <img src="{{ asset('storage/' . $picturePath->$columnName) }}" draggable="false" loading="lazy">
                <div class="account__details--user-info">
                    <p>{{ Auth::user()->first_name }}, {{ Auth::user()->last_name }}</p>
                    <p>{{ Auth::user()->user_id }}</p>
                    @if (Auth::user()->account_role != 'student')
                        @if (Auth::user()->account_role == 'cic')
                            <p>College In Charge</p>
                            <br>
                            <p>{{ $staffInfo['dept_name'] }}</p>
                        @elseif(Auth::user()->account_role == 'rec_assoc')
                            <p>Records Associate</p>
                        @else()
                            <p>Registrar</p>
                        @endif
                    @else
                        <p>Student</p>
                    @endif
                </div>
            </div>
            <div class="account__details--data">
                <form id="accountUpdateForm" action="{{ route('accountUpdate', ['id' => Auth::user()->user_id]) }}"
                    method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email"
                            class="@error('email') is-invalid @enderror" type="text"
                            value="{{ Auth::user()->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input id="phone_number" name="phoneNumber"
                            class="@error('phoneNumber') is-invalid @enderror"
                            type="text" value="{{ Auth::user()->phone_number }}">
                        @error('phoneNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if (Auth::user()->account_role == 'student')
                        <div class="form-group">
                            <label for="phone_number">Address</label>
                            <input id="address" name="address"
                                class="@error('address') is-invalid @enderror"
                                type="text" value="{{ Auth::user()->address }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endif
                </form>
                <div class="account__details--data-buttons">
                    <button form="accountUpdateForm">
                        Update Information
                    </button>
                    <button id="clickButton" data-bs-toggle="modal"
                        data-bs-target="#change-pass-modal">
                        Change Password
                    </button>
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
