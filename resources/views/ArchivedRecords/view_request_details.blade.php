@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="req-details">
        <a href="{{ route('getRequests') }}">
            <i class="bi bi-arrow-bar-left"></i> BACK
        </a>

        <h1>Request Details</h1>

        <div class="req-details__data">
            <div class="req-details__data--requester">
                <h2>Requester</h2>
                <div class="req-details__data--requester-user">
                    <img draggable="false" src="{{ asset('storage/' . $staffPicture->picture_path) }}">
                    <div class="details">
                        <p>{{ $staff->last_name }}, {{ $staff->first_name }}</p>
                        <p>{{ $staff->staff_id }}</p>
                        @if ($staff->account_role == 'cic')
                            <p>College in Charge</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="dept">Assigned Department</label>
                    <input id="dept" name="dept" type="text" readonly value="{{ $staff->dept_name }}">
                </div>
                <div class="form-group" style="margin-top: 1rem">
                    <label for="id">Request ID</label>
                    <input id="id" name="id" value="{{ $requestInfo->request_id }}" type="text" readonly>
                </div>
            </div>

            <div class="req-details__data--requester">
                <h2>Record</h2>
                <div class="req-details__data--requester-user">
                    <img draggable="false" src="{{ asset('storage/' . $picturePath->document_loc) }}">
                    <div class="details">
                        <p>{{ $student->last_name }}, {{ $student->first_name }}</p>
                        <p>{{ $student->student_id }}</p>
                        <p>{{ $student->course_name }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="archive">Archive ID</label>
                    <input id="archive" name="archive" value="{{ $student->archive_id }}"type="text" readonly>
                </div>
                <div class="form-group" style="margin-top: 1rem">
                    <label for="department">Department</label>
                    <input id="department" name="department" value="{{ $student->dept_name }}"type="text" readonly>
                </div>
                <div class="form-group" style="margin-top: 1rem">
                    <label for="date">Date Requested</label>
                    <input id="date" name="date"
                        value="{{ date('Y-m-d', strtotime($requestInfo->created_at)) }}"type="text" readonly>
                </div>
                @if ($requestInfo->status == 2)
                    <div class="form-group" style="margin-top: 1rem">
                        <label for="reject">Reason for Rejecting</label>
                        <textarea id="reject" name="reject" style="resize: none" readonly>{{ $requestInfo->reason_for_rejection }}</textarea>
                    </div>
                @endif
                <div class="req-details__data--buttons">
                    <form action="{{ route('viewRequestedRecord', ['id' => $requestInfo->request_id]) }}"
                        method="post">
                        @csrf
                        <button class="view" type="submit">View</button>
                    </form>
                    @if ($requestInfo->status == 0)
                        <form action="{{ route('acceptRequestFromLogs', ['requestID' => $requestInfo->request_id]) }}"
                            method="post">
                            @csrf
                            <button type="submit">Approve</button>
                        </form>
                        <button class="reject" type="submit" data-bs-toggle="modal"
                            data-bs-target="#reject-request-modal">
                            Reject
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!--Modal for Rejecting Request-->
    @extends('layouts.modals.ArchivedRecords.reject_request_modal', ['routeName' => 'rejectRequest'])
@endsection
