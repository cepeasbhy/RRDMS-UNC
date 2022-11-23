<div id="admin-export-grad" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Export Graduates List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="exportGradList" action="{{route('admin.exportGraduates')}}" method="post">
                    @csrf
                    <div class="selection">

                    </div>
                    <div class="form-group mb-2">
                        <label class="col-form-label col-form-label-sm">Admission Year
                            <span
                            class="text-danger">*</span>
                        </label>
                        <input class="form-control form-control-sm" type="text" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger" form="exportGradList">EXPORT</button>
                <form action="{{route('admin.exportAllGraduates')}}" method="post">
                    @csrf
                    <button class="btn btn-sm btn-secondary">EXPORT ALL</button>
                </form>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>