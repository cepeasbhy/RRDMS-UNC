@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="main-container" style="max-width: 80%; margin-top: 3rem">
        <form class="mb-3" action="{{ route('index') }}" method="get">
            <button class="back view form-button"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
        <div class="head-container request-head">
            <h4>Archives Requesting</h4>
            <span class="badge bg-success mb-2">{{ session('msg') }}</span>
        </div>

        <div class="button-container">
            <ul id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="makeRequestTab" data-bs-toggle="tab"
                        data-bs-target="#pending-requests" type="button" role="tab" aria-controls="pending-requests"
                        aria-selected="true">Pending
                        Requests</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="requests-tab" data-bs-toggle="tab" data-bs-target="#approved-request"
                        type="button" role="tab" aria-controls="approved-request" aria-selected="false">Approved
                        Requests</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rejected-requests-tab" data-bs-toggle="tab"
                        data-bs-target="#rejected-requests" type="button" role="tab" aria-controls="rejected-requests"
                        aria-selected="false">Rejected
                        Requests</button>
                </li>
            </ul>
        </div>

        <div class="tab-container">
            <div class="tab-container__contents active" id="pending-requests" role="tabpanel"
                aria-labelledby="pending-requests-tab">
                <table class="pendingRequestsTable">
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
                                        <a class="link-button link-view-button"
                                            href="{{ route('viewRequestDetails', ['requestID' => $requestedArchive->request_id]) }}">View
                                            Request</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                </table>
            </div>

            <div class="tab-container__contents" id="approved-request" role="tabpanel" aria-labelledby="requests-tab">
                <table class="approvedRequestsTable">
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
                                        <a class="link-button link-view-button"
                                            href="{{ route('viewRequestDetails', ['requestID' => $requestedArchive->request_id]) }}">View
                                            Request</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                </table>
            </div>

            <div class="tab-container__contents" id="rejected-requests" role="tabpanel"
                aria-labelledby="rejected-requests-tab">
                <table class="rejectedRequestsTable">
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
                                        <a class="link-button link-view-button"
                                            href="{{ route('viewRequestDetails', ['requestID' => $requestedArchive->request_id]) }}">View
                                            Request</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
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
            $('.pendingRequestsTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No pending request available",
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
