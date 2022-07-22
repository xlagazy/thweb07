<!-- Modal add -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">เพิ่ม Stock</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('addstock')}}" method="post" enctype="multipart/form-data" class="frm needs-validation" >   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

                <div class="row">
                    <div class="col">
                        <label><b>Equipment no</b></label>
                        <input type="text" class="form-control" name="equipment_no" id="equipment_no" placeholder="Equipment no" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" name="btn2" class="btn btn-success add_stock">เพิ่ม</button>
                </div>

            </form>
        </div>
    </div>
</div>