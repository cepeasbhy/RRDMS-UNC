@extends('layouts.app')

@section('css-link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="row mt-4">
        <form class="mb-3" action="{{ route('getRequests') }}" method="get">
            <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
        <div class="col">
            <div class="col">
                <div class="border-start border-danger border-4">
                    <h4 class="ms-3">REQUESTER INFORMATION</h4>
                </div>
            </div>
            <div class="row align-items-center ms-3 mb-3">
                <img class="col-3 img-fluid rounded-circle student-pic" src="{{asset('storage/'.$staffPicture->picture_path)}}">
                <div class="col-9">
                    <span class="h4 fw-bold">{{$staff->last_name}}, {{$staff->first_name}}</span>
                    <br>
                    <span>{{$staff->staff_id}}</span>
                    @if($staff->account_role == 'cic')
                        <br>
                        <span>College in Charge</span>
                    @endif
                </div>
            </div>
            <div class="row ms-3">
                <div class="form-group mb-2">
                    <label>Assigned Department</label>
                    <input class="form-control form-control-sm w-75" type="text" readonly value="{{$staff->dept_name}}">
                </div>
                <div class="form-group mb-2">
                    <label>Request ID</label>
                    <input class="form-control form-control-sm w-75" value="{{$requestInfo->request_id}}" type="text" readonly> 
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col">
                <div class="border-start border-danger border-4">
                    <h4 class="ms-3">REQUESTED ARCHIVE</h4>
                </div>
                <div class="row align-items-center ms-3 mb-3">
                    <img class="col-3 img-fluid rounded-circle student-pic" src="{{asset('storage/'.$picturePath->document_loc)}}">
                    <div class="col-9">
                        <span class="h4 fw-bold">{{$student->last_name}}, {{$student->first_name}}</span>
                        <br>
                        <span>{{$student->student_id}}</span>
                        <br>
                        <span>{{$student->course_name}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mb-2">
                        <label>Archive ID</label>
                        <input class="form-control form-control-sm" value="{{$student->archive_id}}"type="text" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label>Department</label>
                        <input class="form-control form-control-sm" value="{{$student->dept_name}}"type="text" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label>Date Requested</label>
                        <input class="form-control form-control-sm" value="{{date('Y-m-d', strtotime($requestInfo->created_at))}}"type="text" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <form action="{{ route('viewRequestedRecord', ['id' => $requestInfo->request_id]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-sm btn-primary w-100">VIEW</button>
                        </form>
                    </div>
                    @if($requestInfo->status == 0)
                    <div class="col-4">
                        <form action="{{ route('acceptRequestFromLogs', ['requestID' => $requestInfo->request_id]) }}" method="post">
                            @csrf
                            <button class="btn btn-success btn-sm w-100">APPROVE</button>
                        </form>
                    </div>
                    @endif
                    <div class="col-4">
                        <button class="btn btn-danger btn-sm w-100" data-bs-toggle="modal"
                            data-bs-target="#delete-request-modal">DELETE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!--Modal for Deleting Record-->
     @extends('layouts.modals.ArchivedRecords.delete_request_modal', ['routeName' => 'deleteRequest'])
@endsection