@extends('layouts.app')

@section('content')
    <div class="row mb-3 mt-3">
        <div class="mb-3">
            <a class="btn btn-success btn-sm" href="{{route('admin.viewAccounts')}}"><i class="bi bi-arrow-bar-left"></i> BACK</a>
        </div>
        <div class="col-5">
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">ACCOUNT INFORMATION</h4>
            </div>
            <span class="badge bg-success mb-2">{{session('msg')}}</span>
                <div class="ms-2 mb-3">
                    <div class="row align-items-center mb-3">
                        <img class="col-3 img-fluid rounded-circle student-pic" data-bs-toggle="modal" data-bs-target="#view-account-picture"
                        src="{{asset('storage/'.$accountInfo['picturePath'])}}">
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
                                @case('admin')
                                    <input class="form-control form-control-sm" type="text" value="Registrar" readonly>
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
                    <div class=" form-group mb-3 row gap-3">
                    @if($accountInfo['accountInfo']->account_role != 'admin')
                        @if($accountInfo['accountInfo']->activated_status == 1)
                            <button class="col btn btn-secondary btn-small" data-bs-toggle="modal" data-bs-target="#deactivate-status-modal">Deactivate Account</button>
                        @else
                            <button class="col btn btn-secondary btn-small" data-bs-toggle="modal" data-bs-target="#activate-status-modal">Reactivate Account</button>
                        @endif
                    @endif
                    @if ($accountInfo['accountInfo']->account_role != 'student')
                        <button id="clickButton" class="col btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#admin-update-account">Update Information</button>
                    @endif
                </div>
            </div>
        </div>
        @if($accountInfo['accountInfo']->account_role != 'student')
            <div class="col-7 mb-2">
                <div class="border-start border-danger border-4">
                    <h4 class="ms-3">TRANSACTION LOGS</h4>
                </div>
                <div class="row">
                    <table class="table transacLogTable">
                        <thead>
                            <th class="custom-th bg-danger">DATE</th>
                            <th class="custom-th bg-danger">TIME</th>
                            <th class="custom-th bg-danger">DESCRIPTION</th>
                        </thead>
                        <tbody>
                            @foreach ($transacLogs as $log)
                                <tr class="custom-tr">
                                    <td class="custom-td">{{date('H:i',strtotime($log->created_at))}}</td>
                                    <td class="custom-td">{{date('Y-m-d',strtotime($log->created_at))}}</td>
                                    <td class="custom-td">{{$log->description}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.1.min.js"
                integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.transacLogTable').DataTable({
                        "language": {
                            "lengthMenu": "Display _MENU_ logs per page",
                            "zeroRecords": "No Logs Available",
                            "info": "Showing page _PAGE_ of _PAGES_",
                            "infoEmpty": "No Logs Available",
                            "infoFiltered": "(filtered from _MAX_ total records)"
                        },
                        "table" :{
                            "style":{
                                "font-size" : "100px"
                            }
                        }
                    });
                });
            </script>    
        @endif
    </div>

    @extends('layouts.modals.deleteAccountModal')
    @extends('layouts.modals.updateAccountModal')
    @extends('layouts.modals.viewAccountPictureModal')
    @extends('layouts.modals.updateAccountPictureModal')
    @extends('layouts.modals.setAccountActive')
    @extends('layouts.modals.setAccountInactive')

    @if($errors->any())
        <script>
            window.onload = function(){
                document.getElementById('clickButton').click();
            }
        </script>
    @endif
@endsection