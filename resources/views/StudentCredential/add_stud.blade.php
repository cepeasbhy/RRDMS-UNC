@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <form class="mb-3" action="{{ route('StudCredHome') }}" method="get">
            <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
        <form class="row" action="{{ route('submitStudent') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-5">
                <div class="border-start border-danger border-4">
                    <h4 class="ms-3">STUDENT INFORMATION</h4>
                </div>
                <div class="ms-2">
                    <div class="form-group mb-2">
                        <label class=" col-form-label col-form-label-sm" for="">Student ID <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm @error('student_id') is-invalid @enderror"
                            value="{{ old('student_id') }}"type="text" name="student_id" required>
                        @error('student_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">First Name <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm @error('first_name') is-invalid @enderror" type="text"
                            value="{{ old('first_name') }}" name="first_name" required>
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">Last Name <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm @error('last_name') is-invalid @enderror" type="text"
                            value="{{ old('last_name') }}" name="last_name" required>
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">Middle Name</label>
                        <input class="form-control form-control-sm @error('middle_name') is-invalid @enderror"
                            type="text" value="{{ old('middle_name') }}" name="middle_name">
                        @error('middle_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">Email<span
                            class="text-danger">*</label>
                        <input class="form-control form-control-sm @error('email') is-invalid @enderror"
                            type="text" value="{{ old('email') }}" name="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if (Auth::user()->account_role == 'RECORD_ASSOCIATE')
                        <div id="selection"></div>
                    @else
                        <div class="form-group mb-2">
                            <input type="hidden" name="department_id" value="{{$staff->assigned_dept}}">
                            <label class="col-form-label col-form-label-sm">Course</label>
                            <select class="form-select form-select-sm" name="course_id">
                                @switch($staff->assigned_dept)
                                    @case('001')   
                                            <option value="011">BS in Biology</option>
                                            <option value="012">BA in Psychology</option>
                                            <option value="013">BS in Political Science</option>
                                        @break
                                    @case('002')
                                            <option value="021">BS in Accountancy</option>
                                            <option value="022">BS in Business Administration</option>
                                            <option value="023">BS in Entrepreneurship</option></select>
                                        @break
                                    @case('003')
                                            <option value="031">BS in Information Technology</option>
                                            <option value="032">BS in Computer Science</option>
                                            <option value="033">BS in Library and Information Science</option>
                                            <option value="034">Associate in Computer Technology</option>
                                        @break
                                     @case('004')
                                            <option value="041">BS in Criminal Justice Education</option>
                                        @break
                                    @case('005')
                                            <option value="051">Bachelor of Elementary Education</option>
                                            <option value="052">Bachelor of Secondary Education</option>
                                            <option value="053">Bachelor of Physical Education</option>
                                        @break
                                    @case('006')
                                            <option value="061">BS in Architecture</option>
                                            <option value="062">BS in Civil Engineering</option>
                                            <option value="063">BS in Computer Engineering</option>
                                            <option value="064">BS in Electrical Engineering</option>
                                            <option value="065">BS in Electronics Engineering</option>
                                            <option value="066">BS in Mechanical Engineering</option>
                                        @break
                                     @case('007')
                                            <option value="071">Caregiving NCII</option>
                                            <option value="072">BS in Nursing</option>
                                        @break
                                    @case('008')
                                            <option value="081">Master in Business Administration</option>
                                            <option value="082">Master of Arts in Education</option>
                                            <option value="083">Master of Arts in English</option>
                                            <option value="084">Master of Arts in Filipino</option>
                                            <option value="085">Master of Arts in Teaching Mathematics</option>
                                            <option value="086">Master in Library and Information Science</option>
                                            <option value="087">Master of Science in Environmental Science</option>
                                            <option value="088">Master in Public Administration</option>
                                            <option value="089">PhD, Major in Behavioral Management</option>
                                            <option value="090">EdD, Major in Educational Management</option>
                                        @break
                                    @default
                                     @case('009')
                                            <option value="091">Master of Laws</option>
                                            <option value="092">Juris Doctor</option>
                                        @break
                                @endswitch
                            </select>
                        </div>
                    @endif
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">Admission Year <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm @error('admission_year') is-invalid @enderror"
                            type="text" value="{{ old('admission_year') }}" name="admission_year" required>
                        @error('admission_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="border-start border-danger border-4">
                    <h4 class="ms-3">STUDENT CREDENTIALS</h4>
                </div>
                <div class="ms-2">
                    <div class="form-group mb-2">
                        <label class="col-form-label-sm" for="picture">2x2 Picture <span
                                class="text-danger">*</span></label>
                        <input id="picture" class="form-control form-control-sm" type="file" name="picture" required>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col">
                            <label class="col-form-label-sm" for="birthCertificate">Birth Certificate</label>
                            <input id="birthCertificate" class="form-control form-control-sm" type="file"
                                name="birthCertificate">
                        </div>
                        <div class="col">
                            <label class="col-form-label-sm" for="marriageCertificate">Marriage Certificate</label>
                            <input id="marriageCertificate" class="form-control form-control-sm" type="file"
                                name="marriageCertificate">
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label class="col-form-label-sm" for="goodMoralCharacter">Certificate of Good Moral
                            Character</label>
                        <input id="goodMoralCharacter" class="form-control form-control-sm" type="file"
                            name="goodMoralCharacter">
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label-sm" for="honorDismisal">Honarable Dismisal</label>
                        <input id="honorDismisal" class="form-control form-control-sm" type="file"
                            name="honorDismisal">
                    </div>
                    <div class="form-group mb-2 row">
                        <div class="col">
                            <label class="col-form-label-sm" for="form-138">Form 138</label>
                            <input id="form138" class="form-control form-control-sm" type="file" name="form138">
                        </div>
                        <div class="col">
                            <label class="col-form-label-sm" for="form137">Form 137</label>
                            <input id="form137" class="form-control form-control-sm" type="file" name="form137">
                        </div>
                        <div class="col">
                            <label class="col-form-label-sm" for="copyGrade">Copy of Grades</label>
                            <input id="copyGrade" class="form-control form-control-sm" type="file" name="copyGrade">
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label-sm" for="tor">Transcript of Record</label>
                        <input id="tor" class="form-control form-control-sm" type="file" name="tor">
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col">
                            <label class="col-form-label-sm" for="NbiClearance">NBI Clearance</label>
                            <input id="NbiClearance" class="form-control form-control-sm" type="file" name="NbiClearance">
                        </div>
                        <div class="col">
                            <label class="col-form-label-sm" for="PoliceClearance">Police Clearance</label>
                            <input id="PoliceClearance" class="form-control form-control-sm" type="file" name="PoliceClearance">
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label-sm" for="C1">C1 Official Receipt</label>
                        <input id="C1" class="form-control form-control-sm" type="file" name="C1">
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label-sm" for="permitCrossEnroll">Permit to Cross Enroll</label>
                        <input id="permitCrossEnroll" class="form-control form-control-sm" type="file"
                            name="permitCrossEnroll">
                    </div>
                </div>
            </div>
            <div class="form-group mt-3 mb-5 text-center">
                <button class="w-50 btn btn-success">ADD STUDENT</button>
            </div>
        </form>
    </div>
@endsection
