@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="{{asset('/css/index.css')}}">
@endsection

@section('content')

    <div class="block-header">
        <div class="wrapper">
            <h3>Student Credential Management</h3>
        </div>
        <div class="wrapper">
            <form action="" class="main-form">
                <div class="form-item col-3">
                    <input type="text" placeholder="Enter Student ID...">
                </div>
                <div class="form-item">
                    <input type="submit" value="SEARCH">
                </div>

                <div class="form-item">
                    <input type="submit" value="ADD STUDENT" id="btn-add-stud" form="add-stud-link">
                </div>
            </form>
            <form action="/stud_cred_mngmnt/add_student" method="GET" id="add-stud-link"> 
            </form> 
        </div>
        
    </div>

    <div class="main-block">

        <div class="search-filter">
            <div class="form-item">
                <label>SORT BY</label>
            </div>
            <div class="form-item">
                <select name="sort" id="">
                    <option value="Student ID">Student ID</option>
                    <option value="FIRST NAME">FIRST NAME</option>
                    <option value="LAST NAME">LAST NAME</option>
                    <option value="DEPARTMENT">DEPARTMENT</option>
                    <option value="COURSE">COURSE</option>
                    <option value="ADMISSION YEAR">ADMISSION YEAR</option>
                </select>
            </div>
            <div class="form-item">
                <input type="submit" value="UPDATE LIST">
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
                            <input type="submit" value="VIEW">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection