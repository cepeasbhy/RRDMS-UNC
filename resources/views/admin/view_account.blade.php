@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="acc-info">
        <a href="{{ route('admin.viewAccounts') }}">
            <i class="bi bi-arrow-bar-left"></i>
            BACK
        </a>
        <h1>ACCOUNT INFORMATION</h1>
        <div class="acc-info__contents">
            <span class="badge bg-success mb-2">{{ session('msg') }}</span>
            <div class="acc-info__contents--data">
                <h2>User</h2>
                <div class="acc-info__contents--data-user">
                    <img data-bs-toggle="modal"
                        data-bs-target="#view-account-picture" src="{{ asset('storage/' . $accountInfo['picturePath']) }}">
                    <div class="acc-info__contents-user-info">
                        <h3>{{ $accountInfo['accountInfo']->last_name }}, {{ $accountInfo['accountInfo']->first_name }}</h3>
                        <label>{{ $accountInfo['accountInfo']->student_id }}
                            {{ $accountInfo['accountInfo']->staff_id }}</label>
                    </div>
                </div>
                <div class="acc-info__contents--data-readonly">
                    <label for="type">Account Type</label>
                    @switch($accountInfo['accountInfo']->account_role)
                        @case('cic')
                            <input id="type" name="acc-type" type="text" value="College in Charge" readonly>
                        @break

                        @case('rec_assoc')
                            <input id="type" name="acc-type" type="text" value="Records Associate" readonly>
                        @break

                        @case('admin')
                            <input id="type" name="acc-type" type="text" value="Registrar" readonly>
                        @break

                        @default
                            <input id="type" name="acc-type" type="text" value="Student" readonly>
                    @endswitch
                </div>
                @if ($accountInfo['accountInfo']->account_role == 'student')
                    <div class="acc-info__contents--data-readonly">
                        <label for="program">Program</label>
                        <input id="program" name="program" type="text" value="{{ $accountInfo['accountInfo']->dept_name }}"
                            readonly>
                    </div>
                    <div class="acc-info__contents--data-readonly">
                        <label for="course">Course</label>
                        <input id="course" name="course" type="text"
                            value="{{ $accountInfo['accountInfo']->course_name }}" readonly>
                    </div>
                @endif
                @if ($accountInfo['accountInfo']->account_role == 'cic')
                    <div class="acc-info__contents--data-readonly">
                        <label for="dept">Assigned Department</label>
                        <input id="dept" name="dept" type="text" value="{{ $accountInfo['accountInfo']->dept_name }}"
                            readonly>
                    </div>
                @endif
                <div class="acc-info__contents--data-readonly">
                    <label for="num">Phone Number</label>
                    <input id="num" name="num" type="text" value="{{ $accountInfo['accountInfo']->phone_number }}"
                        readonly>
                </div>
                <div class="acc-info__contents--data-readonly">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" value="{{ $accountInfo['accountInfo']->email }}"
                        readonly>
                </div>
                <div class="acc-info__contents--data-buttons">
                    @if ($accountInfo['accountInfo']->account_role != 'admin')
                        @if ($accountInfo['accountInfo']->activated_status == 1)
                            <button class="cancel" data-bs-toggle="modal"
                                data-bs-target="#deactivate-status-modal">Deactivate Account</button>
                        @else
                            <button class="print" data-bs-toggle="modal"
                                data-bs-target="#activate-status-modal">Reactivate
                                Account</button>
                        @endif
                    @endif
                    @if ($accountInfo['accountInfo']->account_role != 'student')
                        <button id="clickButton" class="print" data-bs-toggle="modal"
                            data-bs-target="#admin-update-account">Update Information</button>
                    @endif
                </div>
            </div>
            @if ($accountInfo['accountInfo']->account_role != 'student')
                <div class="acc-info__contents--logs">
                    <h2>Logs</h2>
                    <table class="transacLogTable">
                        <thead>
                            <tr>
                                <th>TIME</th>
                                <th>DATE</th>
                                <th>DESCRIPTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transacLogs as $log)
                                <tr>
                                    <td data-lable="Time">{{ date('H:i', strtotime($log->created_at)) }}</td>
                                    <td data-lable="Date">{{ date('Y-m-d', strtotime($log->created_at)) }}</td>
                                    <td data-lable="Description">{{ $log->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.1.min.js"
                    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script>
                <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" defer></script>
                <script type="text/javascript" defer>
                    $(document).ready(function() {
                        $('.transacLogTable').DataTable({
                            "searching": false,
                            "language": {
                                "lengthMenu": "Logs per page _MENU_",
                                "zeroRecords": "No Logs Available",
                                "info": "Showing page _PAGE_ of _PAGES_",
                                "infoEmpty": "",
                                "infoFiltered": "(filtered from _MAX_ total records)"
                            },
                        });
                    });
                </script>
            @endif
        </div>
    </section>

    @extends('layouts.modals.deleteAccountModal')
    @extends('layouts.modals.updateAccountModal')
    @extends('layouts.modals.viewAccountPictureModal')
    @extends('layouts.modals.updateAccountPictureModal')
    @extends('layouts.modals.setAccountActive')
    @extends('layouts.modals.setAccountInactive')

    @if ($errors->any())
        <script>
            window.onload = function() {
                document.getElementById('clickButton').click();
            }
        </script>
    @endif
@endsection
