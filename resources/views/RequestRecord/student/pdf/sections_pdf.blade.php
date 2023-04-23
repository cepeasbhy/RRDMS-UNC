@extends('RequestRecord.student.pdf.layout_pdf')

@section('diploma')
    <div class="float-item">
        <span style="font-size: 20px; font-weight:bold">DIPLOMA</span>
        <table>
            <thead>
                <tr>
                    <td style="font-size: 17px; font-weight:bold">Description</td>
                    <td style="font-size: 17px; font-weight:bold">Price</td>
                </tr>
            </thead>
            <tbody>
                @if ($requestedDocumentDetails->diploma != null)
                    @foreach ($requestedDocumentDetails->diploma as $diploma)
                        <tr>
                            @if($diploma['description'] != "TOTAL PRICE")
                                <td>
                                    <span style="font-size: 17px;">{{$diploma['description']}}</span>
                                </td>
                            @else
                                <td>
                                    <span style="font-size: 17px; font-weight:bold">{{$diploma['description']}}</span>
                                </td>
                            @endif

                            @if($diploma['description'] != "TOTAL PRICE")
                                <td>
                                    <span style="font-size: 17px">P{{number_format($diploma['price'], 2)}}</span>
                                </td>
                            @else
                                <td>
                                    <span style="font-size: 17px; font-weight:bold">P{{number_format($diploma['price'], 2)}}</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif     
            </tbody>
        </table>
    </div>
@endsection


@section('certificate')
    <div class="float-item">
        <span style="font-size: 20px; font-weight:bold">CERTIFICATES</span>
        <table>
            <thead>
                <tr>
                    <td style="font-size: 17px; font-weight:bold">Description</td>
                    <td style="font-size: 17px; font-weight:bold">Copies</td>
                </tr>
            </thead>
            <tbody>
                @if($requestedDocumentDetails->certificate !=null)
                    @foreach ($requestedDocumentDetails->certificate as $certificate)
                        @foreach($certificate as $description => $value)
                            <tr>
                                @if ($description == "TOTAL PRICE")
                                    <td>
                                        <span style="font-size: 17px; font-weight:bold">{{$description}}</span>
                                    </td>
                                @else
                                    <td>
                                        <span style="font-size: 17px">{{$description}}</span>
                                    </td>
                                @endif
                                
                                @if ($description == "TOTAL PRICE")
                                    <td>    
                                        <span style="font-size: 17px; font-weight:bold">P{{number_format($value, 2)}}</span>
                                    </td>
                                @else
                                    <td>
                                        <span style="font-size: 17px">{{$value}}</span>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach 
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('authentication')
    <div class="float-item">
        <span style="font-size: 20px; font-weight:bold">AUTHENTICATION</span>
        <table>
            <thead>
                <tr>
                    <td style="font-size: 17px; font-weight:bold">Description</td>
                    <td style="font-size: 17px; font-weight:bold">Price</td>
                </tr>
            </thead>
            <tbody>
                @if($requestedDocumentDetails->authentication != null)
                    @foreach ($requestedDocumentDetails->authentication as $auth)
                        <tr>
                            @if($auth['description'] == "TOTAL PRICE")
                                <td>
                                    <span style="font-size: 17px; font-weight:bold">{{$auth['description']}}</span>
                                </td>
                            @else
                                <td>
                                    <span style="font-size: 17px">{{$auth['description']}}</span>
                                </td>   
                            @endif

                            @if($auth['description'] == "TOTAL PRICE")
                                <td>
                                    <span style="font-size: 17px; font-weight:bold">P{{number_format($auth['price'], 2)}}</span>
                                </td>
                            @else
                                <td>
                                    <span style="font-size: 17px">P{{number_format($auth['price'], 2)}}</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach  
                @endif
            </tbody>
        </table>
    </div>
@endsection


