<!-- Modal edit -->
<div class="modal fade" id="edtmodal{{$softwares->software_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">แก้ไข Software</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <form action="{{URL::to('editsoftware')}}" method="post" enctype="multipart/form-data" class="frm needs-validation" >   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "software_no" value = "{{$softwares->software_no}}" >

                <div class="row">
                    <div class="col">
                        <label><b>Software Name</b></label>
                        <input type="text" class="form-control" name="software_name"  placeholder="Software Name" value="{{$softwares->software_name}}" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>

                    <div class="col">
                        <label><b>Software Version</b></label>
                        <input type="text" class="form-control" name="software_version" placeholder="Software Version" value="{{$softwares->software_version}}" required>
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
                            @if($softwares->software_type_no == $software_types->software_type_no)
                                <option value="{{$software_types->software_type_no}}" selected>{{$software_types->software_type_name}}</option>
                            @else
                                <option value="{{$software_types->software_type_no}}">{{$software_types->software_type_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>

                    <div class="col">
                        <label><b>Platform</b></label>
                        <select name="platform_no" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($platform as $platforms)
                            @if($softwares->platform_no == $platforms->platform_no)
                                <option value="{{$platforms->platform_no}}" selected>{{$platforms->platform_name}}</option>
                            @else
                                <option value="{{$platforms->platform_no}}">{{$platforms->platform_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Key License</b></label>
                        <input type="text" class="form-control" name="key_license" placeholder="Key License" value="{{$softwares->key_license}}" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>

                    <div class="col">
                        <label><b>Max License</b></label>
                        <input type="text" class="form-control" name="max_license" placeholder="Max License" value="{{$softwares->max_license}}" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Used License</b></label>
                        <input type="text" class="form-control" name="used_license" placeholder="Used License" value="{{$softwares->used_license}}" required>
                        <div class="invalid-feedback">Please input data</div>
                        <p id="invalid-data" style="color:red;"></p>
                    </div>

                    <div class="col">
                        <label><b>Start Date</b></label>
                        <input type="date" name="start_date"  class="form-control" value="{{$softwares->start_date}}" required />
                        <div class="invalid-feedback">Please choose date</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>End Date</b></label>
                        <input type="date" name="end_date"  class="form-control" value="{{$softwares->end_date}}" required />
                        <div class="invalid-feedback">Please choose date</div>
                    </div>

                    <div class="col">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" name="btn2" class="btn btn-success add_user">บันทึก</button>
                </div>

            </form>
        </div>
    </div>
</div>