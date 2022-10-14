@extends('layouts.app')

@section('content')
    <div class="row">
        <form class="mb-3" action="/stud_cred_mngmnt" method="get">
            <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
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
                            <input class="form-control form-control-sm @error('student_id') is-invalid @enderror" value="{{old('student_id')}}"type="text" name="student_id" required>
                            @error('student_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">First Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm @error('first_name') is-invalid @enderror" type="text" value="{{old('first_name')}}" name="first_name" required>
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Last Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm @error('last_name') is-invalid @enderror" type="text" value="{{old('last_name')}}" name="last_name" required>
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Middle Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm @error('middle_name') is-invalid @enderror" type="text" value="{{old('middle_name')}}" name="middle_name" required>
                            @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2" id="selection">
        
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Admission Year</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm @error('admission_year') is-invalid @enderror" type="text" value="{{old('admission_year')}}" name="admission_year" required>
                            @error('admission_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
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