@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="view-container">
        <div class="grid-container student-lists form-content">
            <div>
                <h2 class="head-container request-head" style="margin-bottom: 0">Student Credential Management</h2>

            </div>
            <div class="grid-container cic-buttons">
                @if (Auth::user()->account_role == 'cic')
                    <div>
                        <form style="margin: 0" action="{{ route('addStudent') }}" method="get">
                            <button class="green-button button-design" type="submit" value="ADD STUDENT">ADD A
                                STUDENT</button>
                        </form>
                    </div>
                    <div>
                        <form style="margin: 0" action="{{ route('requestArchive') }}" method="get">
                            <button class="red-button button-design" type="submit" value="REQUEST FROM ARCHIVES">REQUEST
                                FROM ARCHIVES</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div style="width: 79%">
            <span style="text-align: left" class="badge bg-success mb-2">{{ session('msg') }}</span>
        </div>
        <div class="tab-container" style="min-width: 80%; border-top: 0">
            <div class="tab-container__contents active">
                <table id="studentsTable">
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
                            <tr class="custom-tr">
                                <td data-label="Student Id:">{{ $student->student_id }}</td>
                                <td data-label="First Name:">{{ $student->first_name }}</td>
                                <td data-label="Last Name:">{{ $student->last_name }}</td>
                                <td data-label="Department:">{{ $student->dept_name }}</td>
                                <td data-label="Program:">{{ $student->course_name }}</td>
                                <td data-label="Action:">
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
