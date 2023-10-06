@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="manage-student">
        <a href="{{ route('home') }}">
            <i class="bi bi-arrow-bar-left"></i>
            BACK
        </a>
        <h1>Student Credential Management</h1>
        <span class="badge bg-success mb-2">{{ session('msg') }}</span>
        <div class="manage-student__subheading">
            <h2>Manage Students</h2>
            <div class="manage-student__buttons">
                @if (Auth::user()->account_role == 'cic')
                    <form action="{{ route('addStudent') }}" method="get">
                        <button type="submit" value="ADD STUDENT">
                            Add a Student
                        </button>
                    </form>
                    <form action="{{ route('requestArchive') }}" method="get">
                        <button class="request" type="submit" value="REQUEST FROM ARCHIVES">
                            Request Record</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="manage-student__data">
            <table id="studentsTable">
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
                        <tr class="custom-tr">
                            <td data-label="Student Id">{{ $student->student_id }}</td>
                            <td data-label="First Name">{{ $student->first_name }}</td>
                            <td data-label="Last Name">{{ $student->last_name }}</td>
                            <td data-label="Department">{{ $student->dept_name }}</td>
                            <td data-label="Program">{{ $student->course_name }}</td>
                            <td data-label="Action">
                                <form action="{{ route('viewStudent', ['id' => $student->student_id]) }}"
                                    method="GET">
                                    @csrf
                                    <input type="submit" value="VIEW" class="view form-button">
                                </form>
                            </td>
                        </tr>
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
            $('#studentsTable').DataTable({
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
