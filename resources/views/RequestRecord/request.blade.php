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
            <form action="" method="post">
                <div class="row">
                    <div class="col">
                        <div class="border-start border-danger border-4">
                            <h4 class="ms-2">Diploma</h4>
                        </div>
                        <div class="row">
                            <div class="col ms-3">
                                <span class="label-sm">Type of Diploma</span>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]" value="Bachelor/Law Degree">
                                    <label class="label-sm">Bachelor/Law Degree</label>
                                </div>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]" value="Masteral Degree">
                                    <label class="label-sm">Masteral Degree</label>
                                </div>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]" value="TESDA">
                                    <label class="label-sm">TESDA</label>
                                </div>
                                <div class="form-group">
                                    <input id="diploma" class="form-check-input" type="checkbox" name="diploma[]" value="Caregiving">
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
                        <div class="form-group">
                            <div class="border-start border-danger border-4">
                                <h4 class="ms-2">Transcript of Record</h4>
                            </div>
                        </div>
                        <div class="row w-75 ms-2">
                            <div class="alert alert-info p-1 mb-1">
                                <label class="label-sm">Transcript of Record cost ₱110.00</label>
                            </div>
                            <div class="form-group mb-1">
                                <input class="form-check-input" type="checkbox" name="requestTOR" value="true">
                                <label class="label-sm">Request for TOR</label>
                            </div>
                            <div class="form-group mb-1">
                                <label class="label-sm">Number of Copies</label>
                                <input class="form-control form-control-sm" type="number">
                            </div>
                            <div class="form-group mb-1">
                                <label class="label-sm">Purpose</label>
                                <select class="form-select form-select-sm" name="purpose" id="">
                                    <option value="">Choose...</option>
                                    <option value="Records and References">Records and References</option>
                                    <option value="Board Examination">Board Examination</option>
                                    <option value="BAR Examination">BAR Examination</option>
                                    <option value="Employment">Employment</option>
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label class="label-sm">Others, pls. specify</label>
                                <input class="form-control form-control-sm"type="text" name="otherPurpose">
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
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Bonafide Student">
                                <label class="label-sm">Bonafide Student</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="CAR (Completed Academic Record)">
                                <label class="label-sm">CAR (Completed Academic Record)</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Completion Certificate in Caregiving">
                                <label class="label-sm">Completion Certificate in Caregiving</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Permit to Cross Enroll">
                                <label class="label-sm">Permit to Cross Enroll</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="NSTP/CWTS Serial No.">
                                <label class="label-sm">NSTP/CWTS Serial No.</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Request for TOR">
                                <label class="label-sm">Request for TOR</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Special Order">
                                <label class="label-sm">Special Order</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="English as Medium of Instruction">
                                <label class="label-sm">English as Medium of Instruction</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Enrollment">
                                <label class="label-sm">Enrollment</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Good Moral Character">
                                <label class="label-sm">Good Moral Character</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Grading System">
                                <label class="label-sm">Grading System</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Graduation">
                                <label class="label-sm">Graduation</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Request for Form 137">
                                <label class="label-sm">Request for Form 137</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Underprocess">
                                <label class="label-sm">Underprocess</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="General Weighted Average">
                                <label class="label-sm">General Weighted Average</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="LEBC">
                                <label class="label-sm">LEBC</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Name Discrepancy">
                                <label class="label-sm">Name Discrepancy</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="No Objection">
                                <label class="label-sm">No Objection</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="PACUCOA">
                                <label class="label-sm">PACUCOA</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="QATAR">
                                <label class="label-sm">QATAR</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Units Earned">
                                <label class="label-sm">Units Earned</label>
                            </div>
                            <div class="form-group">
                                <input id="certificate" class="form-check-input" type="checkbox" name="certificate[]" value="Foreign Certification">
                                <label class="label-sm">Foreign Certification</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col">
                        <div class="border-start border-danger border-4 mb-2">
                            <h4 class="ms-2">Copy of Grades</h4>
                        </div>
                        <div class="alert alert-info p-1 mb-1">
                            <span style="font-size: 12px">Copy of Grades cost ₱110.00</span>
                        </div>
                        <div class="col">
                            <div class="form-group mb-1">
                                <input class="form-check-input" type="checkbox" name="reqCopyGrade" value="true">
                                <label class="label-sm">Request Copy of Grades</label>
                            </div>
                            <div class="form-group mb-2">
                                <label class="label-sm">Number of Copies</label>
                                <input name="copyGradeCopies"class="form-control form-control-sm" type="number">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="label-sm">Semester</label>
                                        <select class="form-select form-select-sm" name="semester" id="">
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
                                        <input name="schoolYear"class="form-control form-control-sm" type="text" placeholder="e.g. 2019-2020">
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
                                <input id="authentication" class="form-check-input" type="checkbox" name="authentication[]" value="Transcript of Record">
                                <label class="label-sm">Transcript of Record</label>
                            </div>
                            <div class="form-group">
                                <input id="authentication" class="form-check-input" type="checkbox" name="authentication[]" value="Diploma">
                                <label class="label-sm">Diploma</label>
                            </div>
                            <div class="form-group">
                                <input id="authentication" class="form-check-input" type="checkbox" name="authentication[]" value="Certificate">
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
                                <input id="photocopy" class="form-check-input" type="checkbox" name="photocopy[]" value="Transcript of Record">
                                <label class="label-sm">Transcript of Record</label>
                            </div>
                            <div class="form-group">
                                <input id="photocopy" class="form-check-input" type="checkbox" name="photocopy[]" value="Diploma">
                                <label class="label-sm">Diploma</label>
                            </div>
                            <div class="form-group">
                                <input id="photocopy" class="form-check-input" type="checkbox" name="photocopy[]" value="Certificate">
                                <label class="label-sm">Certificate</label>
                            </div>
                            <div class="row">
                                <div class="col">
                                   <span class="label-sm">Type</span>
                                    <div class="form-group">
                                        <input class="form-radio-input" type="radio" name="photocopyType" value="ordinary">
                                        <label class="label-sm">Ordinary</label>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-radio-input" type="radio" name="photocopyType" value="colored">
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
            </form>
        </div>
    </div>
@endsection