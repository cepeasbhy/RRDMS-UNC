@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="row mt-3">
        <form class="mb-3" action="{{ route('StudCredHome') }}" method="get">
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
                <button class="nav-link active" id="makeRequestTab" data-bs-toggle="tab" data-bs-target="#make-request"
                    type="button" role="tab" aria-controls="make-request" aria-selected="true">Request From
                    Archives</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="requests-tab" data-bs-toggle="tab" data-bs-target="#user-request"
                    type="button" role="tab" aria-controls="user-request" aria-selected="false">Your Request</button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="make-request" role="tabpanel" aria-labelledby="make-request-tab">
                <div class="mt-3">
                    <table class="table myTable">
                        <thead>
                            <th class="custom-th bg-danger">Archive ID</th>
                            <th class="custom-th bg-danger">Student ID</th>
                            <th class="custom-th bg-danger">First Name</th>
                            <th class="custom-th bg-danger">Last Name</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($archives as $archive)
                                <tr class="custom-tr">
                                    <td class="custom-td">{{ $archive->archive_id }}</td>
                                    <td class="custom-td">{{ $archive->student_id }}</td>
                                    <td class="custom-td">{{ $archive->first_name }}</td>
                                    <td class="custom-td">{{ $archive->last_name }}</td>
                                    <td class="custom-td">
                                        <form action="{{ route('makeRequestArchive', ['id' => $archive->archive_id]) }}"
                                            method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-danger">REQUEST</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="user-request" role="tabpanel" aria-labelledby="requests-tab">
                <div class="mt-3">
                    <table class="table myRequest">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Archive ID</th>
                            <th class="custom-th bg-danger">Staff ID</th>
                            <th class="custom-th bg-danger">Request Date</th>
                            <th class="custom-th bg-danger">Status</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($requestedArchives as $requestedArchive)
                                <tr class="custom-tr">
                                    <td class="custom-td">{{ $requestedArchive->request_id }}</td>
                                    <td class="custom-td">{{ $requestedArchive->archive_id }}</td>
                                    <td class="custom-td">{{ $requestedArchive->staff_id }}</td>
                                    <td class="custom-td">
                                        {{ date('Y-m-d', strtotime($requestedArchive->created_at)) }}
                                    </td>
                                    <td class="custom-td">
                                        @if ($requestedArchive->status == 0)
                                            <span class="badge bg-secondary">-PENDING-</span>
                                        @else
                                            <span class="badge bg-success">-APPROVED-</span>
                                        @endif
                                    </td>
                                    <td class="custom-td">
                                        @if ($requestedArchive->status == 0)
                                            Not Available
                                        @else
                                            <form
                                                action="{{ route('viewRequestedArchive', ['id' => $requestedArchive->request_id]) }}"
                                                method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-success">VIEW</button>
                                            </form>
                                        @endif
                                    </td>
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
            $('.myTable').DataTable({
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
            $('.myRequest').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No Requests Available",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No requests available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
@endsection
