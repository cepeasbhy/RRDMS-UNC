<div id="update-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Update Student Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-form" action="{{route($routeName, ['id' => $student->student_id])}}" method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">First Name</label>
                            <input class="form-control form-control-sm @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{$student->first_name}}">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">Last Name</label>
                        <input class="form-control form-control-sm @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{$student->last_name}}">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">Middle Name</label>
                        <input class="form-control form-control-sm @error('middle_name') is-invalid @enderror" type="text" name="middle_name" value="{{$student->middle_name}}">
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
                            type="text" value="{{$student->email}}" name="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if (Auth::user()->account_role == 'rec_assoc')
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
                        <label class="col-form-label col-form-label-sm" for="">Admission Year</label>
                        <input class="form-control form-control-sm @error('admission_year') is-invalid @enderror" type="text" name="admission_year" value="{{$student->admission_year}}">
                        @error('admission_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-success" form="update-form">Update Information</button>
                <button class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>