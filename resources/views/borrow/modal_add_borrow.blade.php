<!-- Modal add -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Borrow</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('addborrow')}}" method="post" enctype="multipart/form-data" class="frm needs-validation" >   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

                <div class="row">
                    <div class="col">
                        <label><b>Equipment no</b></label>
                        <input type="text" class="form-control" name="equipment_no" id="equipment_no" placeholder="Equipment no" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>User Borrow</b></label>
                        <input type="text" class="form-control" name="user_borrow" placeholder="User Borrow" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Section</b></label>
                        <select name="sect_id" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($section as $sections)
                        <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Start Date</b></label>
                        <input type="date" name="start_date"  class="form-control" required />
                        <div class="invalid-feedback">Please choose date</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>End Date</b></label>
                        <input type="date" name="end_date"  class="form-control" required />
                        <div class="invalid-feedback">Please choose date</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" name="btn2" class="btn btn-success add_borrow">เพิ่ม</button>
                </div>

            </form>
        </div>
    </div>
</div>