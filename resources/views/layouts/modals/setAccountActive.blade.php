<div id="activate-status-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Reactivate Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Do you wish to reactivate this account?
                </p>
            </div>
            <div class="modal-footer">
                @if ($accountInfo['accountInfo']->account_role != 'student')
                    <form action="{{ route('admin.setAccontActiveStatus', ['userID' => $accountInfo['accountInfo']->staff_id, 'activeStatus' => 1]) }}" method="post">
                @else
                    <form action="{{ route('admin.setAccontActiveStatus', ['userID' => $accountInfo['accountInfo']->student_id, 'activeStatus' => 1]) }}" method="post">
                @endif
                    @csrf
                    <button class="btn btn-sm btn-danger">Proceed</button>
                </form>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
