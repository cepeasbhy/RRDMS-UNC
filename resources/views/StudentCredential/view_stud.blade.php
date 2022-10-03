@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="{{asset('/css/add_stud.css')}}">
@endsection

@section('content')
    <div class="main-block">
        <div class="block">
            <div class="block-title">
                <h4>STUDENT INFORMATION</h4>
            </div>
            <div class="form-wrapper">
                <form action="">
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">STUDENT ID:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="studentID" value="{{$student->student_id}}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">FIRST NAME:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="firstName" value="{{$student->first_name}}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">LAST NAME:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="lastName" value="{{$student->last_name}}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">MIDDLE NAME:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="middleName" value="{{$student->middle_name}}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">DEPARTMENT:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="department" value="{{$student->dept_name}}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">COURSE:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="course" value="{{$student->course_name}}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">ADMISSION YEAR:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="addmissionYear" value="{{$student->admission_year}}" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="block">
            <div class="block-title">
                <h4>STUDENT CREDENTIALS</h4>
            </div>
        </div>
    </div>
@endsection