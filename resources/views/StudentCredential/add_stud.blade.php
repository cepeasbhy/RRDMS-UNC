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
                            <input type="text" name="studentID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">FIRST NAME:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="firstName">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">LAST NAME:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="lastName">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">MIDDLE NAME:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="middleName">
                        </div>
                    </div>
                    <div class="form-row" id="selection">
        
                    </div>
                    <div class="form-row">
                        <div class="form-item">
                            <label for="">ADMISSION YEAR:</label>
                        </div>
                        <div class="form-item">
                            <input type="text" name="middleName">
                        </div>
                    </div>
                    <div class="form-row">
                        <input type="submit" value="ADD STUDENT">
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