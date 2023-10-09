@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="stud-homepage">

        <h1>Request Logs</h1>
        <span style="margin-left: 1rem" class="badge bg-success mb-1">{{session('msg')}}</span>

        <div class="stud-homepage__subheading">
            <h2>Manage Requests</h2>
            <a href="{{ route('stud.makeRequest') }}">
                Make a Request
            </a>
        </div>

        <div class="stud-homepage__tabs">
            <ul id="myTab" role="list">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pending-requests" data-tab-target="#pending-request"
                        data-bs-target="#pending-request" type="button" role="tab"
                        aria-controls="pending-request">
                        Pending Requests
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="for-release" data-tab-target="#set-for-release"
                        data-bs-target="#set-for-release" type="button" role="tab" aria-controls="set-for-release">
                        Set For Release
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="denied-requests" data-tab-target="#rejected-requests"
                        data-bs-target="#rejected-requests" type="button" role="tab"
                        aria-controls="rejected-requests">
                        Denied Requests
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-requests" data-tab-target="#accepted-requests"
                        data-bs-target="#accepted-requests" type="button" role="tab"
                        aria-controls="accepted-requests">
                        Completed Requests
                    </button>
                </li>
            </ul>
        </div>

        <div class="stud-homepage__data active" id="pending-request" role="tabpanel"
                aria-labelledby="pending-request" data-tab-content>
                <table class="pendingRequestTable">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentRequests as $documentDetails)
                            @if ($documentDetails->release_date == null && $documentDetails->status == 'IN PROGRESS')
                                <tr>
                                    <td data-label="Request Id">{{ $documentDetails->request_id }}</td>
                                    <td data-label="Student Id">{{ $documentDetails->student_id }}</td>
                                    <td data-label="First Name">{{ $documentDetails->first_name }}</td>
                                    <td data-label="Last Name">{{ $documentDetails->last_name }}</td>
                                    <td data-label="Course">{{ $documentDetails->course_name }}</td>
                                    <td data-label="Status">
                                        @if ($documentDetails->release_date == null)
                                            <span class="badge bg-secondary">-PENDING-</span>
                                        @endif
                                    </td>
                                    <td data-label="Action">
                                        <form
                                            action="{{ route('stud.viewRequest', ['request_id' => $documentDetails->request_id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit">VIEW</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="stud-homepage__data" id="set-for-release" role="tabpanel" aria-labelledby="for-release"
                data-tab-content>
                <table class="forReleaseTable">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Release Date</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentRequests as $documentDetails)
                            @if ($documentDetails->release_date != null && $documentDetails->status == 'SET FOR RELEASE')
                                <tr>
                                    <td data-label="Request Id">{{ $documentDetails->request_id }}</td>
                                    <td data-label="Student Id">{{ $documentDetails->student_id }}</td>
                                    <td data-label="Name">{{ $documentDetails->first_name }}
                                        {{ $documentDetails->last_name }}</td>
                                    <td data-label="Release Date">{{ $documentDetails->release_date }}</td>
                                    <td data-label="Course">{{ $documentDetails->course_name }}</td>
                                    <td data-label="Status">
                                        @if ($documentDetails->status == 'SET FOR RELEASE')
                                            <span class="badge bg-info text-dark">-SET FOR
                                                RELEASE-</span>
                                        @endif
                                    </td>
                                    <td data-label="Action">
                                        <form
                                            action="{{ route('stud.viewRequest', ['request_id' => $documentDetails->request_id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit">VIEW</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="stud-homepage__data" id="rejected-requests" role="tabpanel" aria-labelledby="denied-requests"
                data-tab-content>
                <table class="deniedRequestTable">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Release Date</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentRequests as $documentDetails)
                            @if ($documentDetails->release_date == null && $documentDetails->status == 'DENIED')
                                <tr>
                                    <td data-label="Request Id">{{ $documentDetails->request_id }}</td>
                                    <td data-label="Student Id">{{ $documentDetails->student_id }}</td>
                                    <td data-label="Name">{{ $documentDetails->first_name }}
                                        {{ $documentDetails->last_name }}</td>
                                    <td data-label="Release Date">{{ $documentDetails->release_date }}</td>
                                    <td data-label="Course">{{ $documentDetails->course_name }}</td>
                                    <td data-label="Status">
                                        @if ($documentDetails->status == 'DENIED')
                                            <span class="badge bg-danger">-DENIED-</span>
                                        @endif
                                    </td>
                                    <td data-label="Action">
                                        <form
                                            action="{{ route('stud.viewRequest', ['request_id' => $documentDetails->request_id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit">VIEW</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="stud-homepage__data" id="accepted-requests" role="tabpanel"
                aria-labelledby="completed-requests" data-tab-content>
                <table class="completedRequestTable">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Release Date</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentRequests as $documentDetails)
                            @if ($documentDetails->release_date != null && $documentDetails->status == 'COMPLETED')
                                <tr>
                                    <td data-label="Request Id">{{ $documentDetails->request_id }}</td>
                                    <td data-label="Student Id">{{ $documentDetails->student_id }}</td>
                                    <td data-label="Name">{{ $documentDetails->first_name }}
                                        {{ $documentDetails->last_name }}</td>
                                    <td data-label="Release Date">{{ $documentDetails->release_date }}</td>
                                    <td data-label="Course">{{ $documentDetails->course_name }}</td>
                                    <td data-label="Status">
                                        @if ($documentDetails->status == 'COMPLETED')
                                            <span class="badge bg-success">-COMPLETED-</span>
                                        @endif
                                    </td>
                                    <td data-label="Action">
                                        <form
                                            action="{{ route('stud.viewRequest', ['request_id' => $documentDetails->request_id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit">VIEW</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
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
                    "zeroRecords": " ",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No request available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });

        $(document).ready(function() {
            $('.forReleaseTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": " ",
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
                    "zeroRecords": " ",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No requests available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });

        $(document).ready(function() {
            $('.completedRequestTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": " ",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No requests available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
@endsection
