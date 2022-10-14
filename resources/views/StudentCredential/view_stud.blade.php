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
            <span class="badge bg-success mb-2">{{session('msg')}}</span>
            <div class="ms-2">
                <form>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Student ID:</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" value="{{$student->student_id}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">First Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" value="{{$student->first_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Last Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" value="{{$student->last_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Middle Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" value="{{$student->middle_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Department</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" value="{{$student->dept_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Course</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" value="{{$student->course_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Admission Year</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" value="{{$student->admission_year}}" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row g-2">
                <div class="col-6">
                    <button id="clickButton" class="btn btn-success btn-sm btn-block" 
                    style="width: 100%" data-bs-toggle="modal" data-bs-target="#update-modal">UPDATE</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-danger btn-sm btn-block" 
                    style="width: 100%" data-bs-toggle="modal" data-bs-target="#delete-modal">DELETE</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">STUDENT CREDENTIALS</h4>
            </div>
        </div>
        <!--Modal for Updating Student Information-->
        <div id="update-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title-modal">Update Student Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update-form" action="/stud_cred_mngmnt/view_student/update/{{$student->student_id}}" method="post">
                            @csrf
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label col-form-label-sm" for="">First Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-control-sm @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{$student->first_name}}">
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
                                    <input class="form-control form-control-sm @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{$student->last_name}}">
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
                                    <input class="form-control form-control-sm @error('middle_name') is-invalid @enderror" type="text" name="middle_name" value="{{$student->middle_name}}">
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
                                    <input class="form-control form-control-sm @error('admission_year') is-invalid @enderror" type="text" name="admission_year" value="{{$student->admission_year}}">
                                    @error('admission_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-success" form="update-form">Update Information</button>
                        <button class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
       </div>
       <!--Modal for Deleting Student-->
       <div id="delete-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">Remove Student from Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure you want to remove this student from the records?
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="/stud_cred_mngmnt/view_student/delete/{{$student->student_id}}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-danger">Proceed</button>
                    </form>
                    <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('errors'))
        <script>
            window.onload = function(){
                document.getElementById('clickButton').click();
            }
        </script>
    @endif
@endsection