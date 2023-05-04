<div id="cancel-request-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Cancel Requested Archive</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Do you wish to cancel this requested archive?
                </p>
            </div>
            <div class="modal-footer">
                <form action="{{route('cancelRequestedArchive', ['requestID' => $requestInfo->request_id])}}" method="post">
                    @csrf
                    <button class="btn btn-sm btn-danger">Proceed</button>
                </form>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>