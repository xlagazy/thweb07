<!-- Modal add -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">เพิ่ม Software</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('addsoftware')}}" method="post" enctype="multipart/form-data" class="frm needs-validation" >   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

                <div class="row">
                    <div class="col">
                        <label><b>Software Name</b></label>
                        <input type="text" class="form-control" name="software_name"  placeholder="Software Name" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>

                    <div class="col">
                        <label><b>Software Version</b></label>
                        <input type="text" class="form-control" name="software_version" placeholder="Software Version" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Software Type</b></label>
                        <select name="software_type_no" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($software_type as $software_types)
                            <option value="{{$software_types->software_type_no}}">{{$software_types->software_type_name}}</option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>

                    <div class="col">
                        <label><b>Platform</b></label>
                        <select name="platform_no" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($platform as $platforms)
                            <option value="{{$platforms->platform_no}}">{{$platforms->platform_name}}</option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Key License</b></label>
                        <input type="text" class="form-control" name="key_license" placeholder="Key License" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>

                    <div class="col">
                        <label><b>Max License</b></label>
                        <input type="text" class="form-control" name="max_license" placeholder="Max License" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Used License</b></label>
                        <input type="text" class="form-control" name="used_license" placeholder="Used License" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>

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

                    <div class="col">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" name="btn2" class="btn btn-success add_user">เพิ่ม</button>
                </div>

            </form>
        </div>
    </div>
</div>