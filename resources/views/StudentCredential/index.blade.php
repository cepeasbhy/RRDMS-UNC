@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="{{asset('/css/index.css')}}">
@endsection

@section('content')
    <h3>Student Credential Management</h3>
    <form action="/stud_cred_mngmnt/search" method="post" class="row">
        @csrf
        <div class="col-2 w-50">
            <input class="form-control form-control-sm bg-muted" name="studentID" placeholder="Enter Student ID..." type="text">
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
        <div class="d-flex align-items-center">
            <div class="p-2">
                <label>SORT BY</label>
            </div>
            <div class="p-2">
                <select name="sort" class="form-control form-control-sm">
                    <option value="Student ID">Student ID</option>
                    <option value="FIRST NAME">FIRST NAME</option>
                    <option value="LAST NAME">LAST NAME</option>
                    <option value="DEPARTMENT">DEPARTMENT</option>
                    <option value="COURSE">COURSE</option>
                    <option value="ADMISSION YEAR">ADMISSION YEAR</option>
                </select>
            </div>
            <div class="p-2">
                <input type="submit" value="UPDATE LIST" class="btn btn-success btn-sm">
            </div>
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