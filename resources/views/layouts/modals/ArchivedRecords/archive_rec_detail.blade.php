<div id="archive-details-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Update Record Status and Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-archive-details" action="{{ route('singleArchive', ['id' => $student->student_id]) }}" method="post">
                    @csrf
                    <div id="SetState"></div>
                </form>
             
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-success" data-bs-toggle="modal" 
                    data-bs-target="#archive-modal">Archive Record</button>
                <button class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>