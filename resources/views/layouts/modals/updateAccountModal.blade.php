@if ($accountInfo['accountInfo']->account_role != 'student')
    <div id="admin-update-account" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">Update Staff Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="updateAccount" action="{{route('admin.updateStaffAccount', ['userID' => $accountInfo['accountInfo']->staff_id])}}" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="firstName">Account Type</label>
                            <select class="form-select form-select-sm" name="accountRole" required>
                                <option value="">Choose</option>
                                <option value="admin">Admin</option>
                                <option value="cic">College in Charge</option>
                                <option value="rec_assoc">Records Associate</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Assigned Department</label>
                            <select class="form-select form-select-sm " name="assignedDept">
                                <option value="">Choose...</option>
                                <option value="001">Arts and Science</option>
                                <option value="002">Business and Accountancy</option>
                                <option value="003">Computer Studies</option>
                                <option value="004">Criminal Justice Education</option>
                                <option value="005">Education</option>
                                <option value="006">Engineering and Architecture</option>
                                <option value="007">Nursing</option>
                                <option value="008">Graduate Studies</option>
                                <option value="009">School of Law</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="firstName">First Name</label>
                            <input class="form-control form-control-sm" type="text" name="firstName" value="{{$accountInfo['accountInfo']->first_name}}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="firstName">Last Name</label>
                            <input class="form-control form-control-sm" type="text" name="lastName" value="{{$accountInfo['accountInfo']->last_name}}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="firstName">Middle Name</label>
                            <input class="form-control form-control-sm" type="text" name="middleName" value="{{$accountInfo['accountInfo']->middle_name}}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="firstName">Phone Number</label>
                            <input class="form-control form-control-sm" type="text" name="phoneNumber" value="{{$accountInfo['accountInfo']->phone_number}}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="firstName">Email</label>
                            <input class="form-control form-control-sm" type="email" name="email" value="{{$accountInfo['accountInfo']->email}}">
                        </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger" form="updateAccount">Update</button>
                    <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endif