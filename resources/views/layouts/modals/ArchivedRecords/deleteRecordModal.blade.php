<div id="delete-record-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Delete this Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this Record from the Archives?
                </p>
            </div>
            <div class="modal-footer">
                <form
                    action="{{ route('deleteCredential', ['id' => $student->student_id, 'docID' => $credential->document_id]) }}"
                    method="post">
                    @csrf
                    <button class="btn btn-sm btn-danger">Proceed</button>
                </form>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
