@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="{{asset('/css/index.css')}}">
@endsection

@section('content')
    <h3>Student Credential Management</h3>
    <form action="/stud_cred_mngmnt/search" method="post" class="row">
        @csrf
        <div class="col-2 w-50">
            <input class="form-control form-control-sm bg-muted" name="studentID" placeholder="Enter Student ID..." type="text" required>
        </div>
        <div class="col">
            <input class="w-100 btn btn-sm btn-success"type="submit" value="SEARCH">
        </div>
        <div class="col">
            <input class="w-100 btn btn-sm btn-success" type="submit" value="ADD STUDENT" form="form-link-add">
        </div>
    </form>
    <form action="/stud_cred_mngmnt/add_student" id="form-link-add"></form>
    <div class="main-block">
        <div class="my-3">
            <form class="d-flex align-items-center" action="" method="post">
                <div class="pe-2">
                    <label>SORT BY</label>
                </div>
                <div class="pe-2">
                    <select name="sort" class="form-select form-select-sm">
                        <option value="student_id">Student ID</option>
                        <option value="first_name">FIRST NAME</option>
                        <option value="last_name">LAST NAME</option>
                        <option value="dept_name">DEPARTMENT</option>
                        <option value="course">COURSE</option>
                        <option value="admission_year">ADMISSION YEAR</option>
                    </select>
                </div>
                <div class="pe-2">
                    <input type="submit" value="UPDATE LIST" class="btn btn-success btn-sm">
                </div>
            </form>
        </div>
        <table>
            <th>STUDENT ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>DEPARTMENT</th>
            <th>COURSE</th>
            <th>ACTION</th>
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
        </table>
    </div>
@endsection