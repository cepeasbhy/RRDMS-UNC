@extends('layouts.app')
@extends('layouts.header')

@section('request-content')
    <div class="container mb-2">
        <div class="row mb-3">
            @if (Auth::user()->account_role == 'cic')
                <form class="mb-3" action="{{ route('cic.request') }}" method="get">
                    <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> BACK</button>
                </form>
            @elseif (Auth::user()->account_role == 'student')
                <form class="mb-3" action="{{ route('stud.request') }}" method="get">
                    <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> BACK</button>
                </form>
            @endif
            <div class="border-start border-danger border-4 mb-2">
                <h4 class="ms-1 my-auto">REQUESTER INFORMATION</h4>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="row align-items-center mb-3 ms-2">
                        <img class="col-3 img-fluid rounded-circle student-pic"
                            src="{{ asset('storage/' . $picturePath->document_loc) }}">
                        <div class="col-9">
                            <span class="h4 fw-bold">{{ $student->last_name }}, {{ $student->first_name }}
                                {{ mb_substr($student->middle_name, 0, 1) . '.' }}</span>
                            <br>
                            <span>{{ $student->student_id }}</span>
                            <br>
                            <span>{{ $student->course_name }}</span>
                            <br>
                            <span>{{ $student->dept_name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="form-group mb-1">
                            <label>Request ID</label>
                            <input class="form-control form-control-sm" type="text" value="{{$requestInfo->request_id}}" readonly>
                        </div>
                        <div class="form-group mb-1">
                            <label>Release Date</label>
                            @if ($requestInfo->release_date != null)
                                <input class="form-control form-control-sm" type="text" value="{{$requestInfo->release_date}}" readonly>
                            @else
                                <input class="form-control form-control-sm" type="text" value="NOT FOR RELEASE" readonly>
                            @endif
                        </div>
                        @if ($requestInfo->reason_for_rejection != null)
                            <div class="form-group mb-1">
                                <label>Reason for Rejection</label>
                                <textarea class="form-control form-control-sm" style="resize: none" readonly
                                >{{trim($requestInfo->reason_for_rejection)}}</textarea>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group mb-1">
                       <label>Contact Number</label>
                       <input class="form-control form-control-sm" type="text" value="{{$student->phone_number}}" readonly>
                    </div>
                    <div class="form-group mb-1">
                        <label>Email</label>
                        <input class="form-control form-control-sm" type="text" value="{{$student->email}}" readonly>
                    </div>
                    <div class="form-group mb-1">
                        <label>Address</label>
                        <textarea class="form-control form-control-sm" style="resize: none" readonly
                        >{{trim($student->address)}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="border-start border-danger border-4 mb-3">
                <h4 class="my-auto">REQUESTED DOCUMENTS</h4>
           </div>
           <div class="row mb-0">
                @if ($requestedDocumentDetails->diploma != null)
                    <div class="col-4 mb-3">
                        <div class="row">
                            <h6 class="ms-1 fw-bold">DIPLOMA</h6>
                        </div>
                        <div class="row ms-2">
                            <div class="row">
                                <div class="col-7">
                                    <span class="fw-bold">DESCRIPTION</span>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">PRICE</span>
                                </div>
                            </div>
                            @foreach ($requestedDocumentDetails->diploma as $diploma)
                            <div class="row">
                                <div class="col-7">
                                    @if($diploma['description'] == "TOTAL PRICE")
                                        <span class="fw-bold" style="font-size: 13px">{{$diploma['description']}}</span>
                                    @else
                                        <span style="font-size: 13px">{{$diploma['description']}}</span>
                                    @endif
                                </div>
                                <div class="col">
                                    @if($diploma['description'] == "TOTAL PRICE")
                                        <span class="fw-bold" style="font-size: 13px">₱{{number_format($diploma['price'], 2)}}</span>
                                    @else
                                        <span style="font-size: 13px">₱{{number_format($diploma['price'], 2)}}</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($requestedDocumentDetails->transcript_of_record != null)
                    <div class="col-4 mb-3">
                        <div class="row">
                            <h6 class="ms-1 fw-bold">TRANSCRIPT OF RECORD</h6>
                        </div>
                        <div class="row ms-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col-5">
                                        <span style="font-size: 13px">No. of Copies:</span>
                                    </div>
                                    <div class="col">
                                        <span style="font-size: 13px">{{$requestedDocumentDetails->transcript_of_record['copies']}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <span style="font-size: 13px">Purpose:</span>
                                    </div>
                                    <div class="col">
                                        <span style="font-size: 13px">{{$requestedDocumentDetails->transcript_of_record['purpose']}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <span style="font-size: 13px">Other Purpose:</span>
                                    </div>
                                    <div class="col">
                                        @if ($requestedDocumentDetails->transcript_of_record['other_purpose'] == null)
                                            <span style="font-size: 13px">NOT STATED</span>
                                        @else
                                            <span style="font-size: 13px">{{$requestedDocumentDetails->transcript_of_record['other_purpose']}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <span class="fw-bold" style="font-size: 13px">TOTAL PRICE:</span>
                                    </div>
                                    <div class="col">
                                        <span class="fw-bold" style="font-size: 13px">₱{{number_format($requestedDocumentDetails->transcript_of_record[0]['price'], 2)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if ($requestedDocumentDetails->certificate != null)
                    <div class="col-4 mb-3">
                        <div class="row">
                            <h6 class="ms-1 fw-bold">CERTIFICATES</h6>
                        </div>
                        <div class="row ms-3">
                            <div class="row">
                                <div class="col-6">
                                    <span class="fw-bold">DESCRIPTION</span>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">COPIES</span>
                                </div>
                            </div>
                            @foreach ($requestedDocumentDetails->certificate as $certificate)
                                @foreach($certificate as $description => $value)
                                    <div class="row">
                                        <div class="col-7">
                                            @if ($description == "TOTAL PRICE")
                                                <span class="fw-bold" style="font-size: 13px">{{$description}}</span>
                                            @else
                                                <span style="font-size: 13px">{{$description}}</span>
                                            @endif
                                        </div>
                                        <div class="col">
                                            @if ($description == "TOTAL PRICE")
                                                <span class="fw-bold" style="font-size: 13px">₱{{number_format($value, 2)}}</span>
                                            @else
                                                <span style="font-size: 13px">{{$value}}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($requestedDocumentDetails->copy_of_grades != null)
                    <div class="col-4 mb-3">
                        <div class="row">
                            <h6 class="ms-1 fw-bold">COPY OF GRADES</h6>
                        </div>
                        <div class="row ms-3">
                            <div class="row">
                                <div class="col-5">
                                    <span style="font-size: 13px">No. of Copies:</span>
                                </div>
                                <div class="col">
                                    <span style="font-size: 13px">{{$requestedDocumentDetails->copy_of_grades['copies']}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <span style="font-size: 13px">School Year:</span>
                                </div>
                                <div class="col">
                                    <span style="font-size: 13px">{{$requestedDocumentDetails->copy_of_grades['schoolYear']}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <span style="font-size: 13px">Semester:</span>
                                </div>
                                <div class="col">
                                    @switch($requestedDocumentDetails->copy_of_grades['semester'])
                                        @case(1)
                                            <span style="font-size: 13px">1st Semester</span>
                                            @break
                                        @case(2)
                                            <span style="font-size: 13px">2nd Semester</span>
                                            @break
                                        @default
                                            <span style="font-size: 13px">Summer Semester</span>
                                    @endswitch
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <span class="fw-bold" style="font-size: 13px">TOTAL PRICE:</span>
                                </div>
                                <div class="col">
                                    <span class="fw-bold" style="font-size: 13px">₱{{number_format($requestedDocumentDetails->copy_of_grades[0]['price'],2)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if ($requestedDocumentDetails->authentication != null)
                    <div class="col-4 mb-3">
                        <div class="row">
                            <h6 class="ms-1 fw-bold">AUTHENTICATION</h6>
                        </div>
                        <div class="row ms-2">
                            <div class="row">
                                <div class="col-7">
                                    <span class="fw-bold">DESCRIPTION</span>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">PRICE</span>
                                </div>
                            </div>
                            @foreach ($requestedDocumentDetails->authentication as $auth)
                                <div class="row">
                                    <div class="col-7">
                                        @if($auth['description'] == "TOTAL PRICE")
                                            <span class="fw-bold" style="font-size: 13px">{{$auth['description']}}</span>
                                        @else
                                            <span style="font-size: 13px">{{$auth['description']}}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        @if($auth['description'] == "TOTAL PRICE")
                                            <span class="fw-bold" style="font-size: 13px">₱{{number_format($auth['price'], 2)}}</span>
                                        @else
                                            <span style="font-size: 13px">₱{{number_format($auth['price'], 2)}}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @if ($requestedDocumentDetails->photocopy != null)
                    <div class="col-4 mb-3">
                        <div class="row">
                            <h6 class="ms-1 fw-bold">PHOTOCOPY</h6>
                        </div>
                        <div class="row ms-2">
                            <div class="row">
                                <div class="col-7">
                                    <span class="fw-bold">DESCRIPTION</span>
                                </div>
                                <div class="col">
                                    <span class="fw-bold">PRICE</span>
                                </div>
                            </div>
                            @foreach ($requestedDocumentDetails->photocopy as $photoCopy)
                                <div class="row">
                                    <div class="col-7">
                                        @if($photoCopy['description'] == "TOTAL PRICE")
                                            <span class="fw-bold" style="font-size: 13px">{{$photoCopy['description']}}</span>
                                        @else
                                            <span style="font-size: 13px">{{$photoCopy['description']}}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        @if($photoCopy['description'] != 'Photocopy Type')
                                            @if($photoCopy['description'] == "TOTAL PRICE")
                                                <span class="fw-bold" style="font-size: 13px">₱{{number_format($photoCopy['value'],2)}}</span>
                                            @else
                                                <span style="font-size: 13px">₱{{number_format($photoCopy['value'],2)}}</span>
                                            @endif
                                        @else
                                            <span style="font-size: 13px">{{strtoupper($photoCopy['value'])}}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                            </div>
                        </div>
                    </div>
                @endif 
           </div>
           <div class="ms-3">
                <span class="text-danger fw-bold" style="font-size: 20px">Total Fee: ₱{{ number_format($requestedDocumentDetails->total_fee, 2)}}</span>
           </div>
        </div>
    </div>

    <div class="col mt-5 text-center mb-3">

        @if ($requestInfo->status == 'IN PROGRESS' && Auth::user()->account_role == 'cic')
            <button class="btn btn-success btn-sm " data-bs-toggle="modal" data-bs-target="#accept-request-modal">ACCEPT
                REQUEST</button>
            <button class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#delete-request-modal">REJECT
                REQUEST</button>
        @endif

        @if ($requestInfo->status == 'SET FOR RELEASE' && Auth::user()->account_role == 'cic')
            <button class="btn btn-success btn-sm " data-bs-toggle="modal"
                data-bs-target="#accept-request-modal">COMPLETE
                REQUEST</button>
        @endif

        @if ($requestInfo->status == 'IN PROGRESS' && Auth::user()->account_role == 'student')
            <button class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#delete-request-modal">CANCEL
                REQUEST</button>
        @endif
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
    <!--Modal for Rejecting Request-->
    @extends('layouts.modals.delete_student_request', ['routeName' => 'cic.rejectRequest', 'request_id' => $requestedDocumentDetails, 'request_status' => $requestInfo])
    <!--Modal for Accepting Request-->
    @extends('layouts.modals.accept_student_request', ['routeName' => 'cic.acceptRequest', 'request_id' => $requestedDocumentDetails, 'request_status' => $requestInfo])
@endsection
