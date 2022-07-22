<div class="modal fade" id="modalexportexcel" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Export Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
                <form action="{{URL::to('exportborrow')}}" method="post" class="frmexport">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >


                    <label><b>Start Date</b></label>
                    <input type="date" name="start_date"  class="form-control" required />
                    <div class="invalid-feedback">Please choose date</div>

                    <label><b>End Date</b></label>
                    <input type="date" name="end_date"  class="form-control" required />
                    <div class="invalid-feedback">Please choose date</div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <Button type="button" class="btn btn-primary export" data-dismiss="modal">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>