@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="requested-record">
        <a href="{{ route('requestArchive') }}">
            <i class="bi bi-arrow-bar-left"></i>
            BACK
        </a>
        <h1>Requested Record</h1>
        <div class="requested-record__subheading">
            <img draggable="false" class="profile-image view-request-val" src="{{ asset('storage/' . $picturePath->document_loc) }}">
            <div class="user-info">
                <p>{{ $student->last_name }}, {{ $student->first_name }}</p>
                <p>{{ $student->student_id }}</p>
                <p>{{ $student->course_name }}</p>
            </div>
        </div>

        <div class="form-group">
            <label for="id">Archive ID</label>
            <input id="id" name="id" value="{{ $student->archive_id }}"type="text" readonly>
        </div>
        <div class="form-group">
            <label for="req">Request ID</label>
            <input id="req" name="req" value="{{ $requestInfo->request_id }}"type="text" readonly>
        </div>
        <div class="form-group">
            <label for="dept">Department</label>
            <input id="dept" name="dept" value="{{ $student->dept_name }}"type="text" readonly>
        </div>
        <div class="form-group">
            <label for="date">Date Requested</label>
            <input id="date" name="date" value="{{ date('Y-m-d', strtotime($requestInfo->created_at)) }}"type="text"
                readonly>
        </div>
        @if ($requestInfo->status == 2)
            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" style="resize: none" readonly>{{ $requestInfo->reason_for_rejection }}</textarea>
            </div>
        @endif

        <button data-bs-toggle="modal" data-bs-target="#cancel-request-modal">
            CANCEL REQUEST
        </button>
    </section>


    <!--Modal for Rejecting Request-->
    @extends('layouts.modals.cancelRequestedArchiveModal')
@endsection
