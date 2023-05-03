@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="main-container" style="max-width: 80%">
        <form class="mb-3" action="{{ route('admin.home') }}" method="get">
            <button class="back view form-button"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
        <h4 class="head-container request-head">College of {{ $deptName->dept_name }}</h4>
        <div class="tab-container">
            <div class="tab-container__contents active">
                <table id="myTable" style="width: 100%">
                    <thead>
                        <th class="table-header">STUDENT ID</th>
                        <th class="table-header">FIRST NAME</th>
                        <th class="table-header">LAST NAME</th>
                        <th class="table-header">DEPARTMENT</th>
                        <th class="table-header">PROGRAM</th>
                        <th class="table-header">ACTION</th>
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
                                    <form
                                        action="{{ route('admin.viewStudent', ['deptID' => $deptID, 'studentID' => $student->student_id]) }}"
                                        method="GET">
                                        @csrf
                                        <input type="submit" value="VIEW" class="form-button view">
                                    </form>
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
        </div>
    </section>
@endsection
