@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="row mt-3">
        <form class="mb-3" action="{{ route('index') }}" method="get">
            <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
        <div class="col mb-2">
            <div class="border-start border-danger border-4">
                <h4 class="ms-2">
                    Archives Requesting
                </h4>
            </div>
            <span class="badge bg-success mb-2">{{ session('msg') }}</span>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="makeRequestTab" data-bs-toggle="tab" data-bs-target="#pending-requests"
                    type="button" role="tab" aria-controls="pending-requests" aria-selected="true">Pending
                    Requests</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="requests-tab" data-bs-toggle="tab" data-bs-target="#approved-request"
                    type="button" role="tab" aria-controls="approved-request" aria-selected="false">Approved
                    Requests</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rejected-requests-tab" data-bs-toggle="tab" data-bs-target="#rejected-requests"
                    type="button" role="tab" aria-controls="rejected-requests" aria-selected="false">Rejected
                    Requests</button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pending-requests" role="tabpanel"
                aria-labelledby="pending-requests-tab">
                <div class="mt-3">
                    <table class="table pendingRequestsTable">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Archive ID</th>
                            <th class="custom-th bg-danger">Staff ID</th>
                            <th class="custom-th bg-danger">Request Date</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($requestedArchives as $requestedArchive)
                                @if ($requestedArchive->status == 0)
                                    <tr class="custom-tr">
                                        <td class="custom-td">{{ $requestedArchive->request_id }}</td>
                                        <td class="custom-td">{{ $requestedArchive->archive_id }}</td>
                                        <td class="custom-td">{{ $requestedArchive->staff_id }}</td>
                                        <td class="custom-td">
                                            {{ date('Y-m-d', strtotime($requestedArchive->created_at)) }}
                                        </td>
                                        <td class="custom-td">
                                           <a   class="btn btn-success btn-sm"
                                                href="{{route('viewRequestDetails', ['requestID' => $requestedArchive->request_id])}}">View Request</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="approved-request" role="tabpanel" aria-labelledby="requests-tab">
                <div class="mt-3">
                    <table class="table approvedRequestsTable">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Archive ID</th>
                            <th class="custom-th bg-danger">Staff ID</th>
                            <th class="custom-th bg-danger">Request Date</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($requestedArchives as $requestedArchive)
                                @if ($requestedArchive->status == 1)
                                    <tr class="custom-tr">
                                        <td class="custom-td">{{ $requestedArchive->request_id }}</td>
                                        <td class="custom-td">{{ $requestedArchive->archive_id }}</td>
                                        <td class="custom-td">{{ $requestedArchive->staff_id }}</td>
                                        <td class="custom-td">
                                            {{ date('Y-m-d', strtotime($requestedArchive->created_at)) }}
                                        </td>
                                        <td class="custom-td">
                                            <a   class="btn btn-success btn-sm"
                                                href="{{route('viewRequestDetails', ['requestID' => $requestedArchive->request_id])}}">View Request</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="rejected-requests" role="tabpanel"
                aria-labelledby="rejected-requests-tab">
                <div class="mt-3">
                    <table class="table rejectedRequestsTable">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Archive ID</th>
                            <th class="custom-th bg-danger">Staff ID</th>
                            <th class="custom-th bg-danger">Request Date</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($requestedArchives as $requestedArchive)
                                @if ($requestedArchive->status == 2)
                                    <tr class="custom-tr">
                                        <td class="custom-td">{{ $requestedArchive->request_id }}</td>
                                        <td class="custom-td">{{ $requestedArchive->archive_id }}</td>
                                        <td class="custom-td">{{ $requestedArchive->staff_id }}</td>
                                        <td class="custom-td">
                                            {{ date('Y-m-d', strtotime($requestedArchive->created_at)) }}
                                        </td>
                                        <td class="custom-td">
                                           <a   class="btn btn-success btn-sm"
                                                href="{{route('viewRequestDetails', ['requestID' => $requestedArchive->request_id])}}">View Request</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
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
