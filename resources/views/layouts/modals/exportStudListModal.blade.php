<div id="admin-export-stud" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Export Student List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="exportStudList" action="{{route('admin.exportStudList')}}" method="get">
                    @csrf
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm">Department</label>
                        <select class="form-select form-select-sm " name="department_id">
                            <option value="">Choose...</option>
                            <option value="001">Arts and Science</option>
                            <option value="002">Business and Accountancy</option>
                            <option value="003">Computer Studies</option>
                            <option value="004">Criminal Justice Education</option>
                            <option value="005">Education</option>
                            <option value="006">Engineering and Architecture</option>
                            <option value="007">Nursing</option>
                            <option value="008">Graduate Studies</option>
                            <option value="009">School of Law</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="">Choose...</option>
                            <option value="0">INACTIVE</option>
                            <option value="1">ACTIVE</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm">Admission Year</label>
                        <input name="admissionYear" class="form-control form-control-sm" type="text">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger" form="exportStudList">Export</button>
                <form action="{{route('admin.exportAllStud')}}" method="get">
                    @csrf
                    <button class="btn btn-sm btn-secondary">Export All</button>
                </form>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>