@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <div class="row w-50">
        <div class="col">
            <div class="mb-3">
                <a class="btn btn-success btn-sm" href="{{route('admin.viewAccounts')}}"><i class="bi bi-arrow-bar-left"></i> BACK</a>
            </div>
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">ACCOUNT INFORMATION</h4>
            </div>
            <div class="ms-3 mt-3">
                <div class="mb-3">
                    <div class="row align-items-center mb-3">
                        <img class="col-3 img-fluid rounded-circle student-pic" src="{{asset('storage/'.$accountInfo['picturePath'])}}">
                        <div class="col-9">
                            <h4>{{$accountInfo['accountInfo']->last_name}}, {{$accountInfo['accountInfo']->first_name}}</h4>
                            <label>{{$accountInfo['accountInfo']->student_id}} {{$accountInfo['accountInfo']->staff_id}}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group mb-2">
                            <label>Account Type</label>
                            @switch($accountInfo['accountInfo']->account_role)
                                @case('cic')
                                    <input class="form-control form-control-sm" type="text" value="College in Charge" readonly>
                                    @break
                                @case('rec_assoc')
                                    <input class="form-control form-control-sm" type="text" value="Records Associate" readonly>
                                    @break
                                @default
                                    <input class="form-control form-control-sm" type="text" value="Student" readonly>
                            @endswitch
                        </div>
                        @if ($accountInfo['accountInfo']->account_role == 'student')
                            <div class="form-group mb-2">
                                <label>Program</label>
                                <input class="form-control form-control-sm" type="text" value="{{$accountInfo['accountInfo']->dept_name}}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label>Course</label>
                                <input class="form-control form-control-sm" type="text" value="{{$accountInfo['accountInfo']->course_name}}" readonly>
                            </div>
                        @endif
                        @if ($accountInfo['accountInfo']->account_role == 'cic')
                            <div class="form-group mb-2">
                                <label>Assigned Department</label>
                                <input class="form-control form-control-sm" type="text" value="{{$accountInfo['accountInfo']->dept_name}}" readonly>
                            </div>
                        @endif
                        <div class="form-group mb-2">
                            <label>Phone Number</label>
                            <input class="form-control form-control-sm" type="text" value="{{$accountInfo['accountInfo']->phone_number}}" readonly>
                        </div>
                        <div class="form-group mb-2">
                            <label>Email</label>
                            <input class="form-control form-control-sm" type="text" value="{{$accountInfo['accountInfo']->email}}" readonly>
                        </div>
                    </div>
                    @if ($accountInfo['accountInfo']->account_role != 'student')
                        <div class=" form-group mb-3 row gap-3">
                            <button id="clickButton" class="col btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#admin-update-account">Update Information</button>
                            <button class="col btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#admin-delete-account">Delete Account</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($accountInfo['accountInfo']->account_role != 'student')
        @extends('layouts.modals.updateAccountModal')
        @extends('layouts.modals.deleteAccountModal')
        @if($errors->any())
            <script>
                window.onload = function(){
                    document.getElementById('clickButton').click();
                }
            </script>
        @endif
    @endif
@endsection