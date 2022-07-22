<!-- Modal edit -->
<div class="modal fade" id="upmodal{{$notirepairs->noti_repair_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">อัพเดทสถานะการดำเนินการ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <form action="{{URL::to('updatenotifyrepair')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation" >   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "noti_repair_no" value = "{{$notirepairs->noti_repair_no}}" >

                <h4 style="margin-top:2%">Charge</h4>

                <div class="row">
                    <div class="col">
                        <label><b>Status</b></label>
                        <select name="status" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @if($notirepairs->status_noti_repair == 0)
                            <option value="0" selected>ยังไม่ได้รับงาน</option>
                        @else
                            <option value="0">ยังไม่ได้รับงาน</option>
                        @endif
                        @if($notirepairs->status_noti_repair == 1)
                            <option value="1" selected>รับงาน</option>
                        @else
                            <option value="1">รับงาน</option>
                        @endif
                        @if($notirepairs->status_noti_repair == 2)
                            <option value="2" selected>ขอใบ Request</option>
                        @else
                            <option value="2">ขอใบ Request</option>
                        @endif
                        @if($notirepairs->status_noti_repair == 3)
                            <option value="3" selected>กำลังดำเนินการ</option>
                        @else
                            <option value="3">กำลังดำเนินการ</option>
                        @endif
                        @if($notirepairs->status_noti_repair == 4)
                            <option value="4" selected>เสร็จสิ้น</option>
                        @else
                            <option value="4">เสร็จสิ้น</option>
                        @endif
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>  
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Start Date</b></label>
                        <input type="date" name="start_date"  class="form-control" value="{{$notirepairs->start_date}}" />
                        <div class="invalid-feedback">Please choose date</div>
                    </div>

                    <div class="col">
                        <label><b>End Date</b></label>
                        <input type="date" name="end_date"  class="form-control" value="{{$notirepairs->end_date}}" />
                        <div class="invalid-feedback">Please choose date</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Result</b></label>
                        <textarea class="form-control" name="result" rows="5">{{$notirepairs->result}}</textarea>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Remark</b></label>
                        <textarea class="form-control" name="remark" rows="5">{{$notirepairs->remark}}</textarea>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" name="btn2" class="btn btn-success edt">บันทึก</button>
                </div>

            </form>
        </div>
    </div>
</div>