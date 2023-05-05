@foreach($credentials as $credential)
    <div id="{{'proceed_update-'.$credential->document_id}}" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true" style="display: none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">Update Credential</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Updating this file will replace the currently stored document and cannot be undone. Do you wish to proceed?
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger" form="{{$credential->input_name}}">Proceed</button>
                    <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