@section('photocopy')
    <div class="float-item">
        <span style="font-size: 20px; font-weight:bold">PHOTOCOPY</span>
        <table>
            <thead>
                <tr>
                    <td style="font-size: 17px; font-weight:bold">Description</td>
                    <td style="font-size: 17px; font-weight:bold">Price</td>
                </tr>
            </thead>
            <tbody>
                @if($requestedDocumentDetails->photocopy != null)
                    @foreach ($requestedDocumentDetails->photocopy as $photoCopy)
                        <tr>
                            @if($photoCopy['description'] == "TOTAL PRICE")
                                <td>
                                    <span style="font-size: 17px; font-weight:bold">{{$photoCopy['description']}}</span>
                                </td>
                            @else
                                <td>
                                    <span style="font-size: 17px">{{$photoCopy['description']}}</span>
                                </td>
                            @endif

                            @if($photoCopy['description'] != 'Photocopy Type')
                                @if($photoCopy['description'] == "TOTAL PRICE")
                                    <td>
                                        <span style="font-size: 17px; font-weight:bold">P{{number_format($photoCopy['value'],2)}}</span>
                                    </td>
                                @else
                                    <td>
                                        <span style="font-size: 17px">P{{number_format($photoCopy['value'],2)}}</span>
                                    </td>
                                @endif
                            @else
                                <td>
                                    <span style="font-size: 17px">{{strtoupper($photoCopy['value'])}}</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach 
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('tor')
    <div class="float-item">
        <span style="font-size: 20px; font-weight:bold">TRANSCRIPT OF RECORD</span>
        <table>
            <tbody>
                @if($requestedDocumentDetails->transcript_of_record != null)
                    <tr>
                        <td>
                            <span style="font-size: 17px">No. of Copies:</span>
                        </td>
                        <td>
                            <span style="font-size: 17px">{{$requestedDocumentDetails->transcript_of_record['copies']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span style="font-size: 17px">Purpose:</span>
                        </td>
                        <td>
                            <span style="font-size: 17px">{{$requestedDocumentDetails->transcript_of_record['purpose']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span style="font-size: 17px">Other Purpose:</span>
                        </td>
                        <td>
                            @if ($requestedDocumentDetails->transcript_of_record['other_purpose'] == null)
                                <span style="font-size: 17px">NOT STATED</span>
                            @else
                                <span style="font-size: 17px">{{$requestedDocumentDetails->transcript_of_record['other_purpose']}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span style="font-size: 17px; font-weight:bold">TOTAL PRICE:</span>
                        </td>
                        <td>
                            <span style="font-size: 17px; font-weight:bold">P{{number_format($requestedDocumentDetails->transcript_of_record[0]['price'], 2)}}</span>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('copy-grades')
    <div class="float-item">
        <span style="font-size: 20px; font-weight:bold">COPY OF GRADES</span>
        <table>
            <tbody>
                @if($requestedDocumentDetails->copy_of_grades != null)
                    <tr>
                        <td>
                            <span style="font-size: 17px">No. of Copies:</span>
                        </td>
                        <td>
                            <span style="font-size: 17px">{{$requestedDocumentDetails->copy_of_grades['copies']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span style="font-size: 17px">School Year:</span>
                        </td>
                        <td>
                            <span style="font-size: 17px">{{$requestedDocumentDetails->copy_of_grades['schoolYear']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span style="font-size: 17px">Semester:</span>
                        </td>
                        <td>
                            @switch($requestedDocumentDetails->copy_of_grades['semester'])
                                @case(1)
                                    <span style="font-size: 17px">1st Semester</span>
                                    @break
                                @case(2)
                                    <span style="font-size: 17px">2nd Semester</span>
                                    @break
                                @default
                                    <span style="font-size: 17px">Summer Semester</span>
                            @endswitch
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span style="font-size: 17px; font-weight:bold">TOTAL PRICE:</span>
                        </td>
                        <td>
                            <span style="font-size: 17px; font-weight:bold">P{{number_format($requestedDocumentDetails->copy_of_grades[0]['price'],2)}}</span>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection