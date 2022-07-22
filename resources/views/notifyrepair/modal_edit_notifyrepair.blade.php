<style>
    .imgPreview img {
    padding: 8px;
    max-width: 100px;
    } 
</style>
<!-- Modal edit -->
<div class="modal fade" id="edtmodal{{$notirepairs->noti_repair_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">แจ้งซ่อม</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <form action="{{URL::to('editnotifyrepair')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation" >   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "noti_repair_no" value = "{{$notirepairs->noti_repair_no}}" >

                <div class="row">
                    <div class="col">
                        <label><b>Name</b></label>
                        <input type="text" class="form-control" name="name_user"  placeholder="Name" value="{{$notirepairs->name_user}}" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>

                    <div class="col">
                        <label><b>Email</b></label>
                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{$notirepairs->email}}" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Section</b></label>
                        <select name="sect_id" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($section as $sections)
                            @if($sections->sect_id == $notirepairs->sect_id)
                                <option value="{{$sections->sect_id}}" selected>{{$sections->sect_name}}</option>
                            @else
                                <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>

                    <div class="col">
                        <label><b>Location</b></label>
                        <input type="text" class="form-control" name="location" placeholder="Location" value="{{$notirepairs->location}}" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Tel</b></label>
                        <input type="text" class="form-control" name="tel" placeholder="Tel" value="{{$notirepairs->tel}}" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>

                    <div class="col">
                        <label><b>Subject</b></label>
                        <select name="noti_subject_no" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($noti_subject as $noti_subjects)
                            @if($noti_subjects->noti_subject_no == $notirepairs->noti_subject_no)
                                <option value="{{$noti_subjects->noti_subject_no}}" selected>{{$noti_subjects->noti_subject_name}}</option>
                            @else
                                <option value="{{$noti_subjects->noti_subject_no}}">{{$noti_subjects->noti_subject_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Detail</b></label>
                        <textarea class="form-control" name="detail" rows="5" required>{{$notirepairs->detail}}</textarea>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Date</b></label>
                        <input type="date" name="date"  class="form-control" value="{{$notirepairs->date}}" readonly required />
                        <div class="invalid-feedback">Please choose date</div>
                    </div>

                    <div class="col">
                        <label><b>Track</b></label>
                        <input type="text" class="form-control" name="track" placeholder="track" value="{{$notirepairs->track}}" readonly required>
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