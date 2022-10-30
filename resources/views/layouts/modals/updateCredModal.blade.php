@foreach ($credentials as $credential)
    <div id="{{'update-'.$credential->document_id}}" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">Update Credential</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form id="{{$credential->input_name}}" action="{{route($routeName,['studID' => $student->student_id, 'docID' => $credential->document_id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="{{$credential->input_name}}">Choose a file to be updated with {{$credential->document_name}}</label>
                        <input id="{{$credential->input_name}}" class="form-control form-control-sm" type="file" name="{{$credential->input_name}}">
                   </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger" form="{{$credential->input_name}}">Proceed</button>
                    <button class="btn btn-sm btn-success" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach