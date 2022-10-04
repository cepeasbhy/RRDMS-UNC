@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">STUDENT INFORMATION</h4>
            </div>
            <div class="ms-2">
                <form action="/stud_cred_mngmnt/add_student" method="POST">
                    @csrf
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Student ID:</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="studentID" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">First Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="firstName" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Last Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="lastName" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Middle Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="middleName" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2" id="selection">
        
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Admission Year</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="addmissionYear" required>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <input class="btn btn-sm btn-success"type="submit" value="ADD STUDENT">
                    </div>
                </form>
            </div>
        </div>
        <div class="col">
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">STUDENT CREDENTIALS</h4>
            </div>
        </div>
    </div>
@endsection