@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="{{asset('/css/index.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="my-3 row align-items-center">
        <div class="col-sm-8">
            <h3>Student Credential Management</h3>
            <span class="badge bg-success mb-2">{{session('msg')}}</span>
        </div>
        <div class="col-sm-4">
            <form class="w-100" action="/stud_cred_mngmnt/add_student" method="get">
                <input class="w-100 btn btn-sm btn-success" type="submit" value="ADD STUDENT">
            </form>
        </div>
    </div>
    
    <div class="container my-3">
        <table id="myTable" class="table table-striped" style="width: 100%">
            <thead>
                <th>STUDENT ID</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>DEPARTMENT</th>
                <th>COURSE</th>
                <th>ACTION</th>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{$student->student_id}}</td>
                        <td>{{$student->first_name}}</td>
                        <td>{{$student->last_name}}</td>
                        <td>{{$student->dept_name}}</td>
                        <td>{{$student->course_name}}</td>
                        <td>
                            <form action="/stud_cred_mngmnt/view_student/{{$student->student_id}}" method="GET">
                                @csrf
                                <input type="submit" value="VIEW" class="btn btn-success btn-sm">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
        
                $('#myTable').DataTable();
            });
         </script>
    </div>
@endsection