<div id="view-account-picture" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">
                    Account Picture
                    <br>
                    <span class="h6">
                        {{
                            $accountInfo['accountInfo']->first_name." ".
                            $accountInfo['accountInfo']->last_name
                        }}
                    </span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img class="img-fluid p-1" src="{{asset('storage/'.$accountInfo['picturePath'])}}">
            </div>
            <div class="modal-footer">
                @if($accountInfo['accountInfo']->account_role != 'student')
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#update-staff-picture">Update</button>
                    <button class="btn btn-sm btn-success" data-bs-dismiss="modal">
                        Cancel
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>