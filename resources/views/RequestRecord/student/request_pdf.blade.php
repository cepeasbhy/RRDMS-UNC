<style>
    *{
        padding: 0;
        margin: 0;
    }

    .container{
        width: 60%;
        margin: auto;
    }

    .header{
        font-size: 20px;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .student-info{
        display: flex;
        justify-content: center;
    }

    .data-value{
        font-weight: bold;
    }

    table{
        font-size: 20px;
        width: 90%;
        margin-bottom: 20px;
    }

    .floatbox {
        display: block;
        box-sizing: border-box;
        margin: 0px -10px;
    }

    .floatbox::after {
        clear: both;
        content: '';
        display: block;
    }

    .float-item {
        float: left;
        box-sizing: border-box;
        width: 33%;
        margin-bottom: 20px;
        padding: 0px 10px;
    }

    .float-item:nth-child(2n + 1) {
        clear: both;
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
    <div class="student-info">
        <table>
            <tr>
                <td>Name: <span class="data-value">{{strtoupper($student->last_name)}},  {{strtoupper($student->first_name)}} {{strtoupper($student->middle_name)}}</span></td>
                <td>Mobile Number: <span class="data-value">{{$student->phone_number}}</span></td>
            </tr>
            <tr>
                <td>Stduent ID: <span class="data-value">{{$student->student_id}}</span></td>
                <td>Email: <span class="data-value">{{$student->email}}</span></td>
            </tr>
            <tr>
                <td>Department: <span class="data-value">{{$student->dept_name}}</td>
                <td>Address: <span class="data-value">{{$student->address}}</span></td>
            </tr>
            <tr>
                <td>Course: <span class="data-value">{{$student->course_name}}</span></td>
            </tr>
        </table>
    </div>
    <div class="row">
        <div style="margin-bottom: 20px">
             <h5 class="my-auto">REQUESTED DOCUMENTS</h5>
        </div>
        <div class="floatbox">
            @if ($requestedDocumentDetails->diploma != null)
                <div class="float-item">
                    <span style="font-size: 15px; font-weight:bold">DIPLOMA</span>
                    <table>
                        <thead>
                            <tr>
                                <td>Description</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($requestedDocumentDetails->diploma != null)
                                @foreach ($requestedDocumentDetails->diploma as $diploma)
                                    <tr>
                                        @if($diploma['description'] != "TOTAL PRICE")
                                            <td>
                                                <span style="font-size: 13px; font-weight:bold">{{$diploma['description']}}</span>
                                            </td>
                                        @else
                                            <td>
                                                <span style="font-size: 13px; font-weight:bold">{{$diploma['description']}}</span>
                                            </td>
                                        @endif
            
                                        @if($diploma['description'] != "TOTAL PRICE")
                                            <td>
                                                <span style="font-size: 13px">P{{number_format($diploma['price'], 2)}}</span>
                                            </td>
                                        @else
                                            <td>
                                                <span style="font-size: 13px; font-weight:bold">P{{number_format($diploma['price'], 2)}}</span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif     
                        </tbody>
                    </table>
                </div>
            @else
                @if ($requestedDocumentDetails->transcript_of_record != null)
                    <div class="float-item">
                        <span style="font-size: 15px; font-weight:bold">TRANSCRIPT OF RECORD</span>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <span style="font-size: 13px">No. of Copies:</span>
                                    </td>
                                    <td>
                                        <span style="font-size: 13px">{{$requestedDocumentDetails->transcript_of_record['copies']}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="font-size: 13px">Purpose:</span>
                                    </td>
                                    <td>
                                        <span style="font-size: 13px">{{$requestedDocumentDetails->transcript_of_record['purpose']}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="font-size: 13px">Other Purpose:</span>
                                    </td>
                                    <td>
                                        @if ($requestedDocumentDetails->transcript_of_record['other_purpose'] == null)
                                            <span style="font-size: 13px">NOT STATED</span>
                                        @else
                                            <span style="font-size: 13px">{{$requestedDocumentDetails->transcript_of_record['other_purpose']}}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="font-size: 13px; font-weight:bold">TOTAL PRICE:</span>
                                    </td>
                                    <td>
                                        <span style="font-size: 13px; font-weight:bold">P{{number_format($requestedDocumentDetails->transcript_of_record[0]['price'], 2)}}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif
            
            @if ($requestedDocumentDetails->certificate != null)
                <div class="float-item">
                    <span style="font-size: 15px; font-weight:bold">CERTIFICATES</span>
                    <table>
                        <thead>
                            <tr>
                                <td>Description</td>
                                <td>Copies</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requestedDocumentDetails->certificate as $certificate)
                                @foreach($certificate as $description => $value)
                                    <tr>
                                        @if ($description == "TOTAL PRICE")
                                            <td>
                                                <span style="font-size: 13px; font-weight:bold">{{$description}}</span>
                                            </td>
                                        @else
                                            <td>
                                                <span style="font-size: 13px">{{$description}}</span>
                                            </td>
                                        @endif
                                        
                                        @if ($description == "TOTAL PRICE")
                                            <td>    
                                                <span style="font-size: 13px; font-weight:bold">P{{number_format($value, 2)}}</span>
                                            </td>
                                        @else
                                            <td>
                                                <span style="font-size: 13px">{{$value}}</span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            @else
                @if ($requestedDocumentDetails->copy_of_grades != null)
                    <div class="float-item">
                        <span style="font-size: 15px; font-weight:bold">COPY OF GRADES</span>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <span style="font-size: 13px">No. of Copies:</span>
                                    </td>
                                    <td>
                                        <span style="font-size: 13px">{{$requestedDocumentDetails->copy_of_grades['copies']}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="font-size: 13px">School Year:</span>
                                    </td>
                                    <td>
                                        <span style="font-size: 13px">{{$requestedDocumentDetails->copy_of_grades['schoolYear']}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="font-size: 13px">Semester:</span>
                                    </td>
                                    <td>
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
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="font-size: 13px; font-weight:bold">TOTAL PRICE:</span>
                                    </td>
                                    <td>
                                        <span style="font-size: 13px; font-weight:bold">P{{number_format($requestedDocumentDetails->copy_of_grades[0]['price'],2)}}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif
            
            @if ($requestedDocumentDetails->authentication != null)
                <div class="float-item">
                    <span style="font-size: 15px; font-weight:bold">AUTHENTICATION</span>
                    <table>
                        <thead>
                            <tr>
                                <td>Description</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requestedDocumentDetails->authentication as $auth)
                                <tr>
                                    @if($auth['description'] == "TOTAL PRICE")
                                        <td>
                                            <span style="font-size: 13px; font-weight:bold">{{$auth['description']}}</span>
                                        </td>
                                    @else
                                        <td>
                                            <span style="font-size: 13px">{{$auth['description']}}</span>
                                        </td>   
                                    @endif

                                    @if($auth['description'] == "TOTAL PRICE")
                                        <td>
                                            <span style="font-size: 13px; font-weight:bold">P{{number_format($auth['price'], 2)}}</span>
                                        </td>
                                    @else
                                        <td>
                                            <span style="font-size: 13px">P{{number_format($auth['price'], 2)}}</span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach  
                        </tbody>
                    </table>
                </div>
            @else
                @if ($requestedDocumentDetails->photocopy != null)
                    <div class="float-item">
                        <span style="font-size: 15px; font-weight:bold">PHOTOCOPY</span>
                        <table>
                            <thead>
                                <tr>
                                    <td>Description</td>
                                    <td>Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestedDocumentDetails->photocopy as $photoCopy)
                                    <tr>
                                        @if($photoCopy['description'] == "TOTAL PRICE")
                                            <td>
                                                <span style="font-size: 13px; font-weight:bold">{{$photoCopy['description']}}</span>
                                            </td>
                                        @else
                                            <td>
                                                <span style="font-size: 13px">{{$photoCopy['description']}}</span>
                                            </td>
                                        @endif

                                        @if($photoCopy['description'] != 'Photocopy Type')
                                            @if($photoCopy['description'] == "TOTAL PRICE")
                                                <td>
                                                    <span style="font-size: 13px; font-weight:bold">P{{number_format($photoCopy['value'],2)}}</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span style="font-size: 13px">P{{number_format($photoCopy['value'],2)}}</span>
                                                </td>
                                            @endif
                                        @else
                                            <td>
                                                <span style="font-size: 13px">{{strtoupper($photoCopy['value'])}}</span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif
        </div>

        <div class="floatbox">
            @if ($requestedDocumentDetails->photocopy != null && $requestedDocumentDetails->authentication != null)
                <div class="float-item">
                    <span style="font-size: 15px; font-weight:bold">PHOTOCOPY</span>
                    <table>
                        <thead>
                            <tr>
                                <td>Description</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requestedDocumentDetails->photocopy as $photoCopy)
                                <tr>
                                    @if($photoCopy['description'] == "TOTAL PRICE")
                                        <td>
                                            <span style="font-size: 13px; font-weight:bold">{{$photoCopy['description']}}</span>
                                        </td>
                                    @else
                                        <td>
                                            <span style="font-size: 13px">{{$photoCopy['description']}}</span>
                                        </td>
                                    @endif

                                    @if($photoCopy['description'] != 'Photocopy Type')
                                        @if($photoCopy['description'] == "TOTAL PRICE")
                                            <td>
                                                <span style="font-size: 13px; font-weight:bold">P{{number_format($photoCopy['value'],2)}}</span>
                                            </td>
                                        @else
                                            <td>
                                                <span style="font-size: 13px">P{{number_format($photoCopy['value'],2)}}</span>
                                            </td>
                                        @endif
                                    @else
                                        <td>
                                            <span style="font-size: 13px">{{strtoupper($photoCopy['value'])}}</span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            @endif

            @if ($requestedDocumentDetails->transcript_of_record != null && $requestedDocumentDetails->diploma != null)
                <div class="float-item">
                    <span style="font-size: 15px; font-weight:bold">TRANSCRIPT OF RECORD</span>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <span style="font-size: 13px">No. of Copies:</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px">{{$requestedDocumentDetails->transcript_of_record['copies']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 13px">Purpose:</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px">{{$requestedDocumentDetails->transcript_of_record['purpose']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 13px">Other Purpose:</span>
                                </td>
                                <td>
                                    @if ($requestedDocumentDetails->transcript_of_record['other_purpose'] == null)
                                        <span style="font-size: 13px">NOT STATED</span>
                                    @else
                                        <span style="font-size: 13px">{{$requestedDocumentDetails->transcript_of_record['other_purpose']}}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 13px; font-weight:bold">TOTAL PRICE:</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px; font-weight:bold">P{{number_format($requestedDocumentDetails->transcript_of_record[0]['price'], 2)}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif

            @if ($requestedDocumentDetails->copy_of_grades != null && $requestedDocumentDetails->certificate != null)
                <div class="float-item">
                    <span style="font-size: 15px; font-weight:bold">COPY OF GRADES</span>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <span style="font-size: 13px">No. of Copies:</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px">{{$requestedDocumentDetails->copy_of_grades['copies']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 13px">School Year:</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px">{{$requestedDocumentDetails->copy_of_grades['schoolYear']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 13px">Semester:</span>
                                </td>
                                <td>
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
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="font-size: 13px; font-weight:bold">TOTAL PRICE:</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px; font-weight:bold">P{{number_format($requestedDocumentDetails->copy_of_grades[0]['price'],2)}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="ms-3">
            <span class="text-danger fw-bold" style="font-size: 20px">Total Fee: P{{ number_format($requestedDocumentDetails->total_fee, 2)}}</span>
        </div>
    </div>
</div>
    