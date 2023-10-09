@extends('layouts.app')
@extends('layouts.header')

@section('request-content')
    <section class="stud-req-info">
        @if (Auth::user()->account_role == 'cic')
            <form action="{{ route('cic.request') }}" method="get">
                <button class="accept">
                    <i class="bi bi-arrow-bar-left"></i> BACK
                </button>
            </form>
        @elseif (Auth::user()->account_role == 'student')
            <form action="{{ route('stud.request') }}" method="get">
                <button class="accept">
                    <i class="bi bi-arrow-bar-left"></i> BACK
                </button>
            </form>
        @endif

        <h1>Request Details</h1>

        <article class="stud-req-info__data">
            <h2>Requester</h2>
            <div class="stud-req-info__data--student">
                <img draggable="false"
                    src="{{ asset('storage/' . $picturePath->document_loc) }}">
                <div class="details">
                    <p>{{ $student->last_name }}, {{ $student->first_name }}
                        {{ mb_substr($student->middle_name, 0, 1) . '.' }}</p>
                    <p>{{ $student->student_id }}</p>
                    <p>{{ $student->course_name }}</p>
                    <p>{{ $student->dept_name }}</p>
                </div>
            </div>

            <div class="form-group">
                <label for="reqId">Request ID</label>
                <input id="reqId" name="reqId" type="text"
                    value="{{ $requestInfo->request_id }}" readonly>
            </div>

            <div class="form-group">
                <label for="num">Contact Number</label>
                <input id="num" name="num" type="text" value="{{ $student->phone_number }}"
                    readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" value="{{ $student->email }}"
                    readonly>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" style="resize: none" readonly>{{ trim($student->address) }}</textarea>
            </div>

            <div class="form-group">
                <label for="relDate">Release Date</label>
                @if ($requestInfo->release_date != null)
                    <input id="relDate" name="relDate" type="text"
                        value="{{ $requestInfo->release_date }}" readonly>
                @else
                    <input id="relDate" name="relDate" type="text" value="NOT FOR RELEASE" readonly>
                @endif
            </div>

            @if ($requestInfo->date_completed != null)
                <div class="form-group">
                    <label for="completed">Date Completed</label>
                    <input id="completed" name="completed" type="text"
                        value="{{ $requestInfo->date_completed }}" readonly>
                </div>
            @endif

            @if ($requestInfo->reason_for_rejection != null)
                <div class="form-group">
                    <label for="reason">Reason for Rejection</label>
                    <textarea id="reason" name="reason" style="resize: none; color: var(--bg-color-red-sub)" readonly>{{ trim($requestInfo->reason_for_rejection) }}</textarea>
                </div>
            @endif
        </article>

        <div class="stud-req-info__details">
            <section class="stud-req-info__details--documents">
                <h2>Submitted Documents</h2>
                <div class="container">
                    @if($requestInfo->submitted_file_loc != null)
                        @if($requestedDocumentDetails->diploma != null)
                            <div class="card">
                                <button class="btn p-0" data-bs-toggle="modal"
                                    data-bs-target="#affidavit">
                                    <img draggable="false" loading="lazy" class="img-fluid p-1" src="{{asset('storage/'.$requestInfo->submitted_file_loc[0]['affidavit'])}}">
                                </button>
                                <h3>Affidavit</h3>
                            </div>
                        @endif
                        @if($requestedDocumentDetails->transcript_of_record != null)
                            <div class="container">
                                <button class="btn p-0" data-bs-toggle="modal"
                                    data-bs-target="#picture">
                                    @if($requestedDocumentDetails->diploma == null)
                                        <img draggable="false" loading="lazy" class="img-fluid p-1" src="{{asset('storage/'.$requestInfo->submitted_file_loc[0]['picture'])}}">
                                    @else
                                        <img draggable="false" loading="lazy" class="img-fluid p-1" src="{{asset('storage/'.$requestInfo->submitted_file_loc[1]['picture'])}}">
                                    @endif
                                </button>
                                <h3>Picture</h3>
                            </div>
                        @endif
                    @else
                        <h3 class="fw-bold text-danger">No Documents Have Been Submitted</span>
                    @endif
                </div>
            </section>

            <section class="stud-req-info__details--request">
                <h2>Requested Documents</h2>

                <div class="wrapper">
                    @if ($requestedDocumentDetails->diploma != null)
                        <div class="document">
                            <h3>Diploma</h3>
                            @foreach ($requestedDocumentDetails->diploma as $diploma)
                                @if ($diploma['description'] == 'TOTAL PRICE')
                                    <p>{{ $diploma['description'] }}: <span>₱{{ number_format($diploma['price'], 2) }}</span></p>
                                @else
                                    <p>{{ $diploma['description'] }}: <span>₱{{ number_format($diploma['price'], 2) }}</span></p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @if ($requestedDocumentDetails->transcript_of_record != null)
                        <div class="document">
                            <h3>Transcript of Records</h3>
                            <p>No. of Copies: <span>{{ $requestedDocumentDetails->transcript_of_record['copies'] }}</span></p>
                            @if ($requestedDocumentDetails->transcript_of_record['other_purpose'] == null)
                                <p>Purpose: <span>{{ $requestedDocumentDetails->transcript_of_record['purpose'] }}</span></p>
                            @else
                                <p>Other Purpose: <span>{{ $requestedDocumentDetails->transcript_of_record['other_purpose'] }}</span></p>
                            @endif
                            <p>TOTAL PRICE: <span>₱{{ number_format($requestedDocumentDetails->transcript_of_record[0]['price'], 2) }}</span></p>
                        </div>
                    @endif

                    @if ($requestedDocumentDetails->certificate != null)
                        <div class="document">
                            <h3>Certificates</h3>
                            @foreach ($requestedDocumentDetails->certificate as $certificate)
                                @foreach ($certificate as $description => $value)
                                    @if ($description == 'TOTAL PRICE')
                                        <p>{{ $description }}: <span>₱{{ number_format($value, 2) }}</span></p>
                                    @else
                                        <p>{{ $description }}: <span>{{ $value }}</span></p>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    @endif

                    @if ($requestedDocumentDetails->copy_of_grades != null)
                        <div class="document">
                            <h3>Copy of Grades</h3>
                            <p>No. of Copies: {{ $requestedDocumentDetails->copy_of_grades['copies'] }}</p>
                            @if ($requestedDocumentDetails->copy_of_grades['schoolYear'] == null)
                                <p>School Year: <span>Not Stated</span></p>
                            @else
                                <p>School Year: <span>{{ $requestedDocumentDetails->copy_of_grades['schoolYear'] }}</span></p>
                            @endif

                            @switch($requestedDocumentDetails->copy_of_grades['semester'])
                                @case(1)
                                    <p>Semester: <span>1st Semester</span></p>
                                @break

                                @case(2)
                                    <p>Semester: <span>2nd Semester</span></p>
                                @break

                                @default
                                    <p>Semester: <span>Summer Semester</span></p>
                            @endswitch
                            <p>TOTAL PRICE: <span>₱{{ number_format($requestedDocumentDetails->copy_of_grades[0]['price'], 2) }}</span></p>
                        </div>
                    @endif

                    @if ($requestedDocumentDetails->authentication != null)
                        <div class="document">
                            <h3>Authentication</h3>
                            @foreach ($requestedDocumentDetails->authentication as $auth)
                                @if ($auth['description'] == 'TOTAL PRICE')
                                    <p>{{ $auth['description'] }}: <span>₱{{ number_format($auth['price'], 2) }}</span></p>
                                @else
                                    <p>{{ $auth['description'] }}: <span>₱{{ number_format($auth['price'], 2) }}</span></p>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if ($requestedDocumentDetails->photocopy != null)
                        <div class="document">
                            <h3>Photocopy</h3>
                            @foreach ($requestedDocumentDetails->photocopy as $photoCopy)
                                @if ($photoCopy['description'] != 'Photocopy Type')
                                    @if ($photoCopy['description'] == 'TOTAL PRICE')
                                        <p>{{ $photoCopy['description'] }}: <span>₱{{ number_format($photoCopy['value'], 2) }}</span></p>
                                    @else
                                        <p>{{ $photoCopy['description'] }}: <span>₱{{ number_format($photoCopy['value'], 2) }}</span></p>
                                    @endif
                                @else
                                    <p>{{ strtoupper($photoCopy['value']) }}</p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <p class="total">Total Price: <span> ₱{{ number_format($requestedDocumentDetails->total_fee, 2) }}</span></p>
            </section>
        </div>

        <div class="stud-req-info__buttons">
            @if ($requestInfo->status == 'IN PROGRESS' && Auth::user()->account_role == 'cic')
                <button class="accept" data-bs-toggle="modal"
                    data-bs-target="#accept-request-modal">
                    Accept Request
                </button>
                <button class="reject" data-bs-toggle="modal"
                    data-bs-target="#delete-request-modal">
                    Reject Request
                </button>
            @endif

            @if ($requestInfo->status == 'SET FOR RELEASE' && Auth::user()->account_role == 'cic')
                <button class="accept" data-bs-toggle="modal"
                    data-bs-target="#accept-request-modal">
                    Complete Request
                </button>
            @endif

            @if ($requestInfo->status == 'IN PROGRESS' && Auth::user()->account_role == 'student')
                <button class="reject" data-bs-toggle="modal"
                    data-bs-target="#delete-request-modal">
                    Cancel Request
                </button>
            @endif

            @if (Auth::user()->account_role == 'student')
                <a class="accept"
                    href="{{ route('stud.pdfRequest', ['requestID' => $requestInfo->request_id]) }}">
                    Print Request
                </a>
            @endif
        </div>
    </section>


    <!--Modal for Rejecting Request-->
    @extends('layouts.modals.delete_student_request', ['routeName' => 'cic.rejectRequest', 'request_id' => $requestedDocumentDetails, 'request_status' => $requestInfo])
    <!--Modal for Accepting Request-->
    @extends('layouts.modals.accept_student_request', ['routeName' => 'cic.acceptRequest', 'request_id' => $requestedDocumentDetails, 'request_status' => $requestInfo])
    @extends('layouts.modals.viewSubmittedDoc')
@endsection
