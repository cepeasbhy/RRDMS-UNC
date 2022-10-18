<div id="update-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Update Student Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-form" action="{{route('updateStudent', ['id' => $student->student_id])}}" method="post">
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
                    <div class="form-group mb-2" id="selection">

                    </div>
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