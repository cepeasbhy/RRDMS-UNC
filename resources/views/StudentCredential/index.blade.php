@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="my-3 row align-items-center">
        <div class="col-sm-6">
            <h3>Student Credential Management</h3>
            <span class="badge bg-success mb-2">{{ session('msg') }}</span>
        </div>
        <div class="col-sm-3">
            <form class="w-100" action="{{ route('addStudent') }}" method="get">
                <input class="w-100 btn btn-sm btn-success" type="submit" value="ADD STUDENT">
            </form>
        </div>
        @if (Auth::user()->account_role == 'CIC')
            <div class="col-sm-3">
                <form class="w-100" action="{{route('requestArchive')}}" method="get">
                    <input class="w-100 btn btn-sm btn-danger" type="submit" value="REQUEST FROM ARCHIVES">
                </form>
            </div>
        @endif
    </div>

    <div class="container my-3">
        <table id="myTable" class="table" style="width: 100%">
            <thead>
                <th class="custom-th bg-danger">STUDENT ID</th>
                <th class="custom-th bg-danger">FIRST NAME</th>
                <th class="custom-th bg-danger">LAST NAME</th>
                <th class="custom-th bg-danger">PROGRAM</th>
                <th class="custom-th bg-danger">COURSE</th>
                <th class="custom-th bg-danger">ACTION</th>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr class="custom-tr">
                        <td class="custom-td">{{ $student->student_id }}</td>
                        <td class="custom-td">{{ $student->first_name }}</td>
                        <td class="custom-td">{{ $student->last_name }}</td>
                        <td class="custom-td">{{ $student->dept_name }}</td>
                        <td class="custom-td">{{ $student->course_name }}</td>
                        <td class="custom-td">
                            <form action="{{ route('viewStudent', ['id' => $student->student_id]) }}" method="GET">
                                @csrf
                                <input type="submit" value="VIEW" class="btn btn-success btn-sm">
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
                    "language":{
                        "lengthMenu": "Display _MENU_ records per page",
                        "zeroRecords": "No Records Available",
                        "info": "Showing page _PAGE_ of _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)"
                    }
                });
            });
        </script>
    </div>
@endsection
