@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="main-container" style="max-width: 80%">
        <a class="link-button back-link" style="padding-block: 0.25rem" href="{{ route('admin.viewAccounts') }}"><i
                class="bi bi-arrow-bar-left"></i>
            BACK
        </a>
        <div class="grid-container wide-gap grid-orientation" style="width: 100%">
            <div style="margin-top: 1rem">
                <h4 class="head-container request-head">ACCOUNT INFORMATION</h4>
                <span class="badge bg-success mb-2">{{ session('msg') }}</span>
                <div class="flex-container pic-direction">
                    <img class="profile-image view-request-val" data-bs-toggle="modal"
                        data-bs-target="#view-account-picture" src="{{ asset('storage/' . $accountInfo['picturePath']) }}">
                    <div class="user-info">
                        <h4>{{ $accountInfo['accountInfo']->last_name }}, {{ $accountInfo['accountInfo']->first_name }}</h4>
                        <label>{{ $accountInfo['accountInfo']->student_id }}
                            {{ $accountInfo['accountInfo']->staff_id }}</label>
                    </div>
                </div>
                <div style="margin-top: 1rem">
                    <div class="readonly-container">
                        <label>Account Type</label>
                        @switch($accountInfo['accountInfo']->account_role)
                            @case('cic')
                                <input class="readonly-box" type="text" value="College in Charge" readonly>
                            @break

                            @case('rec_assoc')
                                <input class="readonly-box" type="text" value="Records Associate" readonly>
                            @break

                            @case('admin')
                                <input class="readonly-box" type="text" value="Registrar" readonly>
                            @break

                            @default
                                <input class="readonly-box" type="text" value="Student" readonly>
                        @endswitch
                    </div>
                    @if ($accountInfo['accountInfo']->account_role == 'student')
                        <div class="readonly-container" style="margin-top: 0.5rem">
                            <label>Program</label>
                            <input class="readonly-box" type="text" value="{{ $accountInfo['accountInfo']->dept_name }}"
                                readonly>
                        </div>
                        <div class="readonly-container" style="margin-top: 0.5rem">
                            <label>Course</label>
                            <input class="readonly-box" type="text"
                                value="{{ $accountInfo['accountInfo']->course_name }}" readonly>
                        </div>
                    @endif
                    @if ($accountInfo['accountInfo']->account_role == 'cic')
                        <div class="readonly-container" style="margin-top: 0.5rem">
                            <label>Assigned Department</label>
                            <input class="readonly-box" type="text" value="{{ $accountInfo['accountInfo']->dept_name }}"
                                readonly>
                        </div>
                    @endif
                    <div class="readonly-container" style="margin-top: 0.5rem">
                        <label>Phone Number</label>
                        <input class="readonly-box" type="text" value="{{ $accountInfo['accountInfo']->phone_number }}"
                            readonly>
                    </div>
                    <div class="readonly-container" style="margin-top: 0.5rem">
                        <label>Email</label>
                        <input class="readonly-box" type="text" value="{{ $accountInfo['accountInfo']->email }}"
                            readonly>
                    </div>
                    <div class="flex-container tri-button-container" style="margin-top: 1rem">
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
            </div>
            <div>
                @if ($accountInfo['accountInfo']->account_role != 'student')
                    <div style="width: 100%">
                        <div class="head-container request-head">
                            <h4>TRANSACTION LOGS</h4>
                        </div>
                        <table class="transacLogTable" style="width: 100%; margin-top: 1rem; font-size:14px">
                            <thead>
                                <th class="table-header" style="width: 15%">TIME</th>
                                <th class="table-header" style="width: 25%">DATE</th>
                                <th class="table-header">DESCRIPTION</th>
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
