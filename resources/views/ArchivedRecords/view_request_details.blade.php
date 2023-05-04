@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="main-container" style="max-width: 80%; margin-top: 1rem">
        <form class="mb-3" action="{{ route('getRequests') }}" method="get">
            <button class="back view form-button"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
        <div class="grid-container wide-gap grid-orientation" style="width: 100%">
            <div class="flex-container inner" style="gap: 1rem;">
                <div class="head-container request-head">
                    <h4>REQUESTER INFORMATION</h4>
                </div>
                <div class="flex-container pic-direction">
                    <img class="profile-image view-request-val"
                        src="{{ asset('storage/' . $staffPicture->picture_path) }}">
                    <div class="user-info">
                        <span class="h4 fw-bold">{{ $staff->last_name }}, {{ $staff->first_name }}</span>
                        <span>{{ $staff->staff_id }}</span>
                        @if ($staff->account_role == 'cic')
                            <span>College in Charge</span>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="readonly-container">
                        <label>Assigned Department</label>
                        <input class="readonly-box" type="text" readonly value="{{ $staff->dept_name }}">
                    </div>
                    <div class="readonly-container" style="margin-top: 1rem">
                        <label>Request ID</label>
                        <input class="readonly-box" value="{{ $requestInfo->request_id }}" type="text" readonly>
                    </div>
                </div>
            </div>

            <div class="flex-container inner" style="gap: 1rem;">
                <div class="head-container request-head">
                    <h4>REQUESTED ARCHIVE</h4>
                </div>
                <div class="flex-container pic-direction">
                    <img class="profile-image view-request-val"
                        src="{{ asset('storage/' . $picturePath->document_loc) }}">
                    <div class="user-info">
                        <span class="h4 fw-bold">{{ $student->last_name }}, {{ $student->first_name }}</span>
                        <span>{{ $student->student_id }}</span>
                        <span>{{ $student->course_name }}</span>
                    </div>
                </div>
                <div>
                    <div class="readonly-container">
                        <label>Archive ID</label>
                        <input class="readonly-box" value="{{ $student->archive_id }}"type="text" readonly>
                    </div>
                    <div class="readonly-container" style="margin-top: 1rem">
                        <label>Department</label>
                        <input class="readonly-box" value="{{ $student->dept_name }}"type="text" readonly>
                    </div>
                    <div class="readonly-container" style="margin-top: 1rem">
                        <label>Date Requested</label>
                        <input class="readonly-box"
                            value="{{ date('Y-m-d', strtotime($requestInfo->created_at)) }}"type="text" readonly>
                    </div>
                    @if ($requestInfo->status == 2)
                        <div class="readonly-container" style="margin-top: 1rem">
                            <label>Reason for Rejecting</label>
                            <textarea class="readonly-box" style="resize: none" readonly>{{ $requestInfo->reason_for_rejection }}</textarea>
                        </div>
                    @endif
                </div>
                <div class="flex-container tri-button-container">
                    <div>
                        <form action="{{ route('viewRequestedRecord', ['id' => $requestInfo->request_id]) }}"
                            method="post">
                            @csrf
                            <button class="form-button blue-view">VIEW</button>
                        </form>
                    </div>
                    @if ($requestInfo->status == 0)
                        <di>
                            <form action="{{ route('acceptRequestFromLogs', ['requestID' => $requestInfo->request_id]) }}"
                                method="post">
                                @csrf
                                <button class="form-button green-approve">APPROVE</button>
                            </form>
                        </di>
                        <div>
                            <button class="form-button red-reject" data-bs-toggle="modal"
                                data-bs-target="#reject-request-modal">REJECT</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!--Modal for Rejecting Request-->
    @extends('layouts.modals.ArchivedRecords.reject_request_modal', ['routeName' => 'rejectRequest'])
@endsection
