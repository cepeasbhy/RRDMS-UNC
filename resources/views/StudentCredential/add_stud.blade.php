@extends('layouts.app')
@extends('layouts.header')

@section('content')
<section class="add-student">
    <a href="{{ route('StudCredHome') }}">
        <i class="bi bi-arrow-bar-left"></i>
        BACK
    </a>
    <h1>Add New Student</h1>

    <form id="student-form" action="{{ route('submitStudent') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="add-student__info">
            <h2>Info</h2>
            <div class="form-group">
                <label for="picture">2x2 Picture <span>*</span></label>
                <input class="form-control form-control-sm" id="picture" type="file" name="picture" required>
            </div>

            <div class="form-group">
                <label for="student_id">Student ID <span>*</span></label>
                <input class="@error('student_id') is-invalid @enderror" value="{{ old('student_id') }}" type="text" name="student_id" required placeholder="Student ID">
                @error('student_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="first_name">First Name <span>*</span></label>
                <input class="@error('first_name') is-invalid @enderror" type="text" value="{{ old('first_name') }}" name="first_name" required placeholder="First Name">
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name <span>*</span></label>
                <input class="@error('last_name') is-invalid @enderror" type="text" value="{{ old('last_name') }}" name="last_name" required placeholder="Last Name">
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input class="@error('middle_name') is-invalid @enderror" type="text" value="{{ old('middle_name') }}" name="middle_name"placeholder="Middle Name">
                @error('middle_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email<span>*</label>
                <input class="@error('email') is-invalid @enderror" type="text" value="{{ old('email') }}" name="email" placeholder="Email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <input type="hidden" name="department_id" value="{{ $staff->assigned_dept }}">
                <label for="course_id">Course</label>
                <select name="course_id">
                    @switch($staff->assigned_dept)
                        @case('001')
                            <option value="011">BS in Biology</option>
                            <option value="012">BA in Psychology</option>
                            <option value="013">BS in Political Science</option>
                        @break

                        @case('002')
                            <option value="021">BS in Accountancy</option>
                            <option value="022">BS in Business Administration</option>
                            <option value="023">BS in Entrepreneurship</option>
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

            <div class="form-group">
                <label for="admission_date">Admission Date <span>*</span></label>
                <input class="@error('admission_date') is-invalid @enderror" type="date" value="{{ old('admission_date') }}" name="admission_date" required placeholder="Admission Date">
                @error('admission_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="add-student__credentials">
            <h2>Credentials</h2>

            <div class="bi-group">
                <div class="form-group">
                    <label for="birthCertificate">Birth Certificate</label>
                    <input class="form-control form-control-sm" id="birthCertificate" type="file" name="birthCertificate">
                </div>
                <div class="form-group">
                    <label for="marriageCertificate">Marriage Certificate</label>
                    <input class="form-control form-control-sm" id="marriageCertificate" type="file" name="marriageCertificate">
                </div>
            </div>

            <div class="form-group">
                <label for="goodMoralCharacter">Certificate of Good Moral
                    Character</label>
                <input class="form-control form-control-sm" id="goodMoralCharacter" type="file" name="goodMoralCharacter">
            </div>
            <div class="form-group">
                <label for="honorDismisal">Honarable Dismisal</label>
                <input class="form-control form-control-sm" id="honorDismisal" type="file" name="honorDismisal">
            </div>

            <div class="bi-group">
                <div class="form-group">
                    <label for="form-138">Form 138</label>
                    <input class="form-control form-control-sm" id="form138" type="file" name="form138">
                </div>
                <div class="form-group">
                    <label for="form137">Form 137</label>
                    <input class="form-control form-control-sm" id="form137" type="file" name="form137">
                </div>
            </div>

            <div class="form-group">
                <label for="copyGrade">Copy of Grades</label>
                <input class="form-control form-control-sm" id="copyGrade" type="file" name="copyGrade">
            </div>
            <div class="form-group">
                <label for="tor">Transcript of Record</label>
                <input class="form-control form-control-sm" id="tor" type="file" name="tor">
            </div>

            <div class="bi-group">
                <div class="form-group">
                    <label for="NbiClearance">NBI Clearance</label>
                    <input class="form-control form-control-sm" id="NbiClearance" type="file" name="NbiClearance">
                </div>
                <div class="form-group">
                    <label for="PoliceClearance">Police Clearance</label>
                    <input class="form-control form-control-sm" id="PoliceClearance" type="file" name="PoliceClearance">
                </div>
            </div>

            <div class="form-group">
                <label for="C1">C1 Official Receipt</label>
                <input class="form-control form-control-sm" id="C1" type="file" name="C1">
            </div>
            <div class="form-group">
                <label for="permitCrossEnroll">Permit to Cross Enroll</label>
                <input class="form-control form-control-sm" id="permitCrossEnroll" type="file" name="permitCrossEnroll">
            </div>
        </div>

    </form>
    <div class="submit-btn">
        <button type="submit" form="student-form">Add Student</button>
    </div>
</section>
@endsection
