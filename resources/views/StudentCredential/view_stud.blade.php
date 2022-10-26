@extends('layouts.app')

@section('content')
    <div class="row mb-3">
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
                    <img class="col-3 img-fluid rounded-circle student-pic" data-bs-toggle="modal" data-bs-target="{{"#".$picturePath->document_id}}" src="{{asset('storage/'.$picturePath->document_loc)}}">
                    <div class="col-9">
                        <span class="h4 fw-bold">{{$student->last_name}}, {{$student->first_name}} {{mb_substr($student->middle_name, 0, 1).'.'}}</span>
                        <br>
                        <span>{{$student->student_id}}</span>
                        <br>
                        <span>{{$student->course_name}}</span>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="col-form-label col-form-label-sm" for="">Email</label>
                    <input class="form-control form-control-sm" type="text" value="{{$student->email}}" readonly>
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
            <span class="badge bg-success mb-2">{{session('msgCred')}}</span>
            <div class="row">
                @foreach ($credentials as $credential)
                    @if ($credential->document_name != 'Picture')
                        <div class="col-sm-4 mt-2">
                            <div class="card">
                                <button class="btn p-0" data-bs-toggle="modal" data-bs-target="{{"#".$credential->document_id}}">
                                    <img class="img-fluid p-1" src="{{asset('storage/'.$credential->document_loc)}}">
                                </button>
                                <div class="card-body text-center p-0">
                                    <label class="col-form-label col-form-label-sm">{{$credential->document_name}}</label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col mt-3 text-center">
                <button class="btn btn-sm btn-success w-75" data-bs-toggle="modal" 
                data-bs-target="#add-single-rec">ADD A RECORD</button>
            </div>
        </div>
    </div>
        <!--Modal for Updating Student Information-->
        @extends('layouts.modals.StudentCredential.updateStudModal')
        <!--Modal for Deleting Student-->
        @extends('layouts.modals.StudentCredential.deleteStudModal')
        <!--Modal for Viewing Credential-->
        @extends('layouts.modals.StudentCredential.viewCredModal')
        <!--Modal for deleting Credential-->
        @extends('layouts.modals.StudentCredential.deleteCredModal')
        <!--Modal for updating Credential-->
        @extends('layouts.modals.StudentCredential.updateCredModal')
        <!--Modal for adding a Credential-->
        @extends('layouts.modals.StudentCredential.addSingleRecModal')
    @if(Session::has('errors'))
        <script>
            window.onload = function(){
                document.getElementById('clickButton').click();
            }
        </script>
    @endif
@endsection