@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <div class="row mb-3">
            <div class="border-start border-danger border-4">
                <h4 class="ms-2">STUDENT INFORMATION</h4>
            </div>
            <div class="row align-items-center mb-3 w-50 ms-2">
                <img class="col-3 img-fluid rounded-circle student-pic" src="{{asset('storage/'.$picturePath->document_loc)}}">
                <div class="col-9">
                    <span class="h4 fw-bold">{{$student->last_name}}, {{$student->first_name}} {{mb_substr($student->middle_name, 0, 1).'.'}}</span>
                    <br>
                    <span>{{$student->student_id}}</span>
                    <br>
                    <span>{{$student->course_name}}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="border-start border-danger border-4 mb-3">
                <h4 class="ms-2">REQUEST RECORDS</h4>
            </div>
            <form action="{{route('submitRequest')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="border-start border-danger border-4">
                            <h4 class="ms-2">Diploma</h4>
                        </div>
                        <div class="row">
                            <div class="col ms-3">
                                <span class="label-sm">Type of Diploma</span>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]" value="Bachelor/Law Degree" onchange="enableButton()">
                                    <label class="label-sm">Bachelor/Law Degree</label>
                                </div>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]" value="Masteral Degree" onchange="enableButton()">
                                    <label class="label-sm">Masteral Degree</label>
                                </div>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]" value="TESDA" onchange="enableButton()">
                                    <label class="label-sm">TESDA</label>
                                </div>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]" value="Caregiving" onchange="enableButton()">
                                    <label class="label-sm">Caregiving</label>
                                </div>
                            </div>
                            <div class="col">
                                <span class="label-sm">Price</span>
                                <div class="price">
                                    <label class="label-sm">₱516.00</label>
                                </div>
                                <div class="price">
                                    <label class="label-sm">₱729.00</label>
                                </div>
                                <div class="price">
                                    <label class="label-sm">₱302.00</label>
                                </div>
                                <div class="price">
                                    <label class="label-sm">₱250.00</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border-start border-danger border-4 mb-2">
                            <h4 class="ms-2">Transcript of Record</h4>
                        </div>
                        <div class="alert alert-info p-1 mb-1">
                            <span style="font-size: 12px">Transcript of Record cost ₱110.00</span>
                        </div>
                        <div class="col">
                            <div class="form-group mb-1">
                                <input class="form-check-input" type="checkbox" name="reqTOR" value="true" onchange="enableButton()">
                                <label class="label-sm">Request for Transcript of Record</label>
                            </div>
                            <div class="form-group mb-2">
                                <label class="label-sm">Number of Copies</label>
                                <input name="tor[copies]"class="form-control form-control-sm" type="number" min="1">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="label-sm">Purpose</label>
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
                                        <label class="label-sm">Others, pls. specify</label>
                                        <input name="tor[other_purpose]" class="form-control form-control-sm" type="text">
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
                        <span style="font-size: 12px">Certificate cost ₱110.00 each</span>
                    </div>
                    <div class="row ms-2">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label class="label-sm">Type of Certificate</label>
                                </div>
                                <div class="col text-end">
                                    <label class="label-sm">Number of Copies</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="bonafideStudent" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Bonafide Student">
                                     <label class="label-sm">Bonafide Student</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Bonafide Student]" class="form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="CAR (Completed Academic Record)">
                                    <label class="label-sm">CAR</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[CAR (Completed Academic Record)]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Completion Certificate in Caregiving">
                                    <label class="label-sm">Certificate in Caregiving</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Completion Certificate in Caregiving]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Permit to Cross Enroll">
                                    <label class="label-sm">Permit to Cross Enroll</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Permit to Cross Enroll]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="NSTP/CWTS Serial No.">
                                    <label class="label-sm">NSTP/CWTS Serial No.</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[NSTP/CWTS Serial No.]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Request for TOR">
                                    <label class="label-sm">Request for TOR</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Request for TOR]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Special Order">
                                    <label class="label-sm">Special Order</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Special Order]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label class="label-sm">Type of Certificate</label>
                                </div>
                                <div class="col text-end">
                                    <label class="label-sm">Number of Copies</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="English as Medium of Instruction">
                                    <label class="label-sm">EMI</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[English as Medium of Instruction]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Enrollment">
                                    <label class="label-sm">Enrollment</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Enrollment]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Good Moral Character">
                                    <label class="label-sm">Good Moral Character</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Good Moral Character]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Grading System">
                                    <label class="label-sm">Grading System</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Grading System]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Graduation">
                                    <label class="label-sm">Graduation</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Graduation]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Request for Form 137">
                                    <label class="label-sm">Requesting Form 137</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Request for Form 137]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Underprocess">
                                    <label class="label-sm">Underprocess</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Underprocess]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label class="label-sm">Type of Certificate</label>
                                </div>
                                <div class="col text-end">
                                    <label class="label-sm">Number of Copies</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="General Weighted Average">
                                    <label class="label-sm">GWA</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[General Weighted Average]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="LEBC">
                                    <label class="label-sm">LEBC (for LAW)</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[LEBC]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Name Discrepancy">
                                    <label class="label-sm">Name Discrepancy</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Name Discrepancy]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="No Objection">
                                    <label class="label-sm">No Objection</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[No Objection]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="PACUCOA">
                                    <label class="label-sm">PACUCOA</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[PACUCOA]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="QATAR">
                                    <label class="label-sm">QATAR</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[QATAR]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Units Earned">
                                    <label class="label-sm">Units Earned</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Units Earned]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" onchange="enableButton()" value="Foreign Certification">
                                    <label class="label-sm">Foreign Certification</label>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <input name="numCopies[Foreign Certification]" class=" form-check-input" type="number" style="width:60%" min="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="border-start border-danger border-4 mb-2">
                            <h4 class="ms-2">Copy of Grades</h4>
                        </div>
                        <div class="alert alert-info p-1 mb-1">
                            <span style="font-size: 12px">Copy of Grades cost ₱110.00</span>
                        </div>
                        <div class="col">
                            <div class="form-group mb-1">
                                <input class="form-check-input" type="checkbox" name="reqCopyGrade" value="true" onchange="enableButton()">
                                <label class="label-sm">Request Copy of Grades</label>
                            </div>
                            <div class="form-group mb-2">
                                <label class="label-sm">Number of Copies</label>
                                <input name="copyGrades[copies]" class="form-control form-control-sm" type="number">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="label-sm">Semester</label>
                                        <select class="form-select form-select-sm" name="copyGrades[semester]" id="">
                                            <option value="">Choose</option>
                                            <option value="1">1st Semester</option>
                                            <option value="2">2nd Semester</option>
                                            <option value="3">Summer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="label-sm">School Year</label>
                                        <input name="copyGrades[schoolYear]" class="form-control form-control-sm" type="text" placeholder="e.g. 2019-2020">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border-start border-danger border-4 mb-2">
                            <h4 class="ms-2">Authentication</h4>
                        </div>
                        <div class="alert alert-info p-1 mb-1">
                            <span class="label-sm">Authentication cost ₱89.50 each</span>
                        </div>
                        <div class="row ms-2">
                            <div class="form-group">
                                <input id="authentication" class="form-check-input" type="checkbox" name="authentication[]" value="Transcript of Record" onchange="enableButton()">
                                <label class="label-sm">Transcript of Record</label>
                            </div>
                            <div class="form-group">
                                <input id="authentication" class="form-check-input" type="checkbox" name="authentication[]" value="Diploma" onchange="enableButton()">
                                <label class="label-sm">Diploma</label>
                            </div>
                            <div class="form-group">
                                <input id="authentication" class="form-check-input" type="checkbox" name="authentication[]" value="Certificate" onchange="enableButton()">
                                <label class="label-sm">Certificate</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border-start border-danger border-4 mb-2">
                            <h4 class="ms-2">Photocopy</h4>
                        </div>
                        <div class="row ms-2">
                            <div class="form-group">
                                <input id="photocopy" class="form-check-input" type="checkbox" name="photocopy[]" value="Transcript of Record" onchange="enableButton()">
                                <label class="label-sm">Transcript of Record</label>
                            </div>
                            <div class="form-group">
                                <input id="photocopy" class="form-check-input" type="checkbox" name="photocopy[]" value="Diploma" onchange="enableButton()">
                                <label class="label-sm">Diploma</label>
                            </div>
                            <div class="form-group">
                                <input id="photocopy" class="form-check-input" type="checkbox" name="photocopy[]" value="Certificate" onchange="enableButton()">
                                <label class="label-sm">Certificate</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                   <span class="label-sm">Type</span>
                                    <div class="form-group">
                                        <input class="form-radio-input" type="radio" name="photocopy[photocopyType]" value="ordinary">
                                        <label class="label-sm">Ordinary</label>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-radio-input" type="radio" name="photocopy[photocopyType]" value="colored">
                                        <label class="label-sm">Colored</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="label-sm">Price</span>
                                    <div class="price">
                                        <label class="label-sm">₱ 1.20</label>
                                    </div>
                                    <div class="price">
                                        <label class="label-sm">₱ 20.00</label>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button id="submitSelected"class="btn btn-success" disabled>PREVIEW REQUEST</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
@endsection