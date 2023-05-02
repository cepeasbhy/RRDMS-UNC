@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="main-container" style="max-width: 80%; margin-top: 3rem">
        <div class="flex-container archive-top-container" style="justify-content: space-between">
            <div>
                <h3 class="head-container request-head">Archived Records Management</h3>
                <span class="badge bg-success mb-2">{{ session('msg') }}</span>
            </div>
            <div class="flex-container archive-button-orientation">
                <form class="w-100" action="{{ route('toBeArchived') }}" method="get">
                    <input class="print" style="padding-block: 0.15rem" type="submit" value="ARCHIVE A RECORD">
                </form>
                <form class="w-100" action="{{ route('getRequests') }}" method="get">
                    <input class="cancel" type="submit" value="VIEW REQUESTS">
                </form>
            </div>
        </div>

        <div class="tab-container">
            <div class="tab-container__contents active">
                <table id="archivedRecordsTable" style="width: 100%">
                    <thead>
                        <th class="table-header">STUDENT ID</th>
                        <th class="table-header">FIRST NAME</th>
                        <th class="table-header">LAST NAME</th>
                        <th class="table-header">DEPARTMENT</th>
                        <th class="table-header">PROGRAM</th>
                        <th class="table-header">ACTION</th>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td data-label="Student Id">{{ $student->student_id }}</td>
                                <td data-label="First Name">{{ $student->first_name }}</td>
                                <td data-label="Last Name">{{ $student->last_name }}</td>
                                <td data-label="Department">{{ $student->dept_name }}</td>
                                <td data-label="Program">{{ $student->course_name }}</td>
                                <td data-label="Action">
                                    <form action="{{ route('checkRecord', ['id' => $student->student_id]) }}"
                                        method="GET">
                                        @csrf
                                        <input type="submit" value="VIEW" class="form-button view">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                </table>
                <script src="https://code.jquery.com/jquery-3.6.1.min.js"
                    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#archivedRecordsTable').DataTable({
                            "language": {
                                "lengthMenu": "Display _MENU_ records per page",
                                "zeroRecords": "No records available",
                                "info": "Showing page _PAGE_ of _PAGES_",
                                "infoEmpty": "No records available",
                                "infoFiltered": "(filtered from _MAX_ total records)"
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </section>
@endsection
