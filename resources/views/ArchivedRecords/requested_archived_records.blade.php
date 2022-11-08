@extends('layouts.app')
@extends('layouts.header')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <section class="my-3 row align-items-center">
        <div class="col-sm-6">
            <h3>Requested Records</h3>
            <span class="badge bg-success mb-2">{{ session('msg') }}</span>
        </div>
    </section>

    {{-- TO DO:
        - Implement accept/decline of requests |ON GOING|
        - Separate pending and approved requests
    --}}

    <section class="container my-3">
        <table id="archivedRecordsTable" class="table table-striped" style="width: 100%">
            <thead>
                <th class="custom-th bg-danger">Request ID</th>
                <th class="custom-th bg-danger">Archive ID</th>
                <th class="custom-th bg-danger">Staff ID</th>
                <th class="custom-th bg-danger">Request Date</th>
                <th class="custom-th bg-danger">Status</th>
                <th class="custom-th bg-danger">Action</th>
            </thead>
            <tbody>
                @foreach ($requestedArchives as $requestedArchive)
                    <tr class="custom-tr">
                        <td class="custom-td">{{ $requestedArchive->request_id }}</td>
                        <td class="custom-td">{{ $requestedArchive->archive_id }}</td>
                        <td class="custom-td">{{ $requestedArchive->staff_id }}</td>
                        <td class="custom-td">
                            {{ date('Y-m-d', strtotime($requestedArchive->created_at)) }}
                        </td>
                        <td class="custom-td">
                            @if ($requestedArchive->status == 0)
                                <span class="badge bg-secondary">-PENDING-</span>
                            @else
                                <span class="badge bg-success">-APPROVED-</span>
                            @endif
                        </td>
                        <td class="custom-td">
                            @if ($requestedArchive->status != 0)
                                Not Available
                            @else
                                {{-- <form action="{{ route('viewRequestedArchive', ['id' => $requestedArchive->request_id]) }}"
                                    method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-success">VIEW</button>
                                </form> --}}
                            @endif
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
