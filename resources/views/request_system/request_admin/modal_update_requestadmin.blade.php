<!-- Modal Detail -->
<div class="modal fade text-left" id="requestadminup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">Update request admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <form action="/listrequestadmin/receieved/update" method="post" enctype="multipart/form-data" class="frm">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "no" id = "no">
                <input type = "hidden" name = "hd_status_request" id = "hd_status_request">
                <div class="form-group row">
                    <div class="col-4">
                        <b>Status : </b>
                    </div>
                    <div class="col">
                        <select name="status_request_admin" id="status_request_admin" class="form-control statusrequest" onchange="checkStatus()" required>
                            <option id="0" selected value>Choose...</option>
                            <option id="4" value="4">กำลังดำเนินการ</option>
                            <option id="5" value="5">ดำเนินการแล้ว</option>
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                </div>

                <div id="hidden_working">
                    <div class="form-group row">
                        <div class="col-4">
                            <b>Kind of Request : </b>
                        </div>
                        <div class="col">
                            <input class="form-control"  id="kind_request" name="kind_request" rows="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <b>Details : </b>
                        </div>
                        <div class="col">
                            <textarea class="form-control" id="work_detail" name="work_detail" rows="3"></textarea>
                            <div class="invalid-feedback">Please input data</div> 
                        </div>
                    </div>
                </div>

                <!-- hidden finished -->
                <div id="hidden_finished">
                    <div class="form-group row">
                        <div class="col-4">
                            <b>Finished Date : </b>
                        </div>
                        <div class="col">
                            <input type="date" name="end_date" id="end_date" class="form-control" />
                            <div class="invalid-feedback">Please input data</div>   
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <b>Program Install Date : </b>
                        </div>
                        <div class="col">
                            <input type="date" name="program_install_date" id="program_install_date" class="form-control" />
                            <div class="invalid-feedback">Please input data</div>  
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <b>Yearly No. : </b>
                        </div>
                        <div class="col">
                            <input type="number" name="yearly_no" id="yearly_no" class="form-control" placeholder="Yearly No." />
                            <div class="invalid-feedback">Please input data</div>    
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <b>Time : </b>
                        </div>
                        <div class="col">
                            <input type="number" name="time" id="time" class="form-control" placeholder="Time" />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="time_type" id="time_type" value="0" checked>
                                <label class="form-check-label" for="time_type">
                                    Mins
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="time_type" id="time_type2" value="1">
                                <label class="form-check-label" for="time_type2">
                                    Hours
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="time_type" id="time_type3" value="2">
                                <label class="form-check-label" for="time_type3">
                                    Days
                                </label>
                            </div>
                            <div class="invalid-feedback">Please input data</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <b>Details : </b>
                        </div>
                        <div class="col">
                            <textarea class="form-control" id="end_detail" name="end_detail" rows="3"></textarea>
                            <div class="invalid-feedback">Please input data</div> 
                        </div>
                    </div>
                </div>

                <div id="hidden_button" class="text-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" name="btn2" class="btn btn-success updaterequestadmin">Update</button>
                </div>
            </form>

            <script type="text/javascript" src="{{asset('scripts/updaterequest_admin.js')}}"></script>

        </div>
    </div>
</div>