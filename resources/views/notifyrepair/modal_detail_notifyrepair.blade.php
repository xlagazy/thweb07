<!-- Modal Detail -->
<div class="modal fade" id="dtmodal{{$notirepairs->noti_repair_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">รายละเอียดแจ้งซ่อม</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">

            <div class="row">    
                <div class="col">
                    <label><b>Name</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->name_user}}</p>
                </div>

                <div class="col">
                    <label><b>Email</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->email}}</p>
                </div>
            </div>

            <div class="row">    
                <div class="col">
                    <label><b>Section</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->sect_name}}</p>
                </div>

                <div class="col">
                    <label><b>Location</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->location}}</p>
                </div>
            </div>

            <div class="row">    
                <div class="col">
                    <label><b>Tel</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->tel}}</p>
                </div>

                <div class="col">
                    <label><b>Subject</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->noti_subject_name}}</p>
                </div>
            </div>

            <div class="row">    
                <div class="col">
                    <label><b>Detail</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->detail}}</p>
                </div>
            </div>

            <div class="row">    
                <div class="col">
                    <label><b>Date</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{date("d-M-Y", strtotime($notirepairs->date))}}</p>
                </div>

                <div class="col">
                    <label><b>Track</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->track}}</p>
                </div>
            </div>

            <label><b>Images</b></label>
            <hr style="padding:0;margin:0;">
            <div class="row">    
                <div class="col">
                    @foreach(json_decode($notirepairs->images) as $images)
                        <a href="images/notirepair/{{$images}}" target="_blank"><img src="images/notirepair/{{$images}}" style="width:100px;height:100px;"></img></a>
                    @endforeach
                </div>
            </div>

            <h4 style="margin-top:2%">Charge</h4>

            <div class="row">    
                <div class="col">
                    <label><b>Status</b></label>
                    <hr style="padding:0;margin:0;">
                    @foreach($status as $value => $statused)
                        @if($notirepairs->status_noti_repair == $value)
                            <p>{{$statused}}</p>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="row">    
                <div class="col">
                    <label><b>Start Date</b></label>
                    <hr style="padding:0;margin:0;">
                    @if($notirepairs->start_date != "")
                        <p>{{date("d-M-Y", strtotime($notirepairs->start_date))}}</p>
                    @endif    
                </div>

                <div class="col">
                    <label><b>End Date</b></label>
                    <hr style="padding:0;margin:0;">
                    @if($notirepairs->end_date != "")
                        <p>{{date("d-M-Y", strtotime($notirepairs->end_date))}}</p>
                    @endif
                </div>
            </div>

            <div class="row">    
                <div class="col">
                    <label><b>Result</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->result}}</p>
                </div>
            </div>

            <div class="row">    
                <div class="col">
                    <label><b>Remark</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$notirepairs->remark}}</p>
                </div>
            </div>
        </div>
    </div>
</div>