@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="my-3 row">
        <div class="mb-3">
            <a class="btn btn-success btn-sm" href="{{route('admin.home')}}"><i class="bi bi-arrow-bar-left"></i> BACK</a>
        </div>
        <div class="col-5 align-items-center">
            <div class="col">
                <div class="border-start border-danger border-4">
                    <h3 class="ms-2">
                        Account Management
                    </h3>
                </div>
                <span class="badge bg-success mb-2 mt-2">{{ session('msg') }}</span>
            </div>
        </div>
        <div class="col-sm-3">
            <a class="btn btn-success btn-sm" href="{{route('register')}}" rel="noopener noreferrer">REGISTER STAFF</a>
        </div>
    </div>
    <div class="container">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="staffAccount" data-bs-toggle="tab" data-bs-target="#staff-account"
                    type="button" role="tab" aria-controls="staff-account" aria-selected="true">STAFF ACCOUNTS</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="studentAccount" data-bs-toggle="tab" data-bs-target="#student-account"
                    type="button" role="tab" aria-controls="student-account" aria-selected="false">STUDENT ACCOUNTS</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="staff-account" role="tabpanel" aria-labelledby="staff-account-tab">
                <div class="mt-3">
                    <table class="table staffTable">
                        <thead>
                            <th class="custom-th bg-danger">User ID</th>
                            <th class="custom-th bg-danger">First Name</th>
                            <th class="custom-th bg-danger">Last Name</th>
                            <th class="custom-th bg-danger">Assigned Department</th>
                            <th class="custom-th bg-danger">Position</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($staffAccounts as $staffAccount)
                                <tr class="custom-tr">
                                    <td class="custom-td">{{$staffAccount->staff_id}}</td>
                                    <td class="custom-td">{{$staffAccount->first_name}}</td>
                                    <td class="custom-td">{{$staffAccount->last_name}}</td>
                                    @if ($staffAccount->dept_name == null)
                                        <td class="custom-td">Not Assigned</td>
                                    @else
                                        <td class="custom-td">{{$staffAccount->dept_name}}</td>
                                    @endif
                                    @switch($staffAccount->account_role)
                                        @case('cic')
                                            <td class="custom-td">College in Charge</td>
                                            @break
                                        @case('admin')
                                            <td class="custom-td">Registrar</td>
                                            @break
                                        @default
                                            <td class="custom-td">Records Associate</td>
                                    @endswitch
                                    <td class="custom-td"><a href="{{route('admin.viewAccountInfo',
                                    ['role' => 'staff', 'userID' => $staffAccount->staff_id])}}"
                                    class="btn btn-success btn-sm">VIEW</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="student-account" role="tabpanel" aria-labelledby="student-account-tab">
                <div class="mt-3">
                    <table class="table studentTable">
                        <thead>
                            <th class="custom-th bg-danger">User ID</th>
                            <th class="custom-th bg-danger">First Name</th>
                            <th class="custom-th bg-danger">Last Name</th>
                            <th class="custom-th bg-danger">Department</th>
                            <th class="custom-th bg-danger">Course</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($studentAccounts as $studentAccount)
                                <tr class="custom-tr">
                                    <td class="custom-td">{{$studentAccount->student_id}}</td>
                                    <td class="custom-td">{{$studentAccount->first_name}}</td>
                                    <td class="custom-td">{{$studentAccount->last_name}}</td>
                                    <td class="custom-td">{{$studentAccount->dept_name}}</td>
                                    <td class="custom-td">{{$studentAccount->course_name}}</td>
                                    <td class="custom-td"><a href="{{route('admin.viewAccountInfo',
                                    ['role' => 'student', 'userID' => $studentAccount->student_id])}}"
                                    class="btn btn-success btn-sm">VIEW</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.staffTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ staff accounts per page",
                    "zeroRecords": "No Staff Accounts Available",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No Staff Accounts Available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });

        $(document).ready(function() {
            $('.studentTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ student accounts per page",
                    "zeroRecords": "No Student Accounts Availble",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No Student Accounts Availble",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
@endsection