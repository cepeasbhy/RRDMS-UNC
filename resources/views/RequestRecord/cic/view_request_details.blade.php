@extends('layouts.app')
@extends('layouts.header')

@section('request-content')
    <section class="view-container">

        <div class="request-head main-container" style="width: 100%; max-width: 80%">
            @if (Auth::user()->account_role == 'cic')
                <form action="{{ route('cic.request') }}" method="get">
                    <button class="back view form-button"><i class="bi bi-arrow-bar-left"></i>
                        BACK</button>
                </form>
            @elseif (Auth::user()->account_role == 'student')
                <form action="{{ route('stud.request') }}" method="get">
                    <button class="back view form-button"><i class="bi bi-arrow-bar-left"></i>
                        BACK</button>
                </form>
            @endif
        </div>
        <div class="grid-container wide-gap grid-orientation">
            <div>
                <div class="flex-container inner" style="gap: 3rem;">
                    <article class="view-container">
                        <div class="request-head head-container">
                            <h4>STUDENT INFORMATION</h4>
                        </div>
                        <div class="wide-screen-grid flex-container pic-direction">
                            <img class="profile-image view-request-val"
                                src="{{ asset('storage/' . $picturePath->document_loc) }}">
                            <div class="user-info">
                                <span class="h4 fw-bold">{{ $student->last_name }}, {{ $student->first_name }}
                                    {{ mb_substr($student->middle_name, 0, 1) . '.' }}</span>
                                <span>{{ $student->student_id }}</span>
                                <span>{{ $student->course_name }}</span>
                                <span>{{ $student->dept_name }}</span>
                            </div>
                        </div>
                    </article>

                    <div class="flex-container inner" style="height: fit-content;">
                        <div class="form-group mb-1">
                            <label>Request ID</label>
                            <input class="form-control form-control-sm" type="text"
                                value="{{ $requestInfo->request_id }}" readonly>
                        </div>

                        <div class="form-group mb-1">
                            <label>Contact Number</label>
                            <input class="form-control form-control-sm" type="text" value="{{ $student->phone_number }}"
                                readonly>
                        </div>

                        <div class="form-group mb-1">
                            <label>Email</label>
                            <input class="form-control form-control-sm" type="text" value="{{ $student->email }}"
                                readonly>
                        </div>

                        <div class="form-group mb-1">
                            <label>Address</label>
                            <textarea class="form-control form-control-sm" style="resize: none" readonly>{{ trim($student->address) }}</textarea>
                        </div>

                        <div class="form-group mb-1">
                            <label>Release Date</label>
                            @if ($requestInfo->release_date != null)
                                <input class="form-control form-control-sm" type="text"
                                    value="{{ $requestInfo->release_date }}" readonly>
                            @else
                                <input class="form-control form-control-sm" type="text" value="NOT FOR RELEASE" readonly>
                            @endif
                        </div>

                        @if ($requestInfo->date_completed != null)
                            <div class="form-group mb-1">
                                <label>Date Completed</label>
                                <input class="form-control form-control-sm" type="text"
                                    value="{{ $requestInfo->date_completed }}" readonly>
                            </div>
                        @endif

                        @if ($requestInfo->reason_for_rejection != null)
                            <div class="form-group mb-1">
                                <label>Reason for Rejection</label>
                                <textarea class="form-control form-control-sm" style="resize: none; color: var(--bg-color-red-sub)" readonly>{{ trim($requestInfo->reason_for_rejection) }}</textarea>
                            </div>
                        @endif
                    </div>


                </div>
            </div>

            <section>
                <div class="request-head head-container">
                    <h4>REQUESTED DOCUMENTS</h4>
                </div>


                @if ($requestedDocumentDetails->diploma != null)
                    <h6 style="font-weight: var(--font-weight-bold); margin-left: 1rem">DIPLOMA</h6>

                    <div class="flex-container photocopy-prices req-docs">

                        <div>
                            <span class="fw-bold">DESCRIPTION</span>

                            @foreach ($requestedDocumentDetails->diploma as $diploma)
                                <div>
                                    @if ($diploma['description'] == 'TOTAL PRICE')
                                        <span class="fw-bold"
                                            style="font-size: 0.85rem">{{ $diploma['description'] }}</span>
                                    @else
                                        <span style="font-size: 0.85rem">{{ $diploma['description'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div>
                            <span class="fw-bold">PRICE</span>
                            @foreach ($requestedDocumentDetails->diploma as $diploma)
                                <div>
                                    @if ($diploma['description'] == 'TOTAL PRICE')
                                        <span class="fw-bold" style="font-size: 0.85rem">
                                            ₱{{ number_format($diploma['price'], 2) }}</span>
                                    @else
                                        <span style="font-size: 0.75rem">₱{{ number_format($diploma['price'], 2) }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br>
                @endif

                @if ($requestedDocumentDetails->transcript_of_record != null)
                    <h6 style="font-weight: var(--font-weight-bold); margin-left: 1rem">TRANSCRIPT OF RECORD</h6>
                    <div class="flex-container photocopy-prices req-docs">
                        <div style="font-weight: 500">
                            <p style="font-size: 0.75rem; margin: 0">No. of Copies:</p>
                            @if($requestedDocumentDetails->transcript_of_record['other_purpose'] == null)
                                <p style="font-size: 0.75rem; margin: 0">Purpose:</p>
                            @else
                                <p style="font-size: 0.75rem; margin: 0">Other Purpose:</p>
                            @endif
                            <p style="font-size: 0.85rem; font-weight: 600; margin: 0">TOTAL PRICE:</p>
                        </div>

                        <div style="text-align: end">
                            <p style="font-size: 0.75rem; margin: 0">
                                {{ $requestedDocumentDetails->transcript_of_record['copies'] }}</p>
                            @if ($requestedDocumentDetails->transcript_of_record['other_purpose'] == null)
                            <p style="font-size: 0.75rem; margin: 0">
                                {{ $requestedDocumentDetails->transcript_of_record['purpose'] }}</p>
                            @else
                                <p style="font-size: 0.75rem; margin: 0">
                                    {{ $requestedDocumentDetails->transcript_of_record['other_purpose'] }}</p>
                            @endif
                            <p style="font-size: 0.85rem; font-weight: 600; margin: 0">
                                ₱{{ number_format($requestedDocumentDetails->transcript_of_record[0]['price'], 2) }}
                            </p>
                        </div>
                    </div>
                    <br>
                @endif

                @if ($requestedDocumentDetails->certificate != null)
                    <h6 style="font-weight: var(--font-weight-bold); margin-left: 1rem">CERTIFICATES</h6>
                    <div class="flex-container photocopy-prices req-docs">
                        <div>
                            <span class="fw-bold">DESCRIPTION</span>
                            @foreach ($requestedDocumentDetails->certificate as $certificate)
                                @foreach ($certificate as $description => $value)
                                    <div>
                                        @if ($description == 'TOTAL PRICE')
                                            <span class="fw-bold" style="font-size: 0.85rem">{{ $description }}</span>
                                        @else
                                            <span style="font-size: 0.75rem">{{ $description }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                        <div>
                            <span class="fw-bold">COPIES</span>
                            @foreach ($requestedDocumentDetails->certificate as $certificate)
                                @foreach ($certificate as $description => $value)
                                    <div>
                                        @if ($description == 'TOTAL PRICE')
                                            <span class="fw-bold"
                                                style="font-size: 0.85rem">₱{{ number_format($value, 2) }}</span>
                                        @else
                                            <span style="font-size: 0.75rem">{{ $value }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <br>
                @endif

                @if ($requestedDocumentDetails->copy_of_grades != null)
                    <h6 style="font-weight: var(--font-weight-bold); margin-left: 1rem">COPY OF GRADES</h6>
                    <div class="flex-container photocopy-prices req-docs">
                        <div style="font-weight: 500">
                            <p style="font-size: 0.75rem; margin: 0">No. of Copies:</p>
                            <p style="font-size: 0.75rem; margin: 0">School Year:</p>
                            <p style="font-size: 0.75rem; margin: 0">Semester:</p>
                            <p style="font-size: 0.85rem; font-weight: 600; margin: 0">TOTAL PRICE:</p>
                        </div>

                        <div style="text-align: end">
                            <p style="font-size: 0.75rem; margin: 0">
                                {{ $requestedDocumentDetails->copy_of_grades['copies'] }}</p>
                            @if ($requestedDocumentDetails->copy_of_grades['schoolYear'] == null)
                                <p style="font-size: 0.75rem; margin: 0">
                                    Not Stated</p>
                            @endif
                            <p style="font-size: 0.75rem; margin: 0">
                                {{ $requestedDocumentDetails->copy_of_grades['schoolYear'] }}</p>

                            @switch($requestedDocumentDetails->copy_of_grades['semester'])
                                @case(1)
                                    <span style="font-size: 0.75rem; margin: 0">1st Semester</span>
                                @break

                                @case(2)
                                    <span style="font-size: 0.75rem; margin: 0">2nd Semester</span>
                                @break

                                @default
                                    <span style="font-size: 0.75rem; margin: 0">Summer Semester</span>
                            @endswitch
                            <p class="fw-bold" style="font-size: 0.85rem; margin: 0">
                                ₱{{ number_format($requestedDocumentDetails->copy_of_grades[0]['price'], 2) }}</p>
                        </div>
                    </div>
                    <br>
                @endif

                @if ($requestedDocumentDetails->authentication != null)
                    <h6 style="font-weight: var(--font-weight-bold); margin-left: 1rem">AUTHENTICATION</h6>
                    <div class="flex-container photocopy-prices req-docs">
                        <div>
                            <span class="fw-bold">DESCRIPTION</span>
                            @foreach ($requestedDocumentDetails->authentication as $auth)
                                <div>
                                    @if ($auth['description'] == 'TOTAL PRICE')
                                        <span class="fw-bold"
                                            style="font-size: 0.85rem; margin: 0">{{ $auth['description'] }}</span>
                                    @else
                                        <span style="font-size: 0.75rem; margin: 0">{{ $auth['description'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div>
                            <span class="fw-bold">PRICE</span>
                            @foreach ($requestedDocumentDetails->authentication as $auth)
                                <div>
                                    @if ($auth['description'] == 'TOTAL PRICE')
                                        <span class="fw-bold"
                                            style="font-size: 0.85rem; margin: 0">₱{{ number_format($auth['price'], 2) }}</span>
                                    @else
                                        <span
                                            style="font-size: 0.75rem; margin: 0">₱{{ number_format($auth['price'], 2) }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br>
                @endif

                @if ($requestedDocumentDetails->photocopy != null)
                    <h6 style="font-weight: var(--font-weight-bold); margin-left: 1rem">PHOTOCOPY</h6>
                    <div class="flex-container photocopy-prices req-docs">
                        <div>
                            <span class="fw-bold">DESCRIPTION</span>
                            @foreach ($requestedDocumentDetails->photocopy as $photoCopy)
                                <div>
                                    @if ($photoCopy['description'] == 'TOTAL PRICE')
                                        <span class="fw-bold"
                                            style="font-size: 13px">{{ $photoCopy['description'] }}</span>
                                    @else
                                        <span style="font-size: 13px">{{ $photoCopy['description'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div>
                            <span class="fw-bold">PRICE</span>
                            @foreach ($requestedDocumentDetails->photocopy as $photoCopy)
                                <div>
                                    @if ($photoCopy['description'] != 'Photocopy Type')
                                        @if ($photoCopy['description'] == 'TOTAL PRICE')
                                            <span class="fw-bold"
                                                style="font-size: 13px">₱{{ number_format($photoCopy['value'], 2) }}</span>
                                        @else
                                            <span
                                                style="font-size: 13px">₱{{ number_format($photoCopy['value'], 2) }}</span>
                                        @endif
                                    @else
                                        <span style="font-size: 13px">{{ strtoupper($photoCopy['value']) }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br>
                @endif
                <div class="display-total-price">
                    <div class="description">
                        <h5 style="font-weight: var(--font-weight-bold); margin-left: 1rem">TOTAL PRICE</h5>
                    </div>
                    <div class="price">
                        <h5 style="font-weight: var(--font-weight-bold);">₱{{ number_format($requestedDocumentDetails->total_fee, 2) }}</h5>
                    </div>
                </div>
            </section>
        </div>

        <div class="form-button-container flex-container view-buttons">
            @if ($requestInfo->status == 'IN PROGRESS' && Auth::user()->account_role == 'cic')
                <button class="btn btn-success btn-sm " data-bs-toggle="modal"
                    data-bs-target="#accept-request-modal">ACCEPT
                    REQUEST</button>
                <button class="btn btn-danger btn-sm " data-bs-toggle="modal"
                    data-bs-target="#delete-request-modal">REJECT
                    REQUEST</button>
            @endif

            @if ($requestInfo->status == 'SET FOR RELEASE' && Auth::user()->account_role == 'cic')
                <button class="btn btn-success btn-sm " data-bs-toggle="modal"
                    data-bs-target="#accept-request-modal">COMPLETE
                    REQUEST</button>
            @endif

            @if ($requestInfo->status == 'IN PROGRESS' && Auth::user()->account_role == 'student')
                <button class="cancel" data-bs-toggle="modal" data-bs-target="#delete-request-modal">CANCEL
                    REQUEST</button>
            @endif

            @if (Auth::user()->account_role == 'student')
                <a class=" print" href="{{ route('stud.pdfRequest', ['requestID' => $requestInfo->request_id]) }}">PRINT
                    REQUEST</a>
            @endif
        </div>

    </section>

    <script src="{{ asset('js/main.js') }}"></script>
    <!--Modal for Rejecting Request-->
    @extends('layouts.modals.delete_student_request', ['routeName' => 'cic.rejectRequest', 'request_id' => $requestedDocumentDetails, 'request_status' => $requestInfo])
    <!--Modal for Accepting Request-->
    @extends('layouts.modals.accept_student_request', ['routeName' => 'cic.acceptRequest', 'request_id' => $requestedDocumentDetails, 'request_status' => $requestInfo])
@endsection
