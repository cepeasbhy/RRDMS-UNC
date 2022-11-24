<div id="accept-request-modal" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if ($request_status->status == 'IN PROGRESS')
                    <h5 class="modal-title" id="title-modal">Set a Release Date for this Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif

                @if ($request_status->status == 'SET FOR RELEASE')
                    <h5 class="modal-title" id="title-modal">Set Transaction to Completed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>
            <div class="modal-body">

                @if ($request_status->status == 'IN PROGRESS')
                    <form action="{{ route($routeName, ['request_id' => $request_id->request_id]) }}" method="post"
                        id="dateForm">
                        @csrf
                        <input class="form-control" type="date" required name="releaseDate">
                    </form>
                @endif

                @if ($request_status->status == 'SET FOR RELEASE')
                    <form action="{{ route('cic.completeTransaction', ['request_id' => $request_id->request_id]) }}"
                        method="post" id="completeTransaction">
                        @csrf
                        <p>Complete This Transaction?</p>
                    </form>
                @endif


            </div>
            <div class="modal-footer">

                @if ($request_status->status == 'IN PROGRESS')
                    <button class="btn btn-sm btn-danger" form="dateForm">Proceed</button>
                    <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
                @endif

                @if ($request_status->status == 'SET FOR RELEASE')
                    <button class="btn btn-sm btn-danger" form="completeTransaction">Confirm</button>
                    <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
                @endif


            </div>
        </div>
    </div>
</div>
