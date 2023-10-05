@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="manage-acc">
        <a href="{{ route('admin.home') }}"><i class="bi bi-arrow-bar-left"></i>
            BACK
        </a>
        <h1>Account Management</h1>
        <span class="badge bg-success mb-2 mt-2">{{ session('msg') }}</span>
        <a href="{{ route('register') }}" rel="noopener noreferrer">
            ADD REGISTRAR STAFF
        </a>
        <div class="manage-acc__tabs">
            <ul id="myTab" role="list">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="staffAccount" data-bs-toggle="tab" data-tab-target="#staff-account" data-bs-target="#staff-account"
                        type="button" role="tab" aria-controls="staff-account" aria-selected="true">
                        Staff Accounts
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="studentAccount" data-bs-toggle="tab" data-tab-target="#student-account" data-bs-target="#student-account"
                        type="button" role="tab" aria-controls="student-account" aria-selected="false">
                        Student Accounts</button>
                </li>
            </ul>
        </div>
        <div class="manage-acc__content">
            <div class="manage-acc__content--group active" id="staff-account" role="tabpanel"
                aria-labelledby="staff-account-tab" data-tab-content>
                <table class="staffTable">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Assigned Department</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffAccounts as $staffAccount)
                            <tr>
                                <td data-label="User Id">{{ $staffAccount->staff_id }}</td>
                                <td data-label="First Name">{{ $staffAccount->first_name }}</td>
                                <td data-label="Last Name">{{ $staffAccount->last_name }}</td>
                                @if ($staffAccount->dept_name == null)
                                    <td data-label="Assigned Dept.">Not Assigned</td>
                                @else
                                    <td data-label="Dept.">{{ $staffAccount->dept_name }}</td>
                                @endif
                                @switch($staffAccount->account_role)
                                    @case('cic')
                                        <td data-label="Position">College in Charge</td>
                                    @break

                                    @case('admin')
                                        <td data-label="Position">Registrar</td>
                                    @break

                                    @default
                                        <td data-label="Position">Records Associate</td>
                                @endswitch
                                <td data-label="Action">
                                    <a href="{{ route('admin.viewAccountInfo', ['role' => 'staff', 'userID' => $staffAccount->staff_id]) }}">
                                        VIEW
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="manage-acc__content--group" id="student-account" role="tabpanel" aria-labelledby="student-account-tab" data-tab-content>
                <table class="studentTable">
                    <thead>
                        <th class="table-header">User ID</th>
                        <th class="table-header">First Name</th>
                        <th class="table-header">Last Name</th>
                        <th class="table-header">Department</th>
                        <th class="table-header">Course</th>
                        <th class="table-header">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($studentAccounts as $studentAccount)
                            <tr>
                                <td data-label="User Id">{{ $studentAccount->student_id }}</td>
                                <td data-label="First Name">{{ $studentAccount->first_name }}</td>
                                <td data-label="Last Name">{{ $studentAccount->last_name }}</td>
                                <td data-label="Department">{{ $studentAccount->dept_name }}</td>
                                <td data-label="Course">{{ $studentAccount->course_name }}</td>
                                <td data-label="Action"><a
                                        href="{{ route('admin.viewAccountInfo', ['role' => 'student', 'userID' => $studentAccount->student_id]) }}"
                                        class="link-button back-link" style="padding-block: 0.25rem">VIEW</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.staffTable').DataTable({
                "language": {
                    "lengthMenu": "Staff accounts per page: _MENU_",
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
                    "lengthMenu": "Student accts per page _MENU_ ",
                    "zeroRecords": "No Student Accounts Availble",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No Student Accounts Availble",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
@endsection
