<div id="admin-rec-prices" class="modal fade" tabindex="-1" aria-labelledby="title-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Record Prices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updatePrice" action="{{route('admin.updatePrice')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Bachelor/Law Degree Price</label>
                        <input class="form-control form-control-sm" type="number" name="bachelorLawDegreePrice" required value="{{$recordPrices['bachelorLawDegreePrice']->price}}" step=".01">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Masteral Degree Price</label>
                        <input class="form-control form-control-sm" type="number" name="masteralDegreePrice" required value="{{$recordPrices['masteralDegreePrice']->price}}" step=".01">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">TESDA Diploma Price</label>
                        <input class="form-control form-control-sm" type="number" name="tesdaPrice" required value="{{$recordPrices['tesdaDegreePrice']->price}}" step=".01">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Caregiving Diploma Price</label>
                        <input class="form-control form-control-sm" type="number" name="caregivingPrice" required value="{{$recordPrices['caregivingDegreePrice']->price}}" step=".01">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Transcript of Record Price</label>
                        <input class="form-control form-control-sm" type="number" name="torPrice" required value="{{$recordPrices['torPrice']->price}}" step=".01">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Copy of Grades Price</label>
                        <input class="form-control form-control-sm" type="number" name="copyGradePrice" required value="{{$recordPrices['copyGradePrice']->price}}" step=".01">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Certificate Price</label>
                        <input class="form-control form-control-sm" type="number" name="certPrice" required value="{{$recordPrices['certPrice']->price}}" step=".01">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Authentication Price</label>
                        <input class="form-control form-control-sm" type="number" name="authPrice" required value="{{$recordPrices['authPrice']->price}}" step=".01">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Photocopy (Ordinary) Price</label>
                        <input class="form-control form-control-sm" type="number" name="photoOrdindaryPrice" required value="{{$recordPrices['photoOrdinaryPrice']->price}}" step=".01">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Photocopy (Colored) Price</label>
                        <input class="form-control form-control-sm" type="number" name="photoColoredPrice" required value="{{$recordPrices['photoColoredPrice']->price}}" step=".01">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger" form="updatePrice">Update Price</button>
                <button class="btn btn-sm btn-success" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
