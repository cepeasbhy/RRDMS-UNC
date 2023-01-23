<style>
    *{
        padding: 0;
        margin: 0;
    }

    .container{
        width: 60%;
    }

    .header{
        font-size: 13px;
        text-align: center;
    }
</style>

<div class="container">
    <div class="header">
        <h6>UNIVERSITY OF NUEVA CACERES</h6>
        <h6>OFFICE OF THE REGISTRAR</h6>
        <h6>CITY OF NAGA</h6>
        <h6>Tel. Nos. (054) 473-78-44 / 472-61-00 local 168</h6>
        <h6>registrar@unc.edu.ph</h6>
        <h6>REQUEST FOR SCHOOL RECORDS</h6>
    </div>
    <div class="student-info row justify-content-center mb-3">
        <div class="col">
            <div class="info-group d-flex">
                <label class="me-2">Name: </label>
                <label class="fw-bold">{{strtoupper($student->last_name)}},  {{strtoupper($student->first_name)}} {{strtoupper($student->middle_name)}}</label>
            </div>
            <div class="info-group d-flex">
                <label class="me-2">Student ID: </label>
                <label class="fw-bold">{{$student->student_id}}</label>
            </div>
            <div class="info-group d-flex">
                <label class="me-2">Department: </label>
                <label class="fw-bold">{{$student->dept_name}}</label>
            </div>
            <div class="info-group d-flex">
                <label class="me-2">Course: </label>
                <label class="fw-bold">{{$student->course_name}}</label>
            </div>
        </div>
        <div class="col">
            <div class="info-group d-flex">
                <label class="me-2">Mobile Number: </label>
                <label class="fw-bold">{{$student->phone_number}}</label>
            </div>
            <div class="info-group d-flex">
                <label class="me-2">Email Address: </label>
                <label class="fw-bold">{{$student->email}}</label>
            </div>
            <div class="info-group d-flex">
                <label class="me-2">Current Address: </label>
                <label class="fw-bold">{{$student->address}}</label>
            </div>
        </div>
    </div>

    <div class="row">
        <h6>REQUESTED DOCUMENTS</h6>

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

            <div class="ms-3">
                <span class="text-danger fw-bold" style="font-size: 20px">Total Fee: ₱{{ number_format($requestedDocumentDetails->total_fee, 2)}}</span>
           </div>
       </div>
    </div>
</div>
    