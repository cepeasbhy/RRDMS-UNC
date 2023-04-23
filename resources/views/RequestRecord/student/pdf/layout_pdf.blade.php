<style>
    *{
        padding: 0;
        margin: 0;
    }

    .container{
        width: 90%;
        margin: auto;
    }

    .header{
        font-size: 20px;
        text-align: center;
        margin-top: 100px;
        margin-bottom: 20px;
    }

    .student-info{
        width: 80%;
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
        <h5>UNIVERSITY OF NUEVA CACERES</h5>
        <h5>OFFICE OF THE REGISTRAR</h5>
        <h5>CITY OF NAGA</h5>
        <h5>Tel. Nos. (054) 473-78-44 / 472-61-00 local 168</h5>
        <h5>registrar@unc.edu.ph</h5>
        <h5>REQUEST FOR SCHOOL RECORDS</h5>
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
                @yield('diploma')
            @else
                @if ($requestedDocumentDetails->transcript_of_record != null)
                    @yield('tor')
                @else
                    @if ($requestedDocumentDetails->photocopy != null && $requestedDocumentDetails->certificate == null)
                        @yield('photocopy')
                    @endif
                @endif
            @endif
            
            @if ($requestedDocumentDetails->certificate != null)
                @yield('certificate')
            @else
                @if ($requestedDocumentDetails->copy_of_grades != null)
                    @yield('copy-grades')
                @else
                    @if ($requestedDocumentDetails->photocopy != null)
                        @yield('photocopy')
                    @endif
                @endif
            @endif
            
            @if ($requestedDocumentDetails->authentication != null)
               @yield('authentication')
            @endif

            @if (
                $requestedDocumentDetails->photocopy != null &&
                $requestedDocumentDetails->certificate != null &&
                $requestedDocumentDetails->diploma == null
            )
                @yield('photocopy')
            @endif
        </div>

        <div class="floatbox">
            @if (
                $requestedDocumentDetails->photocopy != null &&
                $requestedDocumentDetails->certificate != null &&
                $requestedDocumentDetails->diploma != null &&
                $requestedDocumentDetails->copy_of_grades == null &&
                $requestedDocumentDetails->transcript_of_record == null
            )
                @yield('photocopy')
            @endif
            
            @if (   $requestedDocumentDetails->photocopy != null &&
                    $requestedDocumentDetails->authentication != null &&
                    $requestedDocumentDetails->copy_of_grades != null &&
                    $requestedDocumentDetails->transcript_of_record != null
                )
                    @yield('photocopy')
            @endif

            @if ($requestedDocumentDetails->transcript_of_record != null && $requestedDocumentDetails->diploma != null)
                @yield('tor')
            @endif

            @if ($requestedDocumentDetails->copy_of_grades != null && $requestedDocumentDetails->certificate != null)
                @yield('copy-grades')
            @endif
        </div>
        <div class="ms-3">
            <span style="font-size: 30px; font-weight:bold">Total Fee: P{{ number_format($requestedDocumentDetails->total_fee, 2)}}</span>
        </div>

        <div style="margin-top: 20px">
            <h6 style="font-weight: bold">NON-DISCLOSURE/CONFIDENTIALITY AGREEMENTS</h6>
            <p style="font-size: 12px; text-align:justify">
                The parties agree to comply with, and have adequate measures in place to ensure that its directors, officers, employees, and Representatives comply at all times with: (a) the 
                provisions and obligations contained in Republic Act No. 10173 or the “Data Privacy Act of the Philippines” and its implementing rules and regulations, and (b) other
                applicable data privacy laws and regulations, as may be promulgated and/or amended from time to time. By agreeing to execute and enter into this Agreement, the parties
                agree that any information exchanged between them may be collected, processed, shared and used but only for purposes relevant to the Transaction. Each of the parties
                agrees to hold the other free and harmless from any costs or liability arising from its failure to comply with the requirements of the Data Privacy Act of the Philippines.
            </p>
        </div>
    </div>
</div>
    