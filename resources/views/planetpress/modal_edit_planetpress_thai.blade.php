<div class="modal fade" id="editprinter{{$data->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Printer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('editplanetpressthai')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation">   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "id" value = "{{$data->ID}}" >

                <label><b>Work Station</b></label>
                <input type="text" class="form-control" name="outqueue" value="{{$data->OutQueue}}" placeholder="Work Station" required>
                <div class="invalid-feedback">Please input data</div>
                
                <label><b>Address</b></label>
                <input type="text" class="form-control" name="output" value="{{$data->Output}}" placeholder="Address" required>
                <div class="invalid-feedback">Please input data</div>

                <label><b>Description</b></label>
                <input type="text" class="form-control" name="description" value="{{$data->Description}}" placeholder="Description">
                <div class="invalid-feedback">Please input data</div>

                <label><b>Status</b></label>
                <select class="form-control" name="status">
                    <option value selected>Choose...</option>
                    @if($data->Status == 'Y')
                        <option value="Y" selected>Y</option>
                    @else
                        <option value="Y">Y</option>
                    @endif
                    @if($data->Status == 'N')
                        <option value="N" selected>N</option>
                    @else
                        <option value="N">N</option>
                    @endif
                </select>
                <div class="invalid-feedback">Please choose data</div>

                <label><b>User</b></label>
                <input type="text" class="form-control" name="user_id" value="{{$data->User_ID}}" placeholder="User" required>
                <div class="invalid-feedback">Please input data</div>

                <label><b>Printer</b></label>
                <input type="text" class="form-control" name="printername" value="{{$data->Printername}}" placeholder="Printer">
                <div class="invalid-feedback">Please input data</div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" name="btn2" class="btn btn-success edt">Save</button>
                </div>
            </form>   
        </div>
    </div>
</div>