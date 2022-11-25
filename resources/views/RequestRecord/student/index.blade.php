@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="row mt-3">
        <div class="row justify-content-center">
            <div class="col mb-2">
                <div class="border-start border-danger border-4">
                    <h4 class="ms-2">
                        Request History
                    </h4>
                </div>
                <span class="badge bg-success mb-2">{{ session('msg') }}</span>
            </div>
            <div class="col-10">
                <div class="row mb-3 justify-content-end">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-7">
                                <button class="btn btn-success btn-sm w-100" form="searchRequest">SEARCH REQUEST</button>
                            </div>
                            <div class="col-5">
                                <a href="{{ route('stud.makeRequest') }}" class="btn btn-danger btn-sm w-100">REQUEST</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mb-2">
            <span class="badge bg-success mb-2">{{ session('msg') }}</span>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pending-requests" data-bs-toggle="tab" data-bs-target="#pending-request"
                    type="button" role="tab" aria-controls="pending-request" aria-selected="true">Pending
                    Requests</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="for-release" data-bs-toggle="tab" data-bs-target="#set-for-release"
                    type="button" role="tab" aria-controls="set-for-release" aria-selected="false">Set For Release
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="denied-requests" data-bs-toggle="tab" data-bs-target="#rejected-requests"
                    type="button" role="tab" aria-controls="rejected-requests" aria-selected="false">Denied
                    Requests
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="completed-requests" data-bs-toggle="tab" data-bs-target="#accepted-requests"
                    type="button" role="tab" aria-controls="accepted-requests" aria-selected="false">Completed
                    Requests</button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pending-request" role="tabpanel"
                aria-labelledby="pending-request-tab">
                <div class="mt-3">
                    <table class="table pendingRequestTable">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Student ID</th>
                            <th class="custom-th bg-danger">First Name</th>
                            <th class="custom-th bg-danger">Last Name</th>
                            <th class="custom-th bg-danger">Course</th>
                            <th class="custom-th bg-danger">Status</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($studentRequests as $documentDetails)
                                @if ($documentDetails->release_date == null && $documentDetails->status == 'IN PROGRESS')
                                    <tr class="custom-tr">
                                        <td class="custom-td">{{ $documentDetails->request_id }}</td>
                                        <td class="custom-td">{{ $documentDetails->student_id }}</td>
                                        <td class="custom-td">{{ $documentDetails->first_name }}</td>
                                        <td class="custom-td">{{ $documentDetails->last_name }}</td>
                                        <td class="custom-td">{{ $documentDetails->course_name }}</td>
                                        <td class="custom-td">
                                            @if ($documentDetails->release_date == null)
                                                <span class="badge bg-secondary">-PENDING-</span>
                                            @endif
                                        </td>
                                        <td class="custom-td">
                                            <form
                                                action="{{ route('stud.viewRequest', ['request_id' => $documentDetails->request_id]) }}"
                                                method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-success">VIEW</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade show" id="set-for-release" role="tabpanel" aria-labelledby="for-release">
                <div class="mt-3">
                    <table class="table forReleaseTable">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Student ID</th>
                            <th class="custom-th bg-danger">First Name</th>
                            <th class="custom-th bg-danger">Last Name</th>
                            <th class="custom-th bg-danger">Release Date</th>
                            <th class="custom-th bg-danger">Course</th>
                            <th class="custom-th bg-danger">Status</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($studentRequests as $documentDetails)
                                @if ($documentDetails->release_date != null && $documentDetails->status == 'SET FOR RELEASE')
                                    <tr class="custom-tr">
                                        <td class="custom-td">{{ $documentDetails->request_id }}</td>
                                        <td class="custom-td">{{ $documentDetails->student_id }}</td>
                                        <td class="custom-td">{{ $documentDetails->first_name }}</td>
                                        <td class="custom-td">{{ $documentDetails->last_name }}</td>
                                        <td class="custom-td">{{ $documentDetails->release_date }}</td>
                                        <td class="custom-td">{{ $documentDetails->course_name }}</td>
                                        <td class="custom-td">
                                            @if ($documentDetails->status == 'SET FOR RELEASE')
                                                <span class="badge bg-info text-dark">-SET FOR RELEASE-</span>
                                            @endif
                                        </td>
                                        <td class="custom-td">
                                            <form
                                                action="{{ route('stud.viewRequest', ['request_id' => $documentDetails->request_id]) }}"
                                                method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-success">VIEW</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade show" id="rejected-requests" role="tabpanel" aria-labelledby="denied-requests">
                <div class="mt-3">
                    <table class="table deniedRequestTable">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Student ID</th>
                            <th class="custom-th bg-danger">First Name</th>
                            <th class="custom-th bg-danger">Last Name</th>
                            <th class="custom-th bg-danger">Release Date</th>
                            <th class="custom-th bg-danger">Course</th>
                            <th class="custom-th bg-danger">Status</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($studentRequests as $documentDetails)
                                @if ($documentDetails->release_date == null && $documentDetails->status == 'DENIED')
                                    <tr class="custom-tr">
                                        <td class="custom-td">{{ $documentDetails->request_id }}</td>
                                        <td class="custom-td">{{ $documentDetails->student_id }}</td>
                                        <td class="custom-td">{{ $documentDetails->first_name }}</td>
                                        <td class="custom-td">{{ $documentDetails->last_name }}</td>
                                        <td class="custom-td">{{ $documentDetails->release_date }}</td>
                                        <td class="custom-td">{{ $documentDetails->course_name }}</td>
                                        <td class="custom-td">
                                            @if ($documentDetails->status == 'DENIED')
                                                <span class="badge bg-danger">-DENIED-</span>
                                            @endif
                                        </td>
                                        <td class="custom-td">
                                            <form
                                                action="{{ route('stud.viewRequest', ['request_id' => $documentDetails->request_id]) }}"
                                                method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-success">VIEW</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade show" id="accepted-requests" role="tabpanel" aria-labelledby="completed-requests">
                <div class="mt-3">
                    <table class="table completedRequestTable">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Student ID</th>
                            <th class="custom-th bg-danger">First Name</th>
                            <th class="custom-th bg-danger">Last Name</th>
                            <th class="custom-th bg-danger">Release Date</th>
                            <th class="custom-th bg-danger">Course</th>
                            <th class="custom-th bg-danger">Status</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($studentRequests as $documentDetails)
                                @if ($documentDetails->release_date != null && $documentDetails->status == 'COMPLETED')
                                    <tr class="custom-tr">
                                        <td class="custom-td">{{ $documentDetails->request_id }}</td>
                                        <td class="custom-td">{{ $documentDetails->student_id }}</td>
                                        <td class="custom-td">{{ $documentDetails->first_name }}</td>
                                        <td class="custom-td">{{ $documentDetails->last_name }}</td>
                                        <td class="custom-td">{{ $documentDetails->release_date }}</td>
                                        <td class="custom-td">{{ $documentDetails->course_name }}</td>
                                        <td class="custom-td">
                                            @if ($documentDetails->status == 'COMPLETED')
                                                <span class="badge bg-success">-COMPLETED-</span>
                                            @endif
                                        </td>
                                        <td class="custom-td">
                                            <form
                                                action="{{ route('stud.viewRequest', ['request_id' => $documentDetails->request_id]) }}"
                                                method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-success">VIEW</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.pendingRequestTable').DataTable({
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
            $('.forReleaseTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No Requests Available",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No requests available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });

        $(document).ready(function() {
            $('.deniedRequestTable').DataTable({
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
            $('.completedRequestTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No Records Available",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
@endsection
