@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="request">
        <a href="{{ route('index') }}">
            <i class="bi bi-arrow-bar-left"></i> BACK
        </a>
        <h1>Request Logs</h1>
        <span style="margin-left: 1rem" class="badge bg-success mb-2">{{session('msg')}}</span>

        <div class="request__tabs">
            <ul id="myTab" role="list">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="makeRequestTab" data-bs-toggle="tab"
                        data-bs-target="#pending-requests" type="button" role="tab" aria-controls="pending-requests"
                        aria-selected="true" data-tab-target="#pending-requests">
                        Pending Requests
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="requests-tab" data-bs-toggle="tab"
                        data-tab-target="#approved-request" data-bs-target="#approved-request"
                        type="button" role="tab" aria-controls="approved-request" aria-selected="false">
                        Approved Requests
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rejected-requests-tab" data-bs-toggle="tab"
                        data-bs-target="#rejected-requests" type="button" role="tab" aria-controls="rejected-requests"
                        aria-selected="false" data-tab-target="#rejected-requests">
                        Rejected Requests
                    </button>
                </li>
            </ul>
        </div>

        <div class="request__data active" id="pending-requests" role="tabpanel"
                aria-labelledby="pending-requests-tab" data-tab-content>
                <table class="pendingRequestsTable">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Archive ID</th>
                            <th>Staff ID</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
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
                                        <a href="{{ route('viewRequestDetails', ['requestID' => $requestedArchive->request_id]) }}">View
                                            Request
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                </table>
            </div>

            <div class="request__data" id="approved-request" role="tabpanel" aria-labelledby="requests-tab" data-tab-content>
                <table class="approvedRequestsTable">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Archive ID</th>
                            <th>Staff ID</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
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
                                        <a href="{{ route('viewRequestDetails', ['requestID' => $requestedArchive->request_id]) }}">View
                                            Request
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                </table>
            </div>

            <div class="request__data" id="rejected-requests" role="tabpanel"
                aria-labelledby="rejected-requests-tab" data-tab-content>
                <table class="rejectedRequestsTable">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Archive ID</th>
                            <th>Staff ID</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
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
                                        <a href="{{ route('viewRequestDetails', ['requestID' => $requestedArchive->request_id]) }}">View
                                            Request
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                </table>
            </div>

    </section>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.pendingRequestsTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": " ",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No pending request available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });

        $(document).ready(function() {
            $('.approvedRequestsTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": " ",
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
                    "zeroRecords": " ",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No rejected requests available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
@endsection
