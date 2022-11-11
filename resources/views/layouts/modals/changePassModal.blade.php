<div id="change-pass-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="update-password" action="{{route('changePassword')}}" method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="old-password">Old Password</label>
                        <input id="old-password" name="old_password" type="password" class="form-control form-control-sm @error('old_password') is-invalid @enderror" required>
                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="">New Password</label>
                        <input name="new_password" type="password" class="form-control form-control-sm @error('new_password') is-invalid @enderror" required>
                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password-confirmation">Confirm New Password</label>
                        <input id="password-confirmation" name="new_password_confirmation" type="password" class="form-control form-control-sm @error('confirm_password') is-invalid @enderror" required>
                        @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger" form="update-password">Update Password</button>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
