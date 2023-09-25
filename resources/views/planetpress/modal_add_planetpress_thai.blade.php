<div class="modal fade" id="addprinter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Printer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('addplanetpressthai')}}" method="post" enctype="multipart/form-data" class="frm needs-validation">   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

                <label><b>Work Station</b></label>
                <input type="text" class="form-control" name="outqueue" placeholder="Work Station" required>
                <div class="invalid-feedback">Please input data</div>
                
                <label><b>Address</b></label>
                <input type="text" class="form-control" name="output" placeholder="Address" required>
                <div class="invalid-feedback">Please input data</div>

                <label><b>Description</b></label>
                <input type="text" class="form-control" name="description" placeholder="Description">
                <div class="invalid-feedback">Please input data</div>

                <label><b>Status</b></label>
                <select class="form-control" name="status">
                    <option value selected>Choose...</option>
                    <option value="Y">Y</option>
                    <option value="N">N</option>
                </select>
                <div class="invalid-feedback">Please choose data</div>

                <label><b>User</b></label>
                <input type="text" class="form-control" name="user_id" placeholder="User" required>
                <div class="invalid-feedback">Please input data</div>

                <label><b>Printer</b></label>
                <input type="text" class="form-control" name="printername" placeholder="Printer">
                <div class="invalid-feedback">Please input data</div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" name="btn2" class="btn btn-success add_user">Add</button>
                </div>
            </form>   
        </div>
    </div>
</div>