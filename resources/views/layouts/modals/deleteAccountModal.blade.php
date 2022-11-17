@if ($accountInfo['accountInfo']->account_role != 'student')
    <div id="admin-delete-account" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure you want to delete this account?
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('admin.deleteStaffAccount', ['userID' => $accountInfo['accountInfo']->staff_id])}}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-danger">Proceed</button>
                    </form>
                    <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endif
