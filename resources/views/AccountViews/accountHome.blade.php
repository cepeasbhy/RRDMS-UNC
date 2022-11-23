@extends('layouts.app')

@section('content')
    <div class="row w-50">
        <div class="row mt-3 mb-2">
            <div class="col">
                 <button class="btn btn-success btn-sm" onclick="history.back()"><i class="bi bi-arrow-bar-left"></i> BACK</button>
            </div>
        </div>
        <div class="col">
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">ACCOUNT INFORMATION</h4>
            </div>
            <span class="badge bg-success mb-2">{{session('msg')}}</span>
            <div class="ms-3">
                <div class="mb-3">
                    <div class="row align-items-center mb-3">
                        <img class="col-3 img-fluid rounded-circle student-pic" src="{{asset('storage/'.$picturePath->$columnName)}}">
                        <div class="col-9">
                            <span class="h4 fw-bold">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                            <br>
                            <span>{{Auth::user()->user_id}}</span>
                            <br>
                            @if (Auth::user()->account_role != 'student')
                                @if (Auth::user()->account_role == 'cic')
                                    <span>College In Charge</span>
                                    <br>
                                    <span>{{$staffInfo['dept_name']}}</span>
                                @elseif(Auth::user()->account_role == 'rec_assoc')
                                    <span>Records Associate</span>
                                @else()
                                    <span>Registrar</span>
                                @endif
                            @else
                                <span>Student</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <form id="accountUpdateForm" action="{{route('accountUpdate', ['id' => Auth::user()->user_id])}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="col-form-label col-form-label-sm" for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" type="text" value="{{Auth::user()->email}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="col-form-label col-form-label-sm" for="phone_number">Phone Number</label>
                                <input id="phone_number" name="phoneNumber" class="form-control form-control-sm @error('phoneNumber') is-invalid @enderror" type="text" value="{{Auth::user()->phone_number}}">
                                @error('phoneNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if(Auth::user()->account_role == 'student')
                                <div class="form-group mb-3">
                                    <label class="col-form-label col-form-label-sm" for="phone_number">Address</label>
                                    <input id="address" name="address" class="form-control form-control-sm @error('address') is-invalid @enderror" type="text" value="{{Auth::user()->address}}">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif
                        </form>
                        <div class="mb-3 row gap-3">
                            <button class="col btn btn-success btn-sm" form="accountUpdateForm">Update Information</button>
                            <button id="clickButton" class="col btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#change-pass-modal">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @extends('layouts.modals.changePassModal')

    @if($errors->has('old_password') || $errors->has('new_password'))
        <script>
            window.onload = function(){
                document.getElementById('clickButton').click();
            }
        </script>
    @endif
@endsection
