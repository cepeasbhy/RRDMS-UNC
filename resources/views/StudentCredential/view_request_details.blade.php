@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="main-container" style="max-width: 70%; margin-top: 3rem">
        <form action="{{ route('requestArchive') }}" method="get">
            <button class="back view form-button"><i class="bi bi-arrow-bar-left"></i>
                BACK</button>
        </form>
        <h4 class="head-container request-head">REQUESTED ARCHIVE</h4>
        <div class="flex-container pic-direction">
            <img class="profile-image view-request-val" src="{{ asset('storage/' . $picturePath->document_loc) }}">
            <div class="user-info">
                <span class="h4 fw-bold">{{ $student->last_name }}, {{ $student->first_name }}</span>
                <br>
                <span>{{ $student->student_id }}</span>
                <br>
                <span>{{ $student->course_name }}</span>
            </div>
        </div>
        <div>
            <div class="form-pair">
                <label>Archive ID</label>
                <input class="readonly-box" value="{{ $student->archive_id }}"type="text" readonly>
            </div>
            <div class="form-pair">
                <label>Request ID</label>
                <input class="readonly-box" value="{{ $requestInfo->request_id }}"type="text" readonly>
            </div>
            <div class="form-pair">
                <label>Department</label>
                <input class="readonly-box" value="{{ $student->dept_name }}"type="text" readonly>
            </div>
            <div class="form-pair">
                <label>Date Requested</label>
                <input class="readonly-box" value="{{ date('Y-m-d', strtotime($requestInfo->created_at)) }}"type="text"
                    readonly>
            </div>
            @if ($requestInfo->status == 2)
                <div class="form-pair">
                    <label>Reason</label>
                    <textarea class="readonly-box" style="resize: none" readonly>{{ $requestInfo->reason_for_rejection }}</textarea>
                </div>
            @endif
        </div>

        <div style="text-align: center; margin-top: 1rem">
            <button class="cancel" data-bs-toggle="modal" data-bs-target="#cancel-request-modal">CANCEL REQUEST</button>
        </div>
    </section>


    <!--Modal for Rejecting Request-->
    @extends('layouts.modals.cancelRequestedArchiveModal')
@endsection
