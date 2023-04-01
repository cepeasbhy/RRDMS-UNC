@foreach ($credentials as $credential)
    <div id="{{$credential->document_id}}" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">
                        {{$credential->document_name}}
                        <br>
                        <span class="h6">
                            {{
                                "[".$student->student_id."]"." ".
                                 $student->first_name." ".
                                 $student->last_name
                            }}
                        </span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid p-1" src="{{asset('storage/'.$credential->document_loc)}}">
                </div>
                <div class="modal-footer">
                    @if ($fromRequestedView == false)
                        <button class="btn btn-small btn-success" data-bs-toggle="modal" data-bs-target="{{'#'.'update-'.$credential->document_id}}">Update</button>
                        @if($credential->document_name != 'Picture' && Auth::user()->account_role == 'rec_assoc')
                            <button class="btn btn-small btn-danger" data-bs-toggle="modal" data-bs-target="{{'#'.'del-'.$credential->document_id}}">Dispose</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach