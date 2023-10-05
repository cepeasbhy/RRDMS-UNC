@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="department">
        <a href="{{ route('admin.home') }}">
            <i class="bi bi-arrow-bar-left"></i>
            BACK
        </a>
        <h2>College of {{ $deptName->dept_name }}</h2>
        <div class="department__contents">
            <table id="myTable">
                <thead>
                    <tr>
                        <th>STUDENT ID</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>DEPARTMENT</th>
                        <th>PROGRAM</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deptRecords as $student)
                        <tr>
                            <td data-label="Student Id">{{ $student->student_id }}</td>
                            <td data-label="First Name">{{ $student->first_name }}</td>
                            <td data-label="Last Name">{{ $student->last_name }}</td>
                            <td data-label="Department">{{ $student->dept_name }}</td>
                            <td data-label="Program">{{ $student->course_name }}</td>
                            <td data-label="Action">
                                <a href="{{ route('admin.viewStudent', ['deptID' => $deptID, 'studentID' => $student->student_id]) }}">VIEW</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <script src="https://code.jquery.com/jquery-3.6.1.min.js"
                integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#myTable').DataTable({
                        "language": {
                            "lengthMenu": "Records per page _MENU_",
                            "zeroRecords": "No Records Available",
                            "info": "Showing page _PAGE_ of _PAGES_",
                            "infoEmpty": "",
                            "infoFiltered": "(filtered from _MAX_ total records)"
                        }
                    });
                });
            </script>
        </div>
    </section>
@endsection
