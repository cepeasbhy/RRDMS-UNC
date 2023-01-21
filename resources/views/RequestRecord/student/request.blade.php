@extends('layouts.app')
@extends('layouts.header')

@section('request-content')
    <div class="container mb-3">
        <div class="row mb-3">
            <div class="border-start border-danger border-4 mb-2">
                <h4 class="ms-1 my-auto">STUDENT INFORMATION</h4>
            </div>
            <div class="row align-items-center mb-3 w-50 ms-2">
                <img class="col-3 img-fluid rounded-circle student-pic"
                    src="{{ asset('storage/' . $picturePath->document_loc) }}">
                <div class="col-9">
                    <span class="h4 fw-bold">{{ $student->last_name }}, {{ $student->first_name }}
                        {{ mb_substr($student->middle_name, 0, 1) . '.' }}</span>
                    <br>
                    <span>{{ $student->student_id }}</span>
                    <br>
                    <span>{{ $student->course_name }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="border-start border-danger border-4 mb-3">
                <h4 class="ms-1 my-auto">REQUEST RECORDS</h4>
            </div>
            <form action="{{ route('stud.submitRequest') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="border-start border-danger border-4">
                            <h4 class="ms-2">Diploma</h4>
                        </div>
                        <div class="row">
                            <div class="col-8 ms-3">
                                <span>Type of Diploma</span>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]"
                                        value="Bachelor/Law Degree" onchange="enableButton()">
                                    <label>Bachelor/Law Degree</label>
                                </div>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]"
                                        value="Masteral Degree" onchange="enableButton()">
                                    <label>Masteral Degree</label>
                                </div>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]"
                                        value="TESDA" onchange="enableButton()">
                                    <label>TESDA</label>
                                </div>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]"
                                        value="Caregiving" onchange="enableButton()">
                                    <label>Caregiving</label>
                                </div>
                            </div>
                            <div class="col">
                                <span>Price</span>
                                <div class="price">
                                    <label>₱{{ number_format($recordPrices['bachelorLawDegreePrice'], 2, '.') }}</label>
                                </div>
                                <div class="price">
                                    <label>₱{{ number_format($recordPrices['masteralDegreePrice'], 2, '.') }}</label>
                                </div>
                                <div class="price">
                                    <label>₱{{ number_format($recordPrices['tesdaDegreePrice'], 2, '.') }}</label>
                                </div>
                                <div class="price">
                                    <label>₱{{ number_format($recordPrices['caregivingDegreePrice'], 2, '.') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border-start border-danger border-4 mb-2">
                            <h4 class="ms-2">Transcript of Record</h4>
                        </div>
                        <div class="alert alert-info p-1 mb-1">
                            <span style="font-size: 12px">Transcript of Record cost
                                ₱{{ number_format($recordPrices['torPrice'], 2, '.') }}</span>
                        </div>
                        <div class="col">
                            <div class="form-group mb-1">
                                <input class="form-check-input" type="checkbox" name="reqTOR" value="true"
                                    onchange="enableButton()">
                                <label>Request for Transcript of Record</label>
                            </div>
                            <div class="form-group mb-2">
                                <label>Number of Copies</label>
                                <input name="tor[copies]"class="form-control form-control-sm" type="number" min="1">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Purpose</label>
                                        <select class="form-select form-select-sm" name="tor[purpose]" id="">
                                            <option value="">Choose</option>
                                            <option value="Records and References">Records and References</option>
                                            <option value="Board Examination">Board Examination</option>
                                            <option value="BAR Examination">BAR Examination</option>
                                            <option value="Employment">Employment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Others, pls. specify</label>
                                        <input name="tor[other_purpose]" class="form-control form-control-sm"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border-start border-danger border-4 mb-2">
                            <h4 class="ms-2">Copy of Grades</h4>
                        </div>
                        <div class="alert alert-info p-1 mb-1">
                            <span style="font-size: 12px">Copy of Grades cost
                                ₱{{ number_format($recordPrices['copyGradePrice'], 2, '.') }}</span>
                        </div>
                        <div class="col">
                            <div class="form-group mb-1">
                                <input class="form-check-input" type="checkbox" name="reqCopyGrade" value="true"
                                    onchange="enableButton()">
                                <label>Request Copy of Grades</label>
                            </div>
                            <div class="form-group mb-2">
                                <label>Number of Copies</label>
                                <input name="copyGrades[copies]" class="form-control form-control-sm" type="number">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <select class="form-select form-select-sm" name="copyGrades[semester]"
                                            id="">
                                            <option value="">Choose</option>
                                            <option value="1">1st Semester</option>
                                            <option value="2">2nd Semester</option>
                                            <option value="3">Summer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>School Year</label>
                                        <input name="copyGrades[schoolYear]" class="form-control form-control-sm"
                                            type="text" placeholder="e.g. 2019-2020">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="border-start border-danger border-4 mb-3">
                        <h4 class="ms-2">Cetificates</h4>
                    </div>
                    <div class="alert alert-info p-1 mb-1 w-25">
                        <span class="label-sm">Certificate cost
                            ₱{{ number_format($recordPrices['certPrice'], 2, '.') }} each</span>
                    </div>
                    <div class="row ms-2">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label>Type of Certificate</label>
                                </div>
                                <div class="col text-end">
                                    <label>Number of Copies</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="bonafideStudent" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Bonafide Student">
                                    <label>Bonafide Student</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Bonafide Student]" class="form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()"
                                        value="CAR (Completed Academic Record)">
                                    <label>CAR</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[CAR (Completed Academic Record)]" class=" form-check-input"
                                        type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()"
                                        value="Completion Certificate in Caregiving">
                                    <label>Caregiving</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Completion Certificate in Caregiving]"
                                        class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Permit to Cross Enroll">
                                    <label>Permit to Cross Enroll</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Permit to Cross Enroll]" class=" form-check-input"
                                        type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="NSTP/CWTS Serial No.">
                                    <label style="font-size: 15px">NSTP/CWTS Serial No.</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[NSTP/CWTS Serial No.]" class=" form-check-input"
                                        type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Request for TOR">
                                    <label>Requesting for TOR</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Request for TOR]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Special Order">
                                    <label>Special Order</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Special Order]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label>Type of Certificate</label>
                                </div>
                                <div class="col text-end">
                                    <label>Number of Copies</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()"
                                        value="English as Medium of Instruction">
                                    <label>EMI</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[English as Medium of Instruction]" class=" form-check-input"
                                        type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Enrollment">
                                    <label>Enrollment</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Enrollment]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Good Moral Character">
                                    <label>Good Moral Character</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Good Moral Character]" class=" form-check-input"
                                        type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Grading System">
                                    <label>Grading System</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Grading System]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Graduation">
                                    <label>Graduation</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Graduation]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Request for Form 137">
                                    <label>Requesting Form 137</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Request for Form 137]" class=" form-check-input"
                                        type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Underprocess">
                                    <label>Underprocess</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Underprocess]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label>Type of Certificate</label>
                                </div>
                                <div class="col text-end">
                                    <label>Number of Copies</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="General Weighted Average">
                                    <label>GWA</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[General Weighted Average]" class=" form-check-input"
                                        type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="LEBC">
                                    <label>LEBC (for LAW)</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[LEBC]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Name Discrepancy">
                                    <label>Name Discrepancy</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Name Discrepancy]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="No Objection">
                                    <label>No Objection</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[No Objection]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="PACUCOA">
                                    <label>PACUCOA</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[PACUCOA]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="QATAR">
                                    <label>QATAR</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[QATAR]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Units Earned">
                                    <label>Units Earned</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Units Earned]" class=" form-check-input" type="number"
                                        style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox"
                                        name="certificate[]" onchange="enableButton()" value="Foreign Certification">
                                    <label>Foreign Certification</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Foreign Certification]" class=" form-check-input"
                                        type="number" style="width:60%" min="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <div class="border-start border-danger border-4 mb-2">
                            <h4 class="ms-2">Authentication</h4>
                        </div>
                        <div class="alert alert-info p-1 mb-1">
                            <span class="label-sm">Authentication cost
                                ₱{{ number_format($recordPrices['authPrice'], 2, '.') }} each</span>
                        </div>
                        <div class="row ms-2">
                            <div class="form-group">
                                <input id="authentication" class="form-check-input" type="checkbox"
                                    name="authentication[]" value="Transcript of Record" onchange="enableButton()">
                                <label>Transcript of Record</label>
                            </div>
                            <div class="form-group">
                                <input id="authentication" class="form-check-input" type="checkbox"
                                    name="authentication[]" value="Diploma" onchange="enableButton()">
                                <label>Diploma</label>
                            </div>
                            <div class="form-group">
                                <input id="authentication" class="form-check-input" type="checkbox"
                                    name="authentication[]" value="Certificate" onchange="enableButton()">
                                <label>Certificate</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border-start border-danger border-4 mb-2">
                            <h4 class="ms-2">Photocopy</h4>
                        </div>
                        <div class="row ms-2">
                            <div class="form-group">
                                <input id="photocopy" class="form-check-input" type="checkbox" name="photocopy[]"
                                    value="Transcript of Record" onchange="enableButton()">
                                <label>Transcript of Record</label>
                            </div>
                            <div class="form-group">
                                <input id="photocopy" class="form-check-input" type="checkbox" name="photocopy[]"
                                    value="Diploma" onchange="enableButton()">
                                <label>Diploma</label>
                            </div>
                            <div class="form-group">
                                <input id="photocopy" class="form-check-input" type="checkbox" name="photocopy[]"
                                    value="Certificate" onchange="enableButton()">
                                <label>Certificate</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span>Type</span>
                                    <div class="form-group">
                                        <input class="form-radio-input" type="radio" name="photocopy[photocopyType]"
                                            value="ordinary">
                                        <label>Ordinary</label>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-radio-input" type="radio" name="photocopy[photocopyType]"
                                            value="colored">
                                        <label>Colored</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <span>Price</span>
                                    <div class="price">
                                        <label>₱{{ number_format($recordPrices['photoOrdinaryPrice'], 2, '.') }}</label>
                                    </div>
                                    <div class="price">
                                        <label>₱{{ number_format($recordPrices['photoColoredPrice'], 2, '.') }}</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h6 class="fw-bold">NON-DISCLOSURE/CONFIDENTIALITY AGREEMENTS</h6>
                    <p style="font-size: 12px">
                        The parties agree to comply with, and have adequate measures in place to ensure that its directors, officers, employees, and Representatives comply at all times with: (a) the 
                        provisions and obligations contained in Republic Act No. 10173 or the “Data Privacy Act of the Philippines” and its implementing rules and regulations, and (b) other
                        applicable data privacy laws and regulations, as may be promulgated and/or amended from time to time. By agreeing to execute and enter into this Agreement, the parties
                        agree that any information exchanged between them may be collected, processed, shared and used but only for purposes relevant to the Transaction. Each of the parties
                        agrees to hold the other free and harmless from any costs or liability arising from its failure to comply with the requirements of the Data Privacy Act of the Philippines.
                    </p>
                </div>
                <div class="form-group text-center">
                    <button id="submitSelected"class="btn btn-success" disabled>SUBMIT REQUEST</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
