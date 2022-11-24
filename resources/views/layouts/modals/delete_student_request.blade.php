<div id="delete-request-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Deny this Request?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route($routeName, ['request_id' => $request_id->request_id]) }}" method="post"
                    id="denyRequest">
                    @csrf
                    <div class="form-group">
                        <label for="" class="col-form-label col-form-label-sm">Reason for Denying this Request
                            <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control form-control-sm" required
                            placeholder="Insert some reason here" name="denyReason">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger" form="denyRequest">Proceed</button>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
