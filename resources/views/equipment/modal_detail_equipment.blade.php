<div class="modal fade" id="equipdetail{{$equipments->equipment_no}}" tabindex="-1" role="dialog" 
               aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Equipment : {{$equipments->equipment_no}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

            <div class="form-group">
                <div style="text-align:center; margin-bottom:1%; ">
                    @if(!empty($equipments->image))
                    <a href="/images/equipment/{{$equipments->image}}" target="_blank">
                        <img src="/images/equipment/{{$equipments->image}}" style="widht:200px;height:300px;">
                    </a>
                    @endif
                </div>
            </div>

            <div class="row">
                
                <div class="col">
                    <label><b>Equipment Type</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->equip_type_name}}</p>
                </div>

                <div class="col">
                    <label><b>Equipment name</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->equipment_name}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>Fix asset</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->fix_asset}}</p>
                </div>

                <div class="col">
                    <label><b>Serial Number</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->serial_number}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>O/S</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->os_name}}</p>
                </div>

                <div class="col">
                    <label><b>Location</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->location}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>Computer Type</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->com_name}}</p>
                </div>

                <div class="col">
                    <label><b>Control Person</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->control_person}}
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>Person in charge</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->name}}</p>
                    <hr style="padding:0;margin:0;">
                </div>
                
                <div class="col">
                    <label><b>Purechase from</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->vendor_name}}</p>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <label><b>Department</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->dept_name}}</p>
                </div>

                <div class="col">
                    <label><b>Section</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->sect_name}}
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>Tel</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->tel_no}}</p>
                </div>

                <div class="col">
                    <label><b>Status</b></label>
                    <hr style="padding:0;margin:0;">
                    @if($equipments->equipment_status == "Using")
                        <p>Using</p>
                    @else
                        <p>Write off</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col">
                </div>

                <div class="col">
                    @if($equipments->cause_broken != "")
                        <label style="color:red;"><b>Case broken</b></label>
                        <hr style="padding:0;margin:0;">
                        <p>{{$equipments->cause_broken}}</p>
                    @endif
                    @if($equipments->write_off_date != "")
                        <label style="color:red;" ><b>Write off date</b></label>
                        <hr style="padding:0;margin:0;">
                        <p>{{date("d-M-Y", strtotime($equipments->write_off_date))}}</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>Setup Date</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{date("d-M-Y", strtotime($equipments->setup_date))}}</p>
                </div>

                <div class="col">
                    <label><b>Warranty</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->warranty}} Years</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>Spec</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$equipments->spec}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>Remark</b></label>
                    <hr style="padding:0;margin:0;">
                    @if(empty($equipments->remark))
                        <p>-</p>
                    @else
                        <p>{{$equipments->remark}}
                    @endif
                </div>
            </div>
            </div>
    </div>
</div>