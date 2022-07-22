<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มผู้ใช้</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('adduser')}}" method="post" enctype="multipart/form-data" class="frm needs-validation">   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

                <div class="form-group">
                    <label><b>Employees number</b></label>
                    <input type="text" class="form-control" name="employees_no" placeholder="Employees number" required>
                    <div class="invalid-feedback">Please input data</div>
                </div>

                <div class="form-group">
                    <label><b>Password</b></label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <div class="invalid-feedback">Please input data</div>
                </div>

                <div class="form-group">
                    <label><b>Name</b></label>
                    <input type="text" class="form-control" name="fname" placeholder="Name" required>
                    <div class="invalid-feedback">Please input data</div>
                </div>

                <div class="form-group">
                    <label><b>Section</b></label>
                    <select name="section" class="form-control" required>
                    <option disabled selected value>Choose...</option>
                    @foreach($section as $sections)
                        <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                    @endforeach
                    </select>
                    <div class="invalid-feedback">Please choose data</div>
                </div>

                <div class="form-group">
                    <label><b>Sub</b></label>
                    <select name="sub" class="form-control" required>
                    <option disabled selected value>Choose...</option>
                    @foreach($sub as $subs)
                        <option value="{{$subs->sub_it_id}}">{{$subs->sub_it_name}}</option>
                    @endforeach
                    </select>
                    <div class="invalid-feedback">Please choose data</div>
                </div>

                <div class="form-group">
                    <label><b>Position</b></label>
                    <select name="position" class="form-control" required>
                    <option disabled selected value>Choose...</option>
                    @foreach($position as $positions)
                        <option value="{{$positions->position_id}}">{{$positions->position_name}}</option>
                    @endforeach
                    </select>
                    <div class="invalid-feedback">Please choose data</div>
                </div>

                <div class="form-group">
                    <label><b>Tel</b></label>
                    <input type="text" class="form-control" name="tel" placeholder="Tel" required>
                    <div class="invalid-feedback">Please input data</div>
                </div>

                <div class="form-group">
                    <label><b>Image Profile</b></label>
                    <div style="text-align:center; margin-bottom:1%; ">
                        <img src="" id="imgpf" style="widht:150px;;height:200px;">
                    </div>
                    <input type="file" class="form-control" name="file"
                    onchange="imgpf.src=window.URL.createObjectURL(this.files[0]) " />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" name="btn2" class="btn btn-success add_user">เพิ่ม</button>
                </div>

            </form>
        </div>
    </div>
</div>