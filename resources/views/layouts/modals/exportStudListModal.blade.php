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
                    <div class="selection"></div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm" for="">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="">Choose...</option>
                            <option value="1">ACTIVE</option>
                            <option value="2">TRANSFERED</option>
                            <option value="3">DROPPED OUT</option>
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