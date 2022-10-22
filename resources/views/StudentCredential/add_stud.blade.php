@extends('layouts.app')

@section('content')
    <div class="row">
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
                    <div class="form-group mb-2" id="selection">

                    </div>
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
                        <input id="picture" class="form-control form-control-sm" type="file" name="picture">
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
                    <div class="form-group mb-2">
                        <label class="col-form-label-sm" for="clearance">NBI/Police Clearance</label>
                        <input id="clearance" class="form-control form-control-sm" type="file" name="clearance">
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
