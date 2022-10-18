@extends('layouts.app')

@section('content')
    <div class="row">
        <form class="mb-3" action="{{route('StudCredHome')}}" method="get">
            <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
        <div class="col">
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">STUDENT INFORMATION</h4>
            </div>
            <span class="badge bg-success mb-2">{{session('msg')}}</span>
            <div class="ms-2 mb-3">
                <div class="row align-items-center mb-3">
                    <img class="col-3 img-fluid rounded-circle" src="http://rrdms.srv/storage/{{$picturePath->document_loc}}">
                    <div class="col-9">
                        <span class="h4 fw-bold">{{$student->last_name}}, {{$student->first_name}} {{mb_substr($student->middle_name, 0, 1).'.'}}</span>
                        <br>
                        <span>{{$student->student_id}}</span>
                        <br>
                        <span>{{$student->course_name}}</span>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="col-form-label col-form-label-sm" for="">Program</label>
                    <input class="form-control form-control-sm" type="text" value="{{$student->dept_name}}" readonly>
                </div>
                <div class="mb-2">
                    <label class="col-form-label col-form-label-sm" for="">Admisson Year</label>
                    <input class="form-control form-control-sm" type="text" value="{{$student->admission_year}}" readonly>
                </div>
                <div class="mb-2">
                    <label class="col-form-label col-form-label-sm" for="">Date Filed</label>
                    <input class="form-control form-control-sm" type="text" value="{{date("Y-m-d",strtotime($student->created_at))}}" readonly>
                </div>
                <div class="mb-3">
                    <label class="col-form-label col-form-label-sm" for="">Last Updated</label>
                    <input class="form-control form-control-sm" type="text" value="{{date("Y-m-d",strtotime($student->updated_at))}}" readonly>
                </div>
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
        <div class="col mb-2">
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">STUDENT CREDENTIALS</h4>
            </div>
            <div class="row">
                @foreach ($credentials as $credential)
                    <div class="col-sm-4 mt-2">
                        <div class="card">
                            <img class="img-fluid p-1" src="{{url('storage/'.$student->student_id.'/'.$credential->getFilename())}}">
                            <div class="card-body text-center p-0">
                                <label class="col-form-label col-form-label-sm">{{$credential->getFilename()}}</label>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                        <form id="update-form" action="{{route('updateStudent', ['id' => $student->student_id])}}" method="post">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="col-form-label col-form-label-sm" for="">First Name</label>
                                    <input class="form-control form-control-sm @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{$student->first_name}}">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="col-form-label col-form-label-sm" for="">Last Name</label>
                                <input class="form-control form-control-sm @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{$student->last_name}}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="col-form-label col-form-label-sm" for="">Middle Name</label>
                                <input class="form-control form-control-sm @error('middle_name') is-invalid @enderror" type="text" name="middle_name" value="{{$student->middle_name}}">
                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2" id="selection">
        
                            </div>
                            <div class="form-group mb-2">
                                <label class="col-form-label col-form-label-sm" for="">Admission Year</label>
                                <input class="form-control form-control-sm @error('admission_year') is-invalid @enderror" type="text" name="admission_year" value="{{$student->admission_year}}">
                                @error('admission_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                    <form action="{{route('deleteStudent', ['id' => $student->student_id])}}" method="post">
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