@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="my-3 row align-items-center">
        <form class="mb-3" action="{{ route('index') }}" method="get">
            <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
        <div class="col-sm-8 border-start border-danger border-4">
            <h3>Unarchived Records</h3>
            <span class="badge bg-success mb-2">{{ session('msg') }}</span>
        </div>
        {{-- TO DO: MAKE A BUTTON OR SOMETHING FOR BULK ARCHIVING OF RECORDS --}}
        {{-- <div class="col-sm-4">
            <form class="w-100" action="{{ route('show_unarchived_credential') }}" method="get">
                <input class="w-100 btn btn-sm btn-success" type="submit" value="ARCHIVE A RECORD">
            </form>
        </div> --}}
    </section>

    <section class="container my-3">
        <table id="archivedRecordsTable" class="table table-striped" style="width: 100%">
            <thead>
                <th class="custom-th bg-danger">STUDENT ID</th>
                <th class="custom-th bg-danger">FIRST NAME</th>
                <th class="custom-th bg-danger">LAST NAME</th>
                <th class="custom-th bg-danger">PROGRAM</th>
                <th class="custom-th bg-danger">ADMISSION YEAR</th>
                <th class="custom-th bg-danger">ACTION</th>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr class="custom-tr">
                        <td class="custom-td">{{ $student->student_id }}</td>
                        <td class="custom-td">{{ $student->first_name }}</td>
                        <td class="custom-td">{{ $student->last_name }}</td>
                        <td class="custom-td">{{ $student->dept_name }}</td>
                        <td class="custom-td">{{ $student->admission_year }}</td>
                        <td class="custom-td">
                            <form action="{{ route('checkRecord', ['id' => $student->student_id]) }}" method="GET">
                                @csrf
                                <input type="submit" value="VIEW" class="btn btn-success btn-sm">
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
    </section>
@endsection
