@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="{{asset('/css/index.css')}}">
@endsection

@section('content')
    <div class="block-header">
        <h3 class="col-2">Student Credential Management</h3>
        <form action="" method="POST">
            <div class="form-item col-4">
                <input type="text" placeholder="Enter student ID...">
            </div>
            <div class="form-item col-1">
                <input type="submit" value="SEARCH" id="btn-search">
            </div>
            <div class="form-item col-1">
                <input type="submit" value="ADD STUDENT" id="btn-add-stud">
            </div>
        </form>
    </div>

    <div class="main-block">
        <div class="block-title">
            <h3>LIST OF STUDENTS</h3>
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
        </table>
    </div>
@endsection