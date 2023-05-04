@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="main-container">
        <form style="margin-top: 2rem" class="mb-3" action="{{ route('StudCredHome') }}" method="get">
            <button class="back view form-button"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>

        <h4 class="head-container request-head" style="margin-top: 1rem">Archives Requesting</h4>
        <span class="badge bg-success mb-2">{{ session('msg') }}</span>

        <div class="button-container">
            <ul id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="makeRequestTab" data-bs-toggle="tab" data-bs-target="#make-request"
                        type="button" role="tab" aria-controls="make-request" aria-selected="true">Request From
                        Archives</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pending-requests-tab" data-bs-toggle="tab"
                        data-bs-target="#pending-requests" type="button" role="tab"
                        aria-controls="pending-requests-tab" aria-selected="false">Pending
                        Requests</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="approved-requests-tab" data-bs-toggle="tab"
                        data-bs-target="#approved-requests" type="button" role="tab"
                        aria-controls="approved-requests-tab" aria-selected="false">Approved
                        Requests</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rejected-requests-tab" data-bs-toggle="tab"
                        data-bs-target="#rejected-requests" type="button" role="tab"
                        aria-controls="rejected-requests-tab" aria-selected="false">Rejected
                        Requests</button>
                </li>
            </ul>
        </div>

        <div class="tab-container">
            <div class="tab-container__contents active" id="make-request" role="tabpanel" aria-labelledby="make-request-tab"
                data-tab-content>
                <table class="makeRequestTable" style="width: 100%">
                    <thead>
                        <th class="table-header">Archive ID</th>
                        <th class="table-header">Student ID</th>
                        <th class="table-header">First Name</th>
                        <th class="table-header">Last Name</th>
                        <th class="table-header">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($archives as $archive)
                            <tr>
                                <td data-label="Archive Id">{{ $archive->archive_id }}</td>
                                <td data-label="Student Id">{{ $archive->student_id }}</td>
                                <td data-label="First Name">{{ $archive->first_name }}</td>
                                <td data-label="Last name">{{ $archive->last_name }}</td>
                                <td data-label="Action">
                                    <form action="{{ route('makeRequestArchive', ['id' => $archive->archive_id]) }}"
                                        method="post">
                                        @csrf
                                        <button class="print">REQUEST</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-container__contents" id="pending-requests" role="tabpanel"
                aria-labelledby="pending-requests-tab" data-tab-content>
                <table class="pendingRequestsTable" style="width: 100%">
                    <thead>
                        <th class="table-header">Request ID</th>
                        <th class="table-header">Archive ID</th>
                        <th class="table-header">Staff ID</th>
                        <th class="table-header">Request Date</th>
                        <th class="table-header">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($requestedArchives as $requestedArchive)
                            @if ($requestedArchive->status == 0)
                                <tr>
                                    <td data-label="Request Id">{{ $requestedArchive->request_id }}</td>
                                    <td data-label="Archive Id">{{ $requestedArchive->archive_id }}</td>
                                    <td data-label="Staff Id">{{ $requestedArchive->staff_id }}</td>
                                    <td data-label="Request Date">
                                        {{ date('Y-m-d', strtotime($requestedArchive->created_at)) }}
                                    </td>
                                    <td data-label="Action">
                                        <a class="print" style="text-decoration: none"
                                            href="{{ route('viewPendingRequestDetails', ['requestID' => $requestedArchive->request_id]) }}">View
                                            Request</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-container__contents" id="approved-requests" role="tabpanel"
                aria-labelledby="approved-requests-tab" data-tab-content>
                <table class="approvedRequestsTable" style="width: 100%">
                    <thead>
                        <th class="table-header">Request ID</th>
                        <th class="table-header">Archive ID</th>
                        <th class="table-header">Staff ID</th>
                        <th class="table-header">Request Date</th>
                        <th class="table-header">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($requestedArchives as $requestedArchive)
                            @if ($requestedArchive->status == 1)
                                <tr>
                                    <td data-label="Request Id">{{ $requestedArchive->request_id }}</td>
                                    <td data-label="Archive Id">{{ $requestedArchive->archive_id }}</td>
                                    <td data-label="Staff Id">{{ $requestedArchive->staff_id }}</td>
                                    <td data-label="Request Date">
                                        {{ date('Y-m-d', strtotime($requestedArchive->created_at)) }}
                                    </td>
                                    <td data-label="Action">
                                        <a class="print" style="text-decoration: none"
                                            href="{{ route('viewRequestedArchive', ['id' => $requestedArchive->request_id]) }}">View
                                            Record</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-container__contents" id="rejected-requests" role="tabpanel"
                aria-labelledby="rejected-requests-tab" data-tab-content>
                <table class="rejectedRequestsTable" style="width: 100%">
                    <thead>
                        <th class="table-header">Request ID</th>
                        <th class="table-header">Archive ID</th>
                        <th class="table-header">Staff ID</th>
                        <th class="table-header">Request Date</th>
                        <th class="table-header">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($requestedArchives as $requestedArchive)
                            @if ($requestedArchive->status == 2)
                                <tr>
                                    <td data-label="Request Id">{{ $requestedArchive->request_id }}</td>
                                    <td data-label="Archive Id">{{ $requestedArchive->archive_id }}</td>
                                    <td data-label="Staff Id">{{ $requestedArchive->staff_id }}</td>
                                    <td data-label="Request Date">
                                        {{ date('Y-m-d', strtotime($requestedArchive->created_at)) }}
                                    </td>
                                    <td data-label="Action">
                                        <a class="print" style="text-decoration: none"
                                            href="{{ route('viewPendingRequestDetails', ['requestID' => $requestedArchive->request_id]) }}">View
                                            Request</a>
                                    </td>
                                </tr>
                            @endif
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
            $('.makeRequestTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No Records Available",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });

        $(document).ready(function() {
            $('.pendingRequestsTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No pending requests available",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No pending requests available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
        $(document).ready(function() {
            $('.approvedRequestsTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No approved requests available",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No approved requests available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
        $(document).ready(function() {
            $('.rejectedRequestsTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No rejected requests available",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No rejected requests available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
@endsection
