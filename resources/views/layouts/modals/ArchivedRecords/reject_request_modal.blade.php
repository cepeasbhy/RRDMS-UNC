<div id="reject-request-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Reject Requested Archive</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="rejectRequestForm" action="{{ route($routeName, ['requestID' => $requestInfo->request_id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>State Reason for Rejecting Requested Archive</label>
                        <input class="form-control form-control-sm" type="text" name="reason" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger" form="rejectRequestForm">Proceed</button>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>