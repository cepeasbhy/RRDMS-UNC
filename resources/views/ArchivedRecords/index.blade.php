@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="archives">
        <a href="{{ route('home') }}">
            <i class="bi bi-arrow-bar-left"></i>
            BACK
        </a>
        <h1>Archived Records Management</h1>
        <span style="margin-left: 1rem" class="badge bg-success mb-2">{{ session('msg') }}</span>

        <div class="archives__subheading">
            <h2>Manage Archives</h2>
            <div class="archives__subheading--buttons">
                <form action="{{ route('toBeArchived') }}" method="get">
                    <button type="submit" value="ARCHIVE A RECORD">
                        Archive a Record
                    </button>
                </form>
                <form action="{{ route('getRequests') }}" method="get">
                    <button class="view" type="submit" value="VIEW REQUESTS">
                        View Requests
                    </button>
                </form>
            </div>
        </div>

        <div class="archives__data">
            <table id="archivedRecordsTable">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Program</th>
                        <th>Action</th>
                    </tr>
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
                                    <input type="submit" value="VIEW">
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
                            "zeroRecords": " ",
                            "info": "Showing page _PAGE_ of _PAGES_",
                            "infoEmpty": "No records available",
                            "infoFiltered": "(filtered from _MAX_ total records)"
                        }
                    });
                });
            </script>
        </div>
    </section>
@endsection
