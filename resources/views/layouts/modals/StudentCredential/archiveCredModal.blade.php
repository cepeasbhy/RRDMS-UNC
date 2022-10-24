<div id="archive-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Archive Selected Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to archive this record?
                </p>
            </div>
            {{-- TO DO: Change route to something that will set archiveStatus = 1 --}}
            <div class="modal-footer">
                <form action="{{ route('deleteStudent', ['id' => $student->student_id]) }}" method="post">
                    @csrf
                    <button class="btn btn-sm btn-success">Proceed</button>
                </form>
                <button class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
