<div id="add-single-rec" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Add A Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="addRecordForm" action="{{route($routeName)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="student_id" value="{{$student->student_id}}">
                  <div id="addSingleRec">
                  </div>
               </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger" form="addRecordForm">Add Record</button>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>