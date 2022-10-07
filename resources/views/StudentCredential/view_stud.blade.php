@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">STUDENT INFORMATION</h4>
            </div>
            <span class="badge bg-success mb-2">{{session('msg')}}</span>
            <div class="ms-2">
                <form>
                    @csrf
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Student ID:</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="studentID" value="{{$student->student_id}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">First Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="firstName" value="{{$student->first_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Last Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="lastName" value="{{$student->last_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Middle Name</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="middleName" value="{{$student->middle_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Department</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="department" value="{{$student->dept_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Course</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="course" value="{{$student->course_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label col-form-label-sm" for="">Admission Year</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-sm" type="text" name="admissionYear" value="{{$student->admission_year}}" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row g-2">
                <div class="col-6">
                    <button class="btn btn-success btn-sm btn-block" 
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
                        <form id="update-form" action="/stud_cred_mngmnt/view_student/{{$student->student_id}}" method="post">
                            @csrf
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label col-form-label-sm" for="">First Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-control-sm" type="text" name="firstName" value="{{$student->first_name}}">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label col-form-label-sm" for="">Last Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-control-sm" type="text" name="lastName" value="{{$student->last_name}}">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label col-form-label-sm" for="">Middle Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-control-sm" type="text" name="middleName" value="{{$student->middle_name}}">
                                </div>
                            </div>
                            <div class="form-group row mb-2" id="selection">
        
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label col-form-label-sm" for="">Admission Year</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-control-sm" type="text" name="admissionYear" value="{{$student->admission_year}}">
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
@endsection