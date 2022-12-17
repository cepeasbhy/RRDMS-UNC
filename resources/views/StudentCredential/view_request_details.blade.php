@extends('layouts.app')

@section('content')
    <div class="row mt-4 justify-content-center">
        <div class="col-5">
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
                        <label>Request ID</label>
                        <input class="form-control form-control-sm" value="{{$requestInfo->request_id}}"type="text" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label>Department</label>
                        <input class="form-control form-control-sm" value="{{$student->dept_name}}"type="text" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label>Date Requested</label>
                        <input class="form-control form-control-sm" value="{{date('Y-m-d', strtotime($requestInfo->created_at))}}"type="text" readonly>
                    </div>
                    @if($requestInfo->status == 2)
                        <div class="form-group mb-2">
                            <label>Reason</label>
                            <textarea class="form-control form-control-sm" style="resize: none" readonly
                            >{{$requestInfo->reason_for_rejection}}</textarea>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-danger btn-sm w-100" data-bs-toggle="modal"
                            data-bs-target="#cancel-request-modal">CANCEL REQUEST</button>
                    </div>
                    <form class="mb-3 col-6" action="{{ route('requestArchive') }}" method="get">
                        <button class="btn btn-success btn-sm w-100"><i class="bi bi-arrow-bar-left"></i> BACK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <!--Modal for Rejecting Request-->
     @extends('layouts.modals.cancelRequestedArchiveModal')
@endsection