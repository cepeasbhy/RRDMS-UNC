@if($requestedDocumentDetails->transcript_of_record != null)
    <div id="picture" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true" style="display: none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">
                        <span>PICTURE</span>
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
                    @if($requestedDocumentDetails->diploma == null)
                        <img class="img-fluid p-1" src="{{asset('storage/'.$requestInfo->submitted_file_loc[0]['picture'])}}">
                    @else
                        <img class="img-fluid p-1" src="{{asset('storage/'.$requestInfo->submitted_file_loc[1]['picture'])}}">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

@if($requestedDocumentDetails->diploma != null)
    <div id="affidavit" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true" style="display: none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">
                        <span>AFFIDAVIT</span>
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
                    <img class="img-fluid p-1" src="{{asset('storage/'.$requestInfo->submitted_file_loc[0]['affidavit'])}}">
                </div>
            </div>
        </div>
    </div>
@endif
