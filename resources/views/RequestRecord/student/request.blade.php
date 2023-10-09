@extends('layouts.app')
@extends('layouts.header')

@section('request-content')
    <section class="req-form">
        <h1>Request Form</h1>

        <article class="req-form__subheading">
            <h2>Student Information</h2>
            <div class="req-form__subheading--user">
                <img draggable="false" src="{{ asset('storage/' . $picturePath->document_loc) }}">
                <div class="info">
                    <p>{{ $student->last_name }}, {{ $student->first_name }}
                        {{ mb_substr($student->middle_name, 0, 1) . '.' }}</p>
                    <p>{{ $student->student_id }}</p>
                    <p>{{ $student->course_name }}</p>
                </div>
            </div>
        </article>

        <section class="req-form__content">
            <h2 class="ms-1 my-auto">Request Records</h2>
            <form action="{{ route('stud.submitRequest') }}" id="request-form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="req-form__content--category">
                    <h3>Diploma</h3>

                    <p>Type of Diploma <span>Price</span></p>
                    <div class="checkbox-group">
                        <input id="bachelor" type="checkbox" name="diploma[]"
                            value="Bachelor/Law Degree" onchange="enableButton()">
                        <label for="bachelor">Bachelor/Law Degree <span>₱{{ number_format($recordPrices['bachelorLawDegreePrice'], 2, '.') }}</span></label>
                    </div>
                    <div class="checkbox-group">
                        <input id="masteral" type="checkbox" name="diploma[]"
                            value="Masteral Degree" onchange="enableButton()">
                        <label for="masteral">Masteral Degree <span>
                            ₱{{ number_format($recordPrices['masteralDegreePrice'], 2, '.') }}</span></label>
                    </div>
                    <div class="checkbox-group">
                        <input id="tesda" type="checkbox" name="diploma[]"
                            value="TESDA" onchange="enableButton()">
                        <label for="tesda">TESDA <span>₱{{ number_format($recordPrices['tesdaDegreePrice'], 2, '.') }}</span></label>
                    </div>
                    <div class="checkbox-group">
                        <input id="caregiving" type="checkbox" name="diploma[]"
                            value="Caregiving" onchange="enableButton()">
                        <label for="caregiving">Caregiving <span>₱{{ number_format($recordPrices['caregivingDegreePrice'], 2, '.') }}</span></label>
                    </div>

                    <div class="form-group">
                        <label for="affidavit">Upload Affidavit file</label>
                        <input id="affidavit" class="form-control form-control-sm w-100" type="file"
                            name="affidavit">
                    </div>
                </div>

                <div class="req-form__content--category">
                    <h3>Transcript of Record</h3>
                    <span class="flag">Transcript of Record cost
                        ₱{{ number_format($recordPrices['torPrice'], 2, '.') }}
                    </span>

                    <div class="checkbox-group">
                        <input id="torReq" type="checkbox" name="reqTOR" value="true"
                            onchange="enableButton()">
                        <label for="torReq">Request for Transcript of Record</label>
                    </div>
                    <div class="form-group">
                        <label for="torCopies">Number of Copies</label>
                        <input placeholder="Num of Copies" id="torCopies" name="tor[copies]" class="copies-box" type="number" min="1">
                    </div>
                    <div class="form-group">
                        <label for="selectPurpose">Purpose</label>
                        <select id="selectPurpose" class="form-select form-select-sm" name="tor[purpose]"
                            id="">
                            <option value="">Choose</option>
                            <option value="Records and References">Records and References</option>
                            <option value="Board Examination">Board Examination</option>
                            <option value="BAR Examination">BAR Examination</option>
                            <option value="Employment">Employment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputPurpose">Others, pls. specify</label>
                        <input id="inputPurpose" name="tor[other_purpose]" class="form-control form-control-sm"
                            type="text">
                    </div>

                    <div class="form-group">
                        <label for="updatedPicture">Upload Updated Picture</label>
                        <input id="updatedPicture" class="form-control form-control-sm w-100" type="file"
                            name="updatedPicture">
                    </div>
                </div>

                <div class="req-form__content--category">
                    <h3>Copy of Grades</h3>
                    <span class="flag">Copy of Grades cost
                        ₱{{ number_format($recordPrices['copyGradePrice'], 2, '.') }}</span>

                    <div class="checkbox-group">
                        <input id="reqCopyGrade" type="checkbox" name="reqCopyGrade"
                            value="true" onchange="enableButton()">
                        <label for="reqCopyGrade">Request Copy of Grades</label>
                    </div>
                    <div class="form-group">
                        <label for="numCopiesGrade">Number of Copies</label>
                        <input placeholder="Num of Copies" id="numCopiesGrade" name="copyGrades[copies]" class="copies-box" type="number">
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-select form-select-sm" name="copyGrades[semester]"
                            id="semester">
                            <option value="">Choose</option>
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                            <option value="3">Summer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="schoolYear">School Year</label>
                        <input type="text" id="schoolYear" name="copyGrades[schoolYear]"
                            type="text"
                            placeholder="e.g. 2019-2020">
                    </div>
                </div>

                <div class="req-form__content--category">
                    <h2>Certificates</h2>
                    <span class="flag">Certificate cost
                        ₱{{ number_format($recordPrices['certPrice'], 2, '.') }} each</span>

                    <p>Type of Certificate</p>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="bonafideStudent" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Bonafide Student">
                            <label for="bonafideStudent">Bonafide Student</label>
                        </div>
                        <label for="bonafide-copies" class="hidden">Number of Copies</label>
                        <input id="bonafide-copies" name="numCopies[Bonafide Student]" type="number" min="1" placeholder="Num of Copies">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="car" type="checkbox"
                                name="certificate[]" onchange="enableButton()"
                                value="CAR (Completed Academic Record)">
                            <label for="car">CAR</label>
                        </div>
                        <label for="car-copies" class="hidden">Number of Copies</label>
                        <input id="car-copies" name="numCopies[CAR (Completed Academic Record)]" type="number" min="1" placeholder="Num of Copies">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="caregiving" type="checkbox"
                                name="certificate[]" onchange="enableButton()"
                                value="Completion Certificate in Caregiving">
                            <label for="caregiving">Caregiving</label>
                        </div>
                        <label for="caregiving-copies" class="hidden">Number of Copies</label>
                        <input id="caregiving-copies" name="numCopies[Completion Certificate in Caregiving]" type="number" min="1" placeholder="Num of Copies">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="cross" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Permit to Cross Enroll">
                            <label for="cross">Permit to Cross Enroll</label>
                        </div>
                        <label for="cross-copies" class="hidden">Number of Copies</label>
                        <input id="cross-copies" name="numCopies[Permit to Cross Enroll]" placeholder="Num of Copies" type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="nstp" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="NSTP/CWTS Serial No.">
                            <label for="nstp">NSTP/CWTS Serial No.</label>
                        </div>
                        <label for="nstp-copies" class="hidden">Number of Copies</label>
                        <input id="nstp-copies" name="numCopies[NSTP/CWTS Serial No.]" placeholder="Num of Copies" type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="tor" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Request for TOR">
                            <label for="tor">Requesting for TOR</label>
                        </div>
                        <label for="tor-copies" class="hidden">Number of Copies</label>
                        <input id="tor-copies" name="numCopies[Request for TOR]" placeholder="Num of Copies" type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="special" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Special Order">
                            <label for="special">Special Order</label>
                        </div>
                        <label for="special-copies" class="hidden">Number of Copies</label>
                        <input id="special-copies" name="numCopies[Special Order]" placeholder="Num of Copies" type="number" min="1">
                    </div>
                </div>

                <div class="req-form__content--category">
                    <p>Type of Certificate</p>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="emi" type="checkbox"
                                name="certificate[]" onchange="enableButton()"
                                value="English as Medium of Instruction">
                            <label for="emi">EMI</label>
                        </div>
                        <label for="emi-copies" class="hidden">Number of Copies</label>
                        <input id="emi-copies" name="numCopies[English as Medium of Instruction]"
                            placeholder="Num of Copies" type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="enrollment" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Enrollment">
                            <label for="enrollment">Enrollment</label>
                        </div>
                        <label for="enrollment-copies" class="hidden">Number of Copies</label>
                        <input id="enrollment-copies" name="numCopies[Enrollment]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="moral" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Good Moral Character">
                            <label for="moral">Good Moral Character</label>
                        </div>
                        <label for="gmc-copies" class="hidden">Number of Copies</label>
                        <input id="gmc-copies" name="numCopies[Good Moral Character]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="grading" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Grading System">
                            <label for="grading">Grading System</label>
                        </div>
                        <label for="grading-copies" class="hidden">Number of Copies</label>
                        <input id="grading-copies" name="numCopies[Grading System]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="grad" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Graduation">
                            <label for="grad">Graduation</label>
                        </div>
                        <label for="grad-copies" class="hidden">Number of Copies</label>
                        <input id="grad-copies" name="numCopies[Graduation]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="137" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Request for Form 137">
                            <label for="137">Requesting Form 137</label>
                        </div>
                        <label for="137-copies" class="hidden">Number of Copies</label>
                        <input id="137-copies" name="numCopies[Request for Form 137]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="underprocess" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Underprocess">
                            <label for="underprocess">Underprocess</label>
                        </div>
                        <label for="underprocess-copies" class="hidden">Number of Copies</label>
                        <input id="underprocess-copies" name="numCopies[Underprocess]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>
                </div>

                <div class="req-form__content--category">
                    <p>Type of Certificate</p>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="gwa" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="General Weighted Average">
                            <label for="gwa">GWA</label>
                        </div>
                        <label for="gwa-copies" class="hidden">Number of Copies</label>
                        <input id="gwa-copies" name="numCopies[General Weighted Average]"
                            placeholder="Num of Copies" type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="lebc" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="LEBC">
                            <label for="lebc">LEBC (for LAW)</label>
                        </div>
                        <label for="lebc-copies" class="hidden">Number of Copies</label>
                        <input id="lebc-copies" name="numCopies[LEBC]" placeholder="Num of Copies" type="number"
                            min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="discrepancy" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Name Discrepancy">
                            <label for="discrepancy">Name Discrepancy</label>
                        </div>
                        <label for="discrepancy-copies" class="hidden">Number of Copies</label>
                        <input id="discrepancy-copies" name="numCopies[Name Discrepancy]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="objection" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="No Objection">
                            <label for="objection">No Objection</label>
                        </div>
                        <label for="objection-copies" class="hidden">Number of Copies</label>
                        <input id="objection-copies" name="numCopies[No Objection]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="pacucoa" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="PACUCOA">
                            <label for="pacucoa">PACUCOA</label>
                        </div>
                        <label for="pacucoa-copies" class="hidden">Number of Copies</label>
                        <input id="pacucoa-copies" name="numCopies[PACUCOA]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="qatar" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="QATAR">
                            <label for="qatar">QATAR</label>
                        </div>
                        <label for="qatar-copies" class="hidden">Number of Copies</label>
                        <input id="qatar-copies" name="numCopies[QATAR]" placeholder="Num of Copies" type="number"
                            min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="units" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Units Earned">
                            <label for="units">Units Earned</label>
                        </div>
                        <label for="units-copies" class="hidden">Number of Copies</label>
                        <input id="units-copies" name="numCopies[Units Earned]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input id="foreign" type="checkbox"
                                name="certificate[]" onchange="enableButton()" value="Foreign Certification">
                            <label for="foreign">Foreign Certification</label>
                        </div>
                        <label for="foreign-copies" class="hidden">Number of Copies</label>
                        <input id="foreign-copies" name="numCopies[Foreign Certification]" placeholder="Num of Copies"
                            type="number" min="1">
                    </div>
                </div>

                <div class="req-form__content--category">
                    <h3>Authentication</h3>
                    <span class="flag">Authentication cost
                        ₱{{ number_format($recordPrices['authPrice'], 2, '.') }} each</span>

                    <div class="checkbox-group">
                        <input id="transcript" type="checkbox"
                            name="authentication[]" value="Transcript of Record" onchange="enableButton()">
                        <label for="transcript">Transcript of Record</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="dimpolma" type="checkbox"
                            name="authentication[]" value="Diploma" onchange="enableButton()">
                        <label for="dimpolma">Diploma</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="cert" type="checkbox"
                            name="authentication[]" value="Certificate" onchange="enableButton()">
                        <label for="cert">Certificate</label>
                    </div>
                </div>

                <div class="req-form__content--category">
                    <h3>Photocopy</h3>

                    <div class="checkbox-group">
                        <input id="tor-photocopy" type="checkbox" name="photocopy[]"
                            value="Transcript of Record" onchange="enableButton()">
                        <label for="tor-photocopy">Transcript of Record</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="diploma-photocopy" type="checkbox" name="photocopy[]"
                            value="Diploma" onchange="enableButton()">
                        <label for="diploma-photocopy">Diploma</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="cert-photocopy" type="checkbox" name="photocopy[]"
                            value="Certificate" onchange="enableButton()">
                        <label for="cert-photocopy">Certificate</label>
                    </div>

                    <p>Type <span>Price</span></p>
                    <div class="checkbox-group">
                        <input id="ordinary" type="radio" name="photocopy[photocopyType]"
                            value="ordinary">
                        <label for="ordinary">Ordinary <span>₱{{ number_format($recordPrices['photoOrdinaryPrice'], 2, '.') }}</span></label>
                    </div>
                    <div class="checkbox-group">
                        <input id="colored" type="radio" name="photocopy[photocopyType]"
                            value="colored">
                        <label for="colored">Colored <span>₱{{ number_format($recordPrices['photoColoredPrice'], 2, '.') }}</span></label>
                    </div>
                </div>
            </form>

            <div class="req-form__content--nda">
                <h2>Non-Disclosure/Confidentiality Agreements</h2>
                <p>
                    The parties agree to comply with, and have adequate measures in place to ensure that its
                    directors,
                    officers, employees, and Representatives comply at all times with: (a) the
                    provisions and obligations contained in Republic Act No. 10173 or the “Data Privacy Act of the
                    Philippines” and its implementing rules and regulations, and (b) other
                    applicable data privacy laws and regulations, as may be promulgated and/or amended from time to
                    time. By agreeing to execute and enter into this Agreement, the parties
                    agree that any information exchanged between them may be collected, processed, shared and used
                    but
                    only for purposes relevant to the Transaction. Each of the parties
                    agrees to hold the other free and harmless from any costs or liability arising from its failure
                    to
                    comply with the requirements of the Data Privacy Act of the Philippines.
                </p>

                <button id="submitSelected" form="request-form" disabled>
                    Submit Request
                </button>
            </div>
        </section>

    </section>

    <script src="{{ asset('js/main.js') }}"></script>
@endsection
