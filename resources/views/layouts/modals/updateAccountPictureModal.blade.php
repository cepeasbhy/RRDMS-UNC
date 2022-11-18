@if ($accountInfo['accountInfo']->account_role != 'student')
    <div id="update-staff-picture" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">Update Account Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="picture" action="{{route('admin.updateAccountPicture', ['userID' => $accountInfo['accountInfo']->staff_id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="picture">Choose a file to be updated with Picture</label>
                        <input id="picture" class="form-control form-control-sm" type="file" name="picture">
                </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger" form="picture">Proceed</button>
                    <button class="btn btn-sm btn-success" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif